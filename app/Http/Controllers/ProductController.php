<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Product;
use AWS;

class ProductController extends Controller
{
  public function __construct()
  {
    //$this->middleware('auth');
    parent::__construct();
  }

  public function index()
  {
    $products = \App\Product::where('active', 1)
    ->orderBy('id', 'desc')
    ->take(10)
    ->get();
    return view('product.index', compact('products'));
  }

  public function view($group, $type, Request $request)
  {
    //$request = request();

    $product = \App\Product::where('active', 1)
    ->where('group', $group)
    ->first();

    //todo - check if is object + if type exits

    $product_types = $product->setTypeAttribute( $product->type );
    $elements = $product->setSetQuantityAttribute( $product->set_quantity, $type );
    $borders = $product->border_color;
    
    $s3 = AWS::createClient('s3');
    /*$s3 = new \Aws\S3\S3Client([
      'version' => 'latest',
      'region' => config('aws.region'),
    ]);*/
    // Set some defaults for form input fields
    $formInputs = [
      'acl' => config('aws.acl'),
      'key' => '${filename}',
      'success_action_status' => '201'
    ];
    // Construct an array of conditions for policy
    $options = [
        ['acl' => config('aws.acl')],
        ['bucket' => config('aws.bucket')],
        ['starts-with', '$key', ''],
        ['success_action_status' => '201']
    ];
    // Optional: configure expiration time string
    $expires = '+2 hours';

    $postObject = new \Aws\S3\PostObjectV4(
        $s3,
        config('aws.bucket'),
        $formInputs,
        $options,
        $expires
    );
    // Get attributes to set on an HTML form, e.g., action, method, enctype
    $formAttributes = $postObject->getFormAttributes();
    // Get form input fields. This will include anything set as a form input in
    // the constructor, the provided JSON policy, your AWS Access Key ID, and an
    // auth signature.
    $formInputs = $postObject->getFormInputs();

    $uploaded_files = $request->session()->get('uploaded_files');
    //echo "<pre>".print_r( $uploaded_files, 1 )."</pre>"; exit;

    return view('product.view', compact('product', 'group', 'type', 'product_types', 'elements', 'borders', 'formInputs', 'formAttributes', 'uploaded_files'));
  }

  public function uploadS3(Request $request)
  {
    if($request->isMethod('get')) 
    {
      //todo save files in session
      //Update session data
      $uploaded_files = $request->session()->get('uploaded_files');
      //echo "<pre>".print_r( $_GET, 1 )."</pre>"; exit;
      //echo "<pre>".print_r( $request->files, 1 )."</pre>"; exit;
      // ?? Symfony\Component\HttpFoundation\FileBag Object

      $file = [
        'width' => $_GET['files'][0]['width'],
        'height' => $_GET['files'][0]['height'],
        'is_square' => $_GET['files'][0]['is_square'],
        'original_name' => $_GET['files'][0]['original_name'],
        's3_name' => $_GET['files'][0]['s3_name'],
        'size' => $_GET['files'][0]['size'],
        'type' => $_GET['files'][0]['type'],
        'url' => $_GET['files'][0]['url']
      ];
      //$cnt = count( $uploaded_files );

      $uploaded_files[] = $file;
      $request->session()->put('uploaded_files', $uploaded_files);

      return response()->json([
        'response' => count($uploaded_files), 
        //'files1' => print_r($uploaded_files_new,1), 
        //'files2' => print_r($request->files,1), 
        'status' => 'success'
        ]);
    }
    else
    {
      return response()->json([
        'response' => 'error_ajax_request', 
        'status' => 'error'
      ]);
    }
  }

}

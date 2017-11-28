<?php
/**
 * PRODUCT Controller
 * 
 * PHP version 5
 * 
 * @category  Laravel
 * @author    Tomasz Razik <info@raziu.com>
 * @link      http://raziu.com/
 * @copyright 2017 Tomasz Razik
 */
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

  /**
   * Products listing action
   */
  public function index()
  {
    $products = \App\Product::where('active', 1)
    ->orderBy('id', 'desc')
    ->get();
    ;
    //dd($products->toSql());
    return view('product.index', compact('products'));
  }

  /**
   * Product view action (listed available types)
   */
  public function view($group, $type, Request $request)
  {
    $product = \App\Product::where('active', 1)
    ->where('group', $group)
    ->first();
    /**
     * Redirect to index action if product group not exists
     */
    if( !is_object( $product ) )
    {
      return redirect()->route(app()->getLocale().'_product');
    }

    $product_types = $product->setTypeAttribute( $product->type );
    /**
     * Redirect to index action if product type not exists
     */
    if( !in_array( $type, $product_types ) )
    {
      return redirect()->route(app()->getLocale().'_product');
    }

    $elements = $product->setSetQuantityAttribute( $product->set_quantity, $type );
    $borderColors = json_encode(explode('|',$product->border_color));
    
    $s3 = new \Aws\S3\S3Client([
      'version' => 'latest',
      'region' => config('aws.region'),
    ]);
    /**
     * Set some defaults for form input fields
     */
    $formInputs = [
      'acl' => config('aws.acl'),
      'key' => '${filename}',
      'success_action_status' => '201'
    ];
    /**
     * Construct an array of conditions for policy
     */
    $options = [
        ['acl' => config('aws.acl')],
        ['bucket' => config('aws.bucket')],
        ['starts-with', '$key', ''],
        ['success_action_status' => '201']
    ];
    /**
     * Optional: configure expiration time string
     */
    $expires = '+2 hours';
    $postObject = new \Aws\S3\PostObjectV4(
        $s3,
        config('aws.bucket'),
        $formInputs,
        $options,
        $expires
    );
    /**
     * Get attributes to set on an HTML form, e.g., action, method, enctype
     */
    $formAttributes = $postObject->getFormAttributes();
    // Get form input fields. This will include anything set as a form input in
    // the constructor, the provided JSON policy, your AWS Access Key ID, and an
    // auth signature.
    $formInputs = $postObject->getFormInputs();

    $uploaded_files = $request->session()->get('uploaded_files');

    return view('product.view', compact(
      'product', 
      'group', 
      'type', 
      'product_types', 
      'elements', 
      'borderColors', 
      'formInputs', 
      'formAttributes', 
      'uploaded_files')
    );
  }

  /**
   * AMAZON S3 upload callback action
   */
  public function uploadS3(Request $request)
  {
    if($request->isMethod('get')) 
    {
      /**
       * Update session data
       */
      $uploaded_files = $request->session()->get('uploaded_files');
      //echo "<pre>".print_r( $request->files, 1 )."</pre>"; exit; // ?? Symfony\Component\HttpFoundation\FileBag Object
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
      $uploaded_files[] = $file;
      $request->session()->put('uploaded_files', $uploaded_files);
      return response()->json([
        'response' => count($uploaded_files), 
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

  public function updateGrid(Request $request)
  {
    $urlArr = explode('/', $_POST['url']);
    $filename = end($urlArr);
    $res = [];
    $res['post_new_url'] = $_POST['new_url'];
    $res['filename'] = $filename; 
    $res['save_result'] = $this->savePic($_POST['new_url'], $filename); 
    $storage_path = storage_path();
    $path = $storage_path.'/tmp-images/'.$filename;    
    if( file_exists( $path ) ) 
    {
      list($width, $height, $type, $attr) = getimagesize($path);
      $res['new_size']['width'] = $width;
      $res['new_size']['height'] = $height;
    }
    $res['status'] = 'success';
    //delete image from server
    @unlink($path);
    return response()->json( $res );
  }

  public function savePic($pic_url, $imageName) 
  {
    define('OK', 0);
    define('URL_EMPTY', 1);
    define('WRITING_PROBLEMS',2);
    define('OTHER_PROBLEM', 3);
    $storage_path = storage_path();
    $imageDir = $storage_path.'/tmp-images';    
    if (!is_dir($imageDir))
    {
      @mkdir($imageDir, 0775);
    }
    if (!strlen($pic_url))
    {
      return URL_EMPTY;
    }      
    if (!is_dir($imageDir) || !is_writable($imageDir)) 
    {  
      if (!is_dir($imageDir))
      {
        return 'IS NOT DIR';
      }
      if( !is_writable($imageDir) ) 
      {
        return 'IS NOT WRITABLE';
      }
      return WRITING_PROBLEMS.': '.$imageDir;
    }  
    //$pic_url = str_replace( 'https', 'http', $pic_url );  
    $image = file_get_contents($pic_url);  
    $r = file_put_contents($imageDir.'/'.$imageName, $image);  
    if ($r)
      return OK;
    else
      return OTHER_PROBLEM;  
  }

}

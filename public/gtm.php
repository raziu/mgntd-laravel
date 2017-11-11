<?php
/**
 * Sample mysql class to save passed data
 * @date 2017.11.11
 * @author Tomasz Razik http://raziu.com/
 */
class RAZIUCOM_GTM 
{
  private $_connection;
	private static $_instance;
	private $_host = "localhost";
	private $_username = "root";
	private $_password = "password";
  private $_database = "gtm";
  private $_table = "newsletter";
  private $_errors = [];
  private $_data = [];
  /**
   * Get an instance of the Database
   * @return Instance 
   */
  public static function getInstance() 
  {
    if(!self::$_instance) 
    { 
      // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
  }
  /**
   * Constructor
   */
  private function __construct() 
  {
		$this->_connection = new mysqli($this->_host, $this->_username, 
			$this->_password, $this->_database);
		/**
     * Error handling
     */
    if(mysqli_connect_error()) 
    {
      //trigger_error("Failed to connect to MySQL: " . mysql_connect_error(), E_USER_ERROR);
      $this->_errors[] = "Failed to connect to MySQL: " . mysql_connect_error();
		}
  }
  /**
   * Magic method clone is empty to prevent duplication of connection
   */
  private function __clone() {}
  
  /**
   * Get mysqli connection
   */
  public function getConnection() 
  {
		return $this->_connection;
  }
  /**
   * Get errors
   */
  public function getErrors() 
  {
		return $this->_errors;
  }
  /**
   * Add error
   */
  public function addError( $key, $error ) 
  {
		return $this->_errors[ $key ] = $error;
  }
  /**
   * Validate request
   */
  public function validateRequest( array $post )
  {
    if( !count( $post ) )
    {
      $this->addError( 'params', "No parameters passed!" );
    }
    else
    {
      if(filter_var($post['name'], FILTER_SANITIZE_STRING) === false) 
      {
        $this->addError( 'name', "The given name isn't valid." );
      } 
      if(filter_var($post['email'], FILTER_VALIDATE_EMAIL) === false) 
      {
        $this->addError( 'email', "The given email isn't valid." );
      } 
      if (empty($post['name']))
      {
        $this->addError( 'name', "Field name is required." );
      }   
      if (empty($post['email']))
      {	
        $this->addError( 'email', "Field email is required." );
      }
    }
    //echo "errors: <pre>".print_r( $this->_errors, 1 )."</pre>"; exit;
    if( count( $this->_errors ) > 0 )
    {
      $this->_data['success'] = false;
      $this->_data['errors']  = $this->_errors; 
    }
    else
    {
      $this->checkRecordExists( $_POST );
    }
    /**
     * Return all our data to an AJAX call
     */
    echo json_encode($this->_data);
    exit;
  }

  public function checkRecordExists( $params )
  {
    $sql = "SELECT name, email FROM ".$this->_table." WHERE email = '".$params['email']."'";
    $result = mysqli_query($this->_connection, $sql);
    if(@mysqli_num_rows($result) == 0 || !$result)
		{
			$this->_data['success'] = true;
			$this->_data['message'] = 'Success!';	
			/**
       * Add record to the database
       */
			$sql = "INSERT INTO ".$this->_table." (name, email,website) VALUES ('".$params['name']."', '".$params['email']."', '".$params['website']."')";
      mysqli_query($this->_connection, $sql); 
      $this->_data['sql'] = $sql;		
		}
		else
		{
      $this->addError( 'email', "Email address is already added!" );
			$this->_data['success'] = false;
			$this->_data['errors']  = $this->_errors;		
    }
    mysqli_close($this->_connection);
  }
}

/**
 * Database connection
 */
$db = RAZIUCOM_GTM::getInstance();
$db->getConnection();
$db->validateRequest( $_POST );
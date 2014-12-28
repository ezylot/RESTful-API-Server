<?php
namespace classes\abs;
/*
* Abstract class from
* http://coreymaynard.com/blog/creating-a-restful-api-with-php/
*
*/
abstract class API
{
  /**
  * Property: method
  * The HTTP method this request was made in, either GET, POST, PUT or DELETE
  */
  protected $method = '';
  /**
  * Property: args
  * Any additional URI components after the endpoint has been removed, in our
  * case, an integer ID for the resource. eg: /<endpoint>/<arg0>/<arg1>
  */
  protected $args = Array();
  /**
  * Property: file
  * Stores the input of the PUT request
  */
  protected $file = Null;

  /**
  * Constructor: __construct
  * Allow for CORS, assemble and pre-process the data
  */

  protected $func;
  public function __construct($request) {
    $this->method = $_SERVER['REQUEST_METHOD'];
    if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
      if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
        $this->method = 'DELETE';
      } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
        $this->method = 'PUT';
      } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PATCH') {
        $this->method = 'PATCH';
      } else {
        throw new Exception("Unexpected Header");
      }
    }

    $function = (isset($request[0])) ? $request[0] : "";

    if(!empty($function) && (int)method_exists($this, $function) > 0)
      $this->func = array_shift($request);
    else
      switch($this->method) {
        case 'DELETE':
          if((int)method_exists($this, 'delete') > 0)
            $this->func = 'delete';
          else
            $this->func = 'index';
        break;
        case 'POST':
          if((int)method_exists($this, 'post') > 0)
            $this->func = 'create';
          else
            $this->func = 'index';
        break;
        case 'GET':
          if((int)method_exists($this, 'get') > 0)
            $this->func = 'read';
          else
            $this->func = 'index';
        break;
        case 'PUT':
          if((int)method_exists($this, 'put') > 0)
            $this->func = 'update';
          else
            $this->func = 'index';
        break;
        case 'PATCH':
          if((int)method_exists($this, 'patch') > 0)
            $this->func = 'patch';
          else
            $this->func = 'index';
        break;
        default:
        $this->_response('Function', 400);
        break;
      }

    $this->args = $request;

    switch($this->method) {
      case 'DELETE':
      case 'POST':
        $this->request = $this->_cleanInputs($_POST);
        $this->file = file_get_contents("php://input");
      break;
      case 'GET':
      $this->request = $this->_cleanInputs($_GET);
      break;
      case 'PUT':
      $this->request = $this->_cleanInputs($_GET);
      $this->file = file_get_contents("php://input");
      break;
      case 'PATCH':
      $this->request = $this->_cleanInputs($_GET);
      $this->file = file_get_contents("php://input");
      break;
      default:
      $this->_response('Invalid Method', 405);
      break;
    }
  }
  public function processAPI() {
      return $this->_response($this->{$this->func}($this->args));
  }

  private function _response($data, $status = 200) {
    header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
    if(isset($data['id'])){
      $id = $data['id'];
      unset($data['id']);
      return json_encode(array('id' => $id, "status" => "Executed", "data" => array_shift($data)));
    }
    return json_encode(array("status" => "Executed", "data" => $data));
  }

  private function _cleanInputs($data) {
    $clean_input = Array();
    if (is_array($data)) {
      foreach ($data as $k => $v) {
        $clean_input[$k] = $this->_cleanInputs($v);
      }
    } else {
      $clean_input = trim(strip_tags($data));
    }
    return $clean_input;
  }

  private function _requestStatus($code) {
    $status = array(
      200 => 'OK',
      404 => 'Not Found',
      405 => 'Method Not Allowed',
      500 => 'Internal Server Error',
    );
    return ($status[$code])?$status[$code]:$status[500];
  }
}

?>

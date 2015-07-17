<?php
namespace classes\abs;
/*
* Abstract class from
* http://coreymaynard.com/blog/creating-a-restful-api-with-php/
*
*  EDITED BY ezylot
*/
abstract class API
{
    /**
     * @var string method
     * The HTTP method this request was made in, either GET, POST, PUT or DELETE
     * It is also the method that will be called on the model
     */
    protected $method = '';

    /**
     * @var array args
     * Any additional URI components after the modelname has been removed
     * eg: /<modelname>/<arg0>/<arg1>
     */
    protected $args = Array();

    /**
     *
    * @var file
    * Stores the input of the PUT. POST or PATCH request
    */
    protected $file = null;

    /**
     * @var array getParams
     * Stores aditional get parameter that were written in the ?key=value&key2=value2 format
     */
    protected $getParams = array();


    /**
     * @param array $request
     *
     */
    public function __construct($request = array())  {

        // If no request_method is set, assume that we GET
        if(isset($_SERVER['REQUEST_METHOD']) == false)
            $this->method = 'GET';
        else
            $this->method = $_SERVER['REQUEST_METHOD'];

        if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->method = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->method = 'PUT';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PATCH') {
                $this->method = 'PATCH';
            } else {
                $this->_response('Invalid Method', 405);
            }
        }

        $customCallFunction = (isset($request[0])) ? $request[0] : "";

        // Checks if the first paramter is a functionname. If it is, this one will be called,
        // if not, the method with the name of the request_method will be called.
        // If this one also doesn't exitst it falls back to the index method
        if(!empty($customCallFunction) && (int)method_exists($this, $customCallFunction) > 0)
            $this->method = array_shift($request);
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
                    $this->_response('Invalid Method', 405);
                break;
            }

        $this->args = $request;

        // Saves the POST Request that is sent in a few methods into the file property
        // Merges the argument with aditional, optional GET Parameters
        switch($this->method) {
            case 'DELETE':
            case 'POST':
                $this->file = file_get_contents("php://input");
            break;
            case 'GET':
                $this->getParams = $this->_cleanInputs($_GET);
            break;
            case 'PUT':
                $this->getParams = $this->_cleanInputs($_GET);
                $this->file = file_get_contents("php://input");
            break;
            case 'PATCH':
                $this->getParams = $this->_cleanInputs($_GET);
                $this->file = file_get_contents("php://input");
            break;
        }
    }

    /**
     * @return string Returns the result of the model or possible errors as a string
     *
     */
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


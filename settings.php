<?php
  class settings {
    public $dsn = 'mysql:host=localhost;dbname=db1_restful_api_server';
    public $username = 'root';
    public $password = '123456';
    public $options = array(
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );
    protected $pdo = null;

    public function __construct() {
      header('Content-Type: text/html; charset=utf-8');
      try {
        $this->pdo = new PDO($this->dsn, $this->username, $this->password, $this->options);
      } catch (Exception $ex) {
        die(json_encode(array("status" => "Failure", "data" => "Could not connect to the database!")));
      }
    }

    public function getPDO() {
      return $this->pdo;
    }
}
?> Just change soe data to test the file reversion
alökndsöihfnoasf
oaiwjda
apoa

adpokadpj
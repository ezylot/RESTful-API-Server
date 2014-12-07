<?php
namespace model;

class apikey extends \classes\abs\api {
  public function __construct($request) {
    parent::__construct($request);
  }

  protected function index() {
    return uniqid(mt_rand(10000, 99999), false);
  }

}

?>

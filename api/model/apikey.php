<?php
namespace model;

class apikey extends \classes\abs\api {
  public function __construct($request) {
    parent::__construct($request);
  }

  public function index() {
    if($this->method != 'GET')
      return "You can only {GET} from this model";
    return uniqid(mt_rand(10000, 99999), false);
  }

}

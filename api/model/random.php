<?php
  namespace model;

  class random extends \classes\abs\api {
    public function __construct($request) {
      parent::__construct($request);
    }

    protected function index($options = array(0, 999)) {
      if($_SESSION['logged_in'] !== true)
        return "You have to be logged in";
      if(sizeof($options) == 2) {
        if(!is_numeric($options[0]) || !is_numeric($options[1]))
          return "Parameters must be numeric";
        return rand($options[0], $options[1]);

      } else
        return rand();
    }

  }

?>

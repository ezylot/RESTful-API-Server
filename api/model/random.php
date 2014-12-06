<?php
  namespace model;

  class implAPI {
    public function __construct($request, $origin) {
      parent::__construct($request);
    }
    
    protected function index() {
      echo rand();
    }

  }

?>

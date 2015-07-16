<?php
namespace model;

class methodtest extends \classes\abs\api {
  public function __construct($request) {
    parent::__construct($request);
  }

  public function index() {

  }

  public function patch($opts) { //model.save({data: bla}, {patch: true})
    $file = json_decode($this->file);
    return array('id' => array_shift($opts), $file->data);
  }
  public function create($opts) { //model.save on a new model and collection.create
    $file = json_decode($this->file);
    return array('id' => rand(), 'status' => ($file->status == 'None')?('New'):($file->status));
  }
  public function delete($opts) { //model.destroy
    return array('id' => array_shift($opts), "delete");
  }
  public function read() { //collection.fetch
    return array('id' => rand(), "get");
  }
  public function update($opts) { //model.save
    $file = json_decode($this->file);
    return array('id' => array_shift($opts), $file->data);
  }


}

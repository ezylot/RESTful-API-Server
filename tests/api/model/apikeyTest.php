<?php
namespace tests\api\model;

class apikeyTest extends \PHPUnit_Framework_TestCase {
  public function testKeylengthIsEighteen() {
    $_SERVER['REQUEST_METHOD'] = "GET";
    $w = new \model\apikey(array());
    $this->assertEquals(18, strlen($w->index()));
  }
}
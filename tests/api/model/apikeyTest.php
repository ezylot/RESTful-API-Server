<?php
namespace tests\api\model;

class apikeyTest extends \PHPUnit_Framework_TestCase {
  public function testKeylengthIsEighteen() {
    $w = new \model\methodtest(array("index"));
    $this->assertEquals(18, strlen($w->index()));
  }
}

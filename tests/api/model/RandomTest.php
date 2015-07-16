<?php
namespace tests\api\model;

class randomTest extends \PHPUnit_Framework_TestCase {
  public function testRandomReturnsInt() {
    $w = new \model\random(array("index", 1, 5));
    $this->assertEquals(1, $w->index(array(1,1)));
    $this->assertEquals(2, $w->index(array(2,1)));
  }
}
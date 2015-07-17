<?php
namespace tests\api\model;

class randomTest extends \PHPUnit_Framework_TestCase {
    public function testRandomReturnsInt() {
        $w = new \model\random(array(1, 1));

        $this->assertEquals(1, $w->get(array(1,1)));
        $this->assertEquals(2, $w->get(array(2,1)));
    }
}

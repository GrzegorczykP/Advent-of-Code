<?php
require_once __DIR__ . '/base/init.php';

use PHPUnit\Framework\TestCase;

class AdventOfCodeTest extends TestCase
{
    public function testDay1(): void
    {
        $assignment = new Assignments\Day1(true);
        $result = $assignment->run();
        $this->assertEquals(7, $result[0]);
        $this->assertEquals(5, $result[1]);
    }

    public function testDay2(): void
    {
        $assignment = new Assignments\Day2(true);
        $result = $assignment->run();
        $this->assertEquals(150, $result[0]);
        $this->assertEquals(900, $result[1]);
    }
}

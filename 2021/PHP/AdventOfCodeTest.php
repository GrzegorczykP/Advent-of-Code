<?php
require_once __DIR__ . '/base/init.php';

use Assignments\Day1;
use PHPUnit\Framework\TestCase;

class AdventOfCodeTest extends TestCase
{
    public function testDay1(): void
    {
        $assignment = new Day1(true);
        $result = $assignment->run();
        $this->assertEquals(7, $result[0]);
        $this->assertEquals(5, $result[1]);
    }
}

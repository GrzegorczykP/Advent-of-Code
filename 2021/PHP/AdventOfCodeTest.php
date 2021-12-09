<?php
require_once __DIR__ . '/base/init.php';

use PHPUnit\Framework\TestCase;

class AdventOfCodeTest extends TestCase
{
    public function testDay1(): void
    {
        $assignment = new Assignments\Day1(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(7, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(5, $result[1]);
    }

    public function testDay2(): void
    {
        $assignment = new Assignments\Day2(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(150, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(900, $result[1]);
    }

    public function testDay3(): void
    {
        $assignment = new Assignments\Day3(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(198, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(230, $result[1]);
    }

    public function testDay4(): void
    {
        $assignment = new Assignments\Day4(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(4512, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(1924, $result[1]);
    }
}

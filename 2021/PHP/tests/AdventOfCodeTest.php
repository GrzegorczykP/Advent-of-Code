<?php

namespace Tests;

use App\Assignments\Day1;
use App\Assignments\Day2;
use App\Assignments\Day3;
use App\Assignments\Day4;
use App\Assignments\Day5;
use App\Assignments\Day6;
use PHPUnit\Framework\TestCase;

class AdventOfCodeTest extends TestCase
{
    public function testDay1(): void
    {
        $assignment = new Day1(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(7, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(5, $result[1]);
    }

    public function testDay2(): void
    {
        $assignment = new Day2(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(150, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(900, $result[1]);
    }

    public function testDay3(): void
    {
        $assignment = new Day3(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(198, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(230, $result[1]);
    }

    public function testDay4(): void
    {
        $assignment = new Day4(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(4512, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(1924, $result[1]);
    }

    public function testDay5(): void
    {
        $assignment = new Day5(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(5, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(12, $result[1]);
    }

    public function testDay6(): void
    {
        $assignment = new Day6(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(5934, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(26984457539, $result[1]);
    }
}

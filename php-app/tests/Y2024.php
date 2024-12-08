<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

final class Y2024 extends TestCase
{
    public function testDay1(): void
    {
        $assignment = new \App2024\Assignments\Day1(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(11, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(31, $result[1]);
    }

    public function testDay2(): void
    {
        $assignment = new \App2024\Assignments\Day2(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(2, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(4, $result[1]);
    }

    public function testDay3(): void
    {
        $assignment = new \App2024\Assignments\Day3(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(161, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(48, $result[1]);
    }

    public function testDay4(): void
    {
        $assignment = new \App2024\Assignments\Day4(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(18, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(9, $result[1]);
    }

    public function testDay5(): void
    {
        $assignment = new \App2024\Assignments\Day5(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(143, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(123, $result[1]);
    }

    public function testDay6(): void
    {
        $assignment = new \App2024\Assignments\Day6(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(41, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(6, $result[1]);
    }

    public function testDay7(): void
    {
        $assignment = new \App2024\Assignments\Day7(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(3749, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(11387, $result[1]);
    }

    public function testDay8(): void
    {
        $assignment = new \App2024\Assignments\Day8(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(14, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(34, $result[1]);
    }
}

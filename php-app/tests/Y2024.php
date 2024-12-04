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
}

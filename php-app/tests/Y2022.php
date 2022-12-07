<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

final class Y2022 extends TestCase
{
    public function testDay1(): void
    {
        $assignment = new \App2022\Assignments\Day1(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(24000, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(45000, $result[1]);
    }

    public function testDay2(): void
    {
        $assignment = new \App2022\Assignments\Day2(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(15, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(12, $result[1]);
    }

    public function testDay3(): void
    {
        $assignment = new \App2022\Assignments\Day3(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(157, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(70, $result[1]);
    }

    public function testDay4(): void
    {
        $assignment = new \App2022\Assignments\Day4(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(2, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(4, $result[1]);
    }
}

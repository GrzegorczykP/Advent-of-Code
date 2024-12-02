<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

final class Y2023 extends TestCase
{
    public function testDay1(): void
    {
        $assignment = new \App2023\Assignments\Day1(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(209, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(281, $result[1]);
    }

    public function testDay2(): void
    {
        $assignment = new \App2023\Assignments\Day2(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(8, $result[0]);
        $this->assertArrayHasKey(1, $result);
        $this->assertEquals(2286, $result[1]);
    }

    public function testDay3(): void
    {
        $assignment = new \App2023\Assignments\Day3(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(4361, $result[0]);
        //        $this->assertArrayHasKey(1, $result);
        //        $this->assertEquals(2286, $result[1]);
    }
}

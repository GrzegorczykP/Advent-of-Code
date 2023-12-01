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
        $this->assertEquals(142, $result[0]);
//        $this->assertArrayHasKey(1, $result);
//        $this->assertEquals(45000, $result[1]);
    }
}

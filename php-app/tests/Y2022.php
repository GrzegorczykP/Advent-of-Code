<?php

namespace Tests;

use App2022\Assignments\Day1;
use PHPUnit\Framework\TestCase;

final class Y2022 extends TestCase
{
    public function testDay1(): void
    {
        $assignment = new Day1(true);
        $result = $assignment->run();
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals(24000, $result[0]);
    }
}

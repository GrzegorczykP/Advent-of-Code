<?php


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
}

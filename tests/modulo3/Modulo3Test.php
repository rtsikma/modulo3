<?php

use PHPUnit\Framework\TestCase;

class Modulo3Test extends TestCase
{
    public function testConstructException()
    {
        $this->expectException(\TypeError::class);
        $x = new modulo3\Modulo3();
    }

    public function testConstructInvalid()
    {
        $this->expectException(\InvalidArgumentException::class);
        $x = new modulo3\Modulo3('1200010010');
    }

    public function testConstructValid()
    {
        $x = new modulo3\Modulo3('1000100101');
        self::assertInstanceOf('modulo3\Modulo3', $x, "Constructor with valid args didn't return correct object");
    }

    public function RunParams() : array
    {
        return [
            '101010101' => ['101010101', '2'],
            '11111111' => ['11111111', '0'],
            '11111110' => ['11111110', '2'],
            '11111101' => ['11111101', '1'],
            '01101101010' => ['01101101010', '1']
        ];
    }

    /**
     * @dataProvider RunParams
     * @param string $input
     * @param string $expectedRemainder
     * @return void
     * @throws Exception
     */
    public function testRun(string $input, string $expectedRemainder)
    {
        $x = new modulo3\Modulo3($input);
        $result = $x->run();
        $remainder = $x->GetResult();
        self::assertEquals(true, $result, 'Run returned false when it should return true');
        self::assertEquals($expectedRemainder, $remainder, 'Incorrect Remainder Returned');
    }
}

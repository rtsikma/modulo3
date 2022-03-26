<?php

use fsm;
use PHPUnit\Framework\TestCase;

class StateTest extends TestCase
{
    public function testConstructNull()
    {
        $this->expectException(\TypeError::class);
        $x = new fsm\State(NULL);
    }

    public function testConstructorEmpty()
    {
        $this->expectException(\ArgumentCountError::class);
        $x = new fsm\State();
    }

    public function testConstructValid()
    {
        $stateName = 'State1';
        $x = new fsm\State($stateName, ['0', '1']);
        self::assertInstanceOf('fsm\State', $x);
        self::assertEquals($stateName, $x->Name());
    }

    public function testMove()
    {
        $state1 = new fsm\State('State1', ['0', '1']);
        $state2 = new fsm\State('State2', ['0', '1']);
        $state1->AddTransition('0', $state2);
        self::assertEquals($state2, $state1->Move('0'));
    }

    public function testMoveException()
    {
        $this->expectException(\Exception::class);
        $state1 = new fsm\State('State1', ['0', '1']);
        $state2 = new fsm\State('State2', ['0', '1']);
        $state1->AddTransition('2', $state2);
        $state1->Move('0');
    }

    public function testInitialState()
    {
        $state = new fsm\State('State', ['0', '1']);
        $state->SetIsInitial(true);
        self::assertEquals(true, $state->IsInitial());
    }

    public function testFinalState()
    {
        $state = new fsm\State('State', ['0', '1']);
        $state->SetIsFinal(true);
        self::assertEquals(true, $state->IsFinal());
    }
}
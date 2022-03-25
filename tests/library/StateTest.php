<?php

use PHPUnit\Framework\TestCase;
require __DIR__ . '/../../vendor/autoload.php';

class StateTest extends TestCase
{
    public function testConstructNull()
    {
        $this->expectException(TypeError::class);
        $x = new FSM\State(NULL);
    }

    public function testConstructorEmpty()
    {
        $this->expectException(ArgumentCountError::class);
        $x = new FSM\State();
    }

    public function testConstructValid()
    {
        $stateName = "State1";
        $x = new FSM\State($stateName);
        self::assertInstanceOf('State', $x);
        self::assertEquals($stateName, $x->Name());
    }

    public function testMove()
    {
        $state1 = new FSM\State("State1");
        $state2 = new FSM\State("State2");
        $state1->AddTransition("2", $state2);
        assertEquals($state2, $state1->Move("2"));
    }

    public function testInitialState()
    {
        $state = new FSM\State("State");
        $state->SetIsInitial(true);
        assertEquals(true, $state->IsInitial());
    }

    public function testFinalState()
    {
        $state = new FSM\State("State");
        $state->SetIsFinal(true);
        assertEquals(true, $state->IsFinal());
    }
}
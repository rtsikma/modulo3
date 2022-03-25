<?php

use PHPUnit\Framework\TestCase;

class StateMachineTest extends TestCase
{
    public function testConstructor()
    {
        $x = new FSM\StateMachine();
        assertInstanceOf('StateMachine', $x);
    }

    public function testAddStates()
    {
        $x = new FSM\StateMachine();
        $state = new FSM\State();
        $state->SetIsInitial(true);
        $state->SetIsFinal(true);
        $x->AddState($state);
        assertEquals([$state], $x->GetStates());
        assertEquals($state, $x->GetCurrentState());
        assertEquals([$state], $x->GetFinalStates());
    }

}
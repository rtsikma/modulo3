<?php

use fsm;
use PHPUnit\Framework\TestCase;

class StateMachineTest extends TestCase
{
    public function testConstructor()
    {
        $x = new fsm\StateMachine();
        self::assertInstanceOf('fsm\StateMachine', $x);
    }

    public function testAddStates()
    {
        $x = new fsm\StateMachine();
        $state = new fsm\State('State1', ['0', '1']);
        $state->SetIsInitial(true);
        $state->SetIsFinal(true);
        $x->AddState($state);
        self::assertEquals([$state], $x->GetStates());
        self::assertEquals($state, $x->GetInitialState());
        self::assertEquals($state, $x->GetCurrentState());
        self::assertEquals([$state], $x->GetFinalStates());
    }

    public function testAddStatesException()
    {
        $this->expectException(\Exception::class);
        $x = new fsm\StateMachine();
        $state1 = new fsm\State('State1', ['0', '1']);
        $state2 = new fsm\State('State2', ['0', '1']);
        $state1->SetIsInitial(true);
        $state1->SetIsFinal(true);
        $state2->SetIsInitial(true);
        $state2->SetIsFinal(true);
        $x->AddState($state1);
        $this->expectException(\Exception::class);
        $x->AddState($state2);
    }
}

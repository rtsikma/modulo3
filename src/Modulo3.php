<?php

namespace modulo3;

use FSM\StateMachineRunner;
use FSM\StateMachine;
use FSM\State;

class Modulo3 implements StateMachineRunner
{
    private string $LastError;
    private string $input;
    private StateMachine $StateMachine;


    public function __construct(string $input = null)
    {
        $this->input = $input;
        $this->StateMachine = new StateMachine();
    }

    public function SetInput($input)
    {
        $this->input = $input;
    }

    public function Init()
    {
        $allInputs = ["0", "1"];
        $s0 = new State("S0", $allInputs);
        $s0->SetIsInitial(true);
        $s0->SetIsFinal(true);
        $s1 = new State("S1", $allInputs);
        $s1->SetIsFinal(true);
        $s2 = new State("S2", $allInputs);
        $s2->SetIsFinal(true);

        $s0->AddTransition("0", $s0)->AddTransition("1", $s1);
        $s1->AddTransition("0", $s2)->AddTransition("1", $s0);
        $s2->AddTransition("0", $s1)->AddTransition("1", $s2);

        $this->StateMachine->addState($s0);
        $this->StateMachine->addState($s1);
        $this->StateMachine->addState($s2);
    }

    public function run() : bool
    {
        try {
            $allInputs = str_split($this->input);
            foreach ($allInputs as $input) {
                $this->StateMachine->Step($input);
            }
        } catch (Exception $e) {
            $name = $this->StateMachine->GetCurrentState()->Name();
            $this->LastError = "Error stepping from $name: " . $e->getMessage();
            return false;
        }
        return true;
    }

    public function GetLastError(): string
    {
        return $this->LastError;
    }
}

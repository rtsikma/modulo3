<?php

namespace modulo3;
use fsm\State;
use fsm\StateMachine;
use fsm\StateMachineRunner;

class Modulo3 implements StateMachineRunner
{
    private string $LastError;
    private string $input;
    private StateMachine $StateMachine;

    /**
     * @param string $input
     * @throws \Exception
     */
    public function __construct(string $input)
    {
        $this->SetInput($input);
        $this->StateMachine = new StateMachine();

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

    /**
     * Validates that the string only consists of zeros and ones
     *
     * @param string $input
     * @return bool
     */
    private function isBinaryString(string $input) : bool
    {
        return preg_match("/^[01]+$/", $input);
    }

    public function SetInput($input)
    {
        if (!$this->isBinaryString($input))
            throw new \InvalidArgumentException("Invalid Input: Expecting 0's and 1's");
        $this->input = $input;
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

    public function GetResult() : string
    {
        $state = $this->StateMachine->GetCurrentState();
        return str_replace('S', '', $state->Name());
    }
}

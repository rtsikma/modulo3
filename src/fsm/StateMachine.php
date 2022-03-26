<?php

namespace fsm;
use Exception;

class StateMachine
{
    private array $States = [];
    private State $InitialState;
    private State $CurrentState;
    private array $FinalStates = [];

    public function __construct()
    {

    }

    /**
     * Adds a new state to the state machine
     * @param State $state
     * @return void
     * @throws Exception
     */
    public function AddState(State $state)
    {
        $this->States[] = $state;
        if ($state->IsInitial()) {
            if (!empty($this->InitialState)) {
                $stateName = $state->Name();
                throw new Exception("Adding more than one initial state $stateName");
            }
            $this->InitialState = $state;
            $this->CurrentState = $state;
        }
        if ($state->IsFinal())
            $this->FinalStates[] = $state;
    }

    /**
     * Gets all states
     *
     * @return array
     */
    public function GetStates(): array
    {
        return $this->States;
    }

    /**
     * Returns the initial state
     *
     * @return State
     */
    public function GetInitialState(): State
    {
        return $this->InitialState;
    }

    /**
     * Returns the current state
     * @return State
     */
    public function GetCurrentState(): State
    {
        return $this->CurrentState;
    }

    /**
     * Returns the list of valid final states
     * @return array
     */
    public function GetFinalStates(): array
    {
        return $this->FinalStates;
    }

    /**
     * @param string $input
     * @return void
     * @throws Exception
     */
    public function Step(string $input)
    {
        $this->CurrentState = $this->CurrentState->Move($input);
    }
}

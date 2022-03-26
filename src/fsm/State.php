<?php

namespace fsm;


class State
{
    // Name of the State
    private string $Name;
    // All possible inputs
    private array $allInputs;
    // Map of input to new states
    private array $Transitions = [];
    private bool $isFinal = false;
    private bool $isInitial = false;

    public function __construct($name, array $inputs)
    {
        $this->Name = $name;
        $this->allInputs = $inputs;
    }

    /**
     * Adds a transition from one state to another, given an input
     *
     * @param string $input
     * @param State $newState
     * @return $this
     * @throws \Exception
     */
    public function AddTransition(string $input, State $newState): State
    {
        if (in_array($input, $this->allInputs)) {
            $this->Transitions[$input] = $newState;
            return $this;
        }
        throw new \Exception("Invalid Input");
    }

    /**
     * Move from this state to the next state based on the given transition
     *
     * @param string $input The input for the transition
     * @return State The new State
     * @throws \Exception
     */
    public function Move(string $input): State
    {
        if (isset($this->Transitions[$input])) {
            return $this->Transitions[$input];
        }
        throw new \Exception("No Transition found for $input");
    }

    /**
     * Sets whether this state is the initial state
     *
     * @param bool $isInitial
     * @return void
     */
    public function SetIsInitial(bool $isInitial)
    {
        $this->isInitial = $isInitial;
    }

    /**
     * Sets whether this state is a final state
     *
     * @param bool $isFinal
     * @return void
     */
    public function SetIsFinal(bool $isFinal)
    {
        $this->isFinal = $isFinal;
    }

    /**
     * Returns if the state is the initial state
     *
     * @return bool
     */
    public function IsInitial(): bool
    {
        return $this->isInitial;
    }

    /**
     * Returns if the state is a final state
     *
     * @return bool
     */
    public function IsFinal(): bool
    {
        return $this->isFinal;
    }

    public function Name(): string
    {
        return $this->Name;
    }
}

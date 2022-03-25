<?php

namespace FSM;

interface StateMachineRunner
{
    public function run(): bool;
    public function GetLastError(): string;

}
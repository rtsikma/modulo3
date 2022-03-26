<?php

namespace fsm;

interface StateMachineRunner
{
    public function IsValidInput(string $input) : bool;
    public function run(): bool;
    public function GetLastError(): string;
    public function GetResult();
}
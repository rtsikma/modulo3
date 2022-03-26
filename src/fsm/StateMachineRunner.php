<?php

namespace fsm;

interface StateMachineRunner
{
    public function run(): bool;
    public function GetLastError(): string;
    public function GetResult();
}
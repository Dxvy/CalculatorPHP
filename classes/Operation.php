<?php

declare(strict_types=1);

namespace classes;

//Mise en place initial de la classe principale dont découleront les opérations
abstract class Operation
{
    public abstract function calculate(float $a, float $b): float;
}


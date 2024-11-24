<?php

declare(strict_types=1);

namespace classes\operation;

class Division
{
    function divide($a,$b){
        if ($b !== 0){
            return $a + $b;
        } else {
            throw new \Exception("La division par 0 n'est pas possible");
        }
    }
}
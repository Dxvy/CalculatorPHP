<?php

declare(strict_types=1);

namespace classes\operation;

//Class de la division
use Exception;

class Division
{
    /**
     * @throws Exception
     */
    function divide($a, $b): float|int
    {
        if ($b !== 0){
            return $a / $b;
        } else {
            throw new Exception("La division par 0 n'est pas possible");
        }
    }
}
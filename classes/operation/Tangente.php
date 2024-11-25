<?php

declare(strict_types=1);

namespace classes\operation;

//Class de la tangente
use classes\Operation;

class Tangente
{
    function tan($angle): float
    {
        return tan(deg2rad($angle));
    }
}
<?php

declare(strict_types=1);

namespace classes\operation;

//Class de sinus
class Sinus
{
    function sin($angle): float
    {
        return sin(deg2rad($angle));
    }
}
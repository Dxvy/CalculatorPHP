<?php

declare(strict_types=1);

namespace classes\operation;

class Sinus
{
    function sin($angle)
    {
        return sin(deg2rad($angle));
    }
}
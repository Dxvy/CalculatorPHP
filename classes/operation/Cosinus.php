<?php

declare(strict_types=1);

namespace classes\operation;

//Class de cosinus

class Cosinus
{
    function cos($angle): float
    {
        return cos(deg2rad($angle));
    }
}
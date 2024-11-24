<?php

declare(strict_types=1);

namespace classes\operation;

class Cosinus
{
    function cos($angle)
    {
        return cos(deg2rad($angle));
    }
}
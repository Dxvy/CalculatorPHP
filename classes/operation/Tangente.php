<?php

declare(strict_types=1);

namespace classes\operation;

class Tangente
{
    function tan($angle)
    {
        return tan(deg2rad($angle));
    }
}
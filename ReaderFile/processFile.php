<?php

declare(strict_types=1);

namespace ReaderFile;

use mysql_xdevapi\Exception;

class processFile
{
    function evaluateExpression($expression)
    {
        // Suppression des espaces
        $expression = preg_replace('/\s+/', '', $expression);

        // Utilisation de eval (à utiliser avec précaution)
        return eval("return $expression;");
    }

    function processFile($filename)
    {
        if (file_exists($filename)) {
            $file = fopen($filename, "r");
            while (($line = fgets($file)) !== false) {
                try {
                    $result = $this->evaluateExpression($line);
                    echo "Resultat pour '$line' : '$result\n'";
                } catch (Exception $e) {
                    echo "Erreur dans l'expression '$line': " . $e->getMessage() . "\n";
                }
            }
            fclose($file);
        } else {
            echo "Le fichier n'existe pas";
        }
    }
}
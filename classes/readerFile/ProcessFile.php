<?php

declare(strict_types=1);

namespace classes\readerFile;

use DivisionByZeroError;
use InvalidArgumentException;
use mysql_xdevapi\Exception;
use Throwable;

require_once 'classes\parser\Parser.php';

class  ProcessFile
{
    function processFile($filename): string
    {
        global $parser;

        if (!file_exists($filename)) {
            return "Error: File does not exist.";
        }

        $file = fopen($filename, "r");
        $results = [];
        $errors = [];

        while (($line = fgets($file)) !== false) {
            $line = trim($line); // Supprime les espaces inutiles et les retours à la ligne
            if (empty($line)) {
                continue; // Ignore les lignes vides
            }

            try {
                $result = $parser->calculate($line);
                $results[] = "Result for '$line': $result\n";
            } catch (DivisionByZeroError $e) {
                $errors[] = "Error in '$line': Division by zero is not allowed.";
            } catch (InvalidArgumentException $e) {
                $errors[] = "Error in '$line': Invalid argument - " . $e->getMessage();
            } catch (Throwable $e) {
                $errors[] = "Error in '$line': An unexpected error occurred - " . $e->getMessage();
            }
        }

        fclose($file);

        // Compile the results and errors into a single string
        $output = "Processing results for file '$filename':\n";
        if (!empty($results)) {
            $output .= implode("\n", $results) . "\n";
        }
        if (!empty($errors)) {
            $output .= "Errors:\n" . implode("\n", $errors) . "\n";
        }
        return $output;
    }

}
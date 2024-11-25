<?php

declare(strict_types=1);

use classes\parser\Parser;
use classes\readerFile\ProcessFile;

require_once 'classes\parser\Parser.php';
require_once 'classes\readerFile\ProcessFile.php';

echo "\n~~~~~~ Welcome to Calculator 2000, press Enter to process ~~~~~~\n";

$parser = new Parser();
$processFile = new ProcessFile();

while (true) {
    echo "\nEnter an expression or file path (or 'exit' to quit): ";
    $expression = trim(fgets(STDIN));

    if ($expression === 'exit') {
        break;
    }

    try {
        if (file_exists($expression) && is_file($expression)) {
            // Si l'entrée est un fichier texte, on le traite
            $expression_process = $processFile->processFile($expression);
            echo "Processed file result: $expression_process\n";
        } else {
            // Sinon, on traite l'expression comme une formule mathématique
            $expression_parser = $parser->calculate($expression);
            echo "$expression = $expression_parser\n";
        }
    } catch (DivisionByZeroError $e) {
        echo "Error: Division by zero is not allowed.\n";
    } catch (InvalidArgumentException $e) {
        echo "Error: Invalid argument - " . $e->getMessage() . "\n";
    } catch (Throwable $e) {
        echo "An unexpected error occurred: " . $e->getMessage() . "\n";
    }
}

echo "Exiting calculator.\n";

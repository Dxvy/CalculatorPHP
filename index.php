<?php

declare(strict_types=1);

use /**
 * The Parser class is responsible for parsing input data into a more structured format.
 * It provides methods to process strings and extract meaningful information.
 *
 * Methods:
 * - __construct(): Initializes the Parser object.
 * - parse(string $input): Parses the given input string and returns the structured data.
 * - setUpRules(array $rules): Configures the parsing rules.
 * - getError(): Returns any errors encountered during parsing.
 *
 * Example:
 * Instantiate the Parser class and use the parse method to process input data.
 */
    classes\parser\Parser;
use /**
 * Class ProcessFile
 *
 * The ProcessFile class is responsible for handling the processing of file data.
 * It includes methods for opening a file, reading its content, processing the
 * data, and closing the file. The class ensures that proper error handling is
 * in place to manage issues that may arise during file operations.
 *
 * Methods:
 * - __construct: Initializes the ProcessFile class.
 * - openFile: Opens a file for reading.
 * - readFile: Reads the content of the file.
 * - processData: Processes the data read from the file.
 * - closeFile: Closes the file.
 */
    classes\readerFile\ProcessFile;

require_once 'classes\parser\Parser.php';
require_once 'classes\readerFile\ProcessFile.php';

echo "\n~~~~~~ Welcome to Calculator 2000, press Enter to process ~~~~~~\n";

/**
 * The `$parser` variable is an instance of a class responsible for interpreting and analyzing a given input text
 * according to specific grammar and syntax rules. The primary functionality of this parser includes tokenizing
 * the input string, creating an abstract syntax tree (AST), and performing semantic analysis to check the input
 * for any errors or inconsistencies.
 *
 * - Tokenization: Splits the input text into smaller units called tokens.
 * - Parsing: Constructs an AST from the tokens to represent the syntax structure of the input.
 * - Semantic Analysis: Ensures that the produced AST adheres to the specific language rules and constraints.
 */
$parser = new Parser();
/**
 * @var callable $processFile
 *
 * Represents a function or method that processes a file.
 * The callable takes a file path as its parameter and performs
 * a specific operation on the file, which could include reading,
 * writing, transforming, or analyzing its content.
 *
 * The callable is expected to handle potential errors internally
 * and may return a boolean indicating the success or failure of
 * the operation, or any other type pertinent to the specific
 * file processing logic implemented.
 *
 * Example of possible operations:
 * - Reading a file's content and processing the data.
 * - Writing data to a specified file.
 * - Transforming file content.
 * - Analyzing file metadata.
 */
$processFile = new ProcessFile();

while (true) {
    echo "\nEnter an expression or file path (or 'exit' to quit): ";
    /**
     * Represents a mathematical or logical statement that can be evaluated to return a value.
     *
     * $expression can consist of variables, operators, and function calls.
     * It is commonly used in conditions, calculations, and assignments.
     *
     * Intended for use where dynamic expressions need to be evaluated
     * within the codebase. Ensures flexibility in constructing and
     * processing various expressions programmatically.
     *
     * @var mixed $expression The expression to be evaluated. Its type varies
     * depending on the context, but typically it is a string representing
     * the formula or logic to be executed.
     */
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

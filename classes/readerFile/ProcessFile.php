<?php

declare(strict_types=1);

/**
 * The ProcessFile class is responsible for reading and processing the contents of a file.
 * It uses a global parser to evaluate each line of the file, handling different types of exceptions
 * that may occur during the parsing process. The results and errors are accumulated and returned as a string.
 */

namespace classes\readerFile;

use /**
 * DivisionByZeroError is an exception class that handles errors
 * related to division by zero operations.
 *
 * It extends the standard Error class, providing a means to
 * catch and handle situations where a divisor is zero, such as
 * in arithmetic calculations or algorithms that require non-zero
 * divisors.
 *
 * Example usage might include catching this exception to provide
 * a meaningful error message to the user or to perform alternative
 * logic when division by zero is attempted.
 *
 * Methods:
 * - __construct: Initializes a new instance of the DivisionByZeroError class.
 * - getMessage: Returns the message string of the exception.
 * - getCode: Returns the exception code.
 * - getFile: Returns the filename in which the exception was created.
 * - getLine: Returns the line number at which the exception was created.
 * - getTrace: Returns the stack trace.
 * - getTraceAsString: Returns the stack trace as a string.
 * - __toString: Returns string representation of the exception.
 *
 * Example:
 * try {
 *     $result = $numerator / $denominator;
 * } catch (DivisionByZeroError $e) {
 *     echo $e->getMessage();
 * }
 */
    DivisionByZeroError;
use /**
 * Class InvalidArgumentException
 *
 * This exception is thrown when a function receives an argument
 * that is not within the expected range or type.
 * It extends the base Exception class and provides custom messaging
 * for invalid arguments.
 *
 * Usage:
 * This exception should be thrown in methods or functions
 * where parameter validation fails.
 *
 * Example:
 * throw new InvalidArgumentException('Expected a positive integer.');
 */
    InvalidArgumentException;
use /**
 * Class Exception
 *
 * This class represents an exception returned by the MySQL X DevAPI.
 * It extends the base Exception class provided by PHP.
 *
 * Attributes:
 * - Inherits all public methods from PHP's built-in Exception class.
 *
 * Example usage involves catching this specific type of exception when performing
 * operations using the MySQL X DevAPI, allowing for more granular error handling
 * and debugging.
 *
 * Features:
 * - Can be used to retrieve detailed information about errors during MySQL X DevAPI operations.
 *
 * It is primarily used internally within the MySQL X DevAPI implementation,
 * ensuring consistency in error reporting.
 *
 * The actual message and code properties will hold specific details about the
 * encountered error, which can be accessed through the standard Exception methods.
 */
    mysql_xdevapi\Exception;
use /**
 * Interface Throwable
 *
 * The Throwable interface is the base interface for any object that can be thrown
 * via a throw statement in PHP, including Exception and Error objects.
 */
    Throwable;

require_once 'classes\parser\Parser.php';

/**
 * The ProcessFile class is responsible for processing a given file, performing
 * calculations on each line, and compiling the results and errors.
 */
class  ProcessFile
{
    function processFile($filename): string
    {
        global $parser;

        if (!file_exists($filename)) {
            return "\nError: File does not exist.";
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
                $results[] = "\nResult for '$line': $result";
            } catch (DivisionByZeroError $e) {
                $errors[] = "\nError in '$line': Division by zero is not allowed.";
            } catch (InvalidArgumentException $e) {
                $errors[] = "\nError in '$line': Invalid argument - " . $e->getMessage();
            } catch (Throwable $e) {
                $errors[] = "\nError in '$line': An unexpected error occurred - " . $e->getMessage();
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
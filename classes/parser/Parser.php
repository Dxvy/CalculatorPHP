<?php

declare(strict_types=1);

namespace classes\parser;

use classes\operation\Addition;
use classes\operation\Division;
use classes\operation\Multiplication;
use classes\operation\Soustraction;
use Exception;
use Throwable;

require_once 'classes/operation/Addition.php';
require_once 'classes/operation/Soustraction.php';
require_once 'classes/operation/Multiplication.php';
require_once 'classes/operation/Division.php';

$addition = new Addition();
$soustraction = new Soustraction();
$multiplication = new Multiplication();
$division = new Division();

class Parser
{
    /**
     * Calculates the result of a mathematical expression.
     *
     * @param string $expression The infix mathematical expression to be calculated.
     * @return float|int|string The result of evaluating the expression.
     * @throws Exception
     */
    
    function calculate(string $expression): float|int|string
    {
        // Remove whitespace from the expression
        $expression = str_replace(' ', '', $expression);

        // Handle parentheses and split into tokens
        $expression = preg_replace('#([+\-*/()])#', ' $1 ', $expression);
        $tokens = array_filter(explode(' ', $expression));

        // Convert infix to postfix (Reverse Polish Notation) using Shunting-Yard Algorithm
        $outputQueue = [];
        $operatorStack = [];
        $precedence = ['+' => 1, '-' => 1, '*' => 2, '/' => 2];
        $associativity = ['+' => 'L', '-' => 'L', '*' => 'L', '/' => 'L'];

        foreach ($tokens as $token) {
            if (is_numeric($token)) {
                // If token is a number, add it to the output queue
                $outputQueue[] = floatval($token);
            } elseif (in_array($token, ['+', '-', '*', '/'])) {
                // While the operator at the top of the stack has higher precedence
                while (!empty($operatorStack)) {
                    $top = end($operatorStack);
                    if (isset($precedence[$top]) &&
                        (($associativity[$token] === 'L' && $precedence[$token] <= $precedence[$top]) ||
                            ($associativity[$token] === 'R' && $precedence[$token] < $precedence[$top]))) {
                        $outputQueue[] = array_pop($operatorStack);
                    } else {
                        break;
                    }
                }
                $operatorStack[] = $token;
            } elseif ($token === '(') {
                // Push left parenthesis onto the stack
                $operatorStack[] = $token;
            } elseif ($token === ')') {
                // Pop operators until left parenthesis is found
                while (!empty($operatorStack) && end($operatorStack) !== '(') {
                    $outputQueue[] = array_pop($operatorStack);
                }
                if (end($operatorStack) === '(') {
                    array_pop($operatorStack);
                }
            }
        }

        // Pop all remaining operators onto the output queue
        while (!empty($operatorStack)) {
            $outputQueue[] = array_pop($operatorStack);
        }

        // Evaluate the postfix expression
        $evaluationStack = [];
        foreach ($outputQueue as $item) {
            if (is_numeric($item)) {
                $evaluationStack[] = $item;
            } else {
                $b = array_pop($evaluationStack);
                $a = array_pop($evaluationStack);
                $evaluationStack[] = $this->calculateOperation($item, $a, $b);
            }
        }

        // The result is the last item on the stack
        return $evaluationStack[0];
    }

// Helper function to perform operations

    /**
     * Performs a mathematical operation based on the given operator.
     *
     * @param string $operator The operator indicating the operation to be performed.
     * @param float|int $operand1 The first operand for the operation.
     * @param float|int $operand2 The second operand for the operation.
     * @return float|int The result of the operation.
     * @throws Exception If the operator is not valid.
     */
    function calculateOperation(string $operator, float|int $operand1, float|int $operand2): float|int
    {
        global $addition, $soustraction, $multiplication, $division;
        return match ($operator) {
            '+' => $addition->add($operand1, $operand2),
            '-' => $soustraction->soustract($operand1, $operand2),
            '*' => $multiplication->multiply($operand1, $operand2),
            '/' => $division->divide($operand1, $operand2),
            default => throw new Exception("Invalid operator: $operator"),
        };
    }
}
<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression;

use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\InterpreterContextInterface;

/**
 * Class CommandArrayExpression
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class CommandArrayExpression extends AbstractExpression
{
    private $array;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function interpret(InterpreterContextInterface $context)
    {
        $interpretedArray = [];

        foreach ($this->array as $key => $expression) {
            $expression->interpret($context);
            $interpretedArray[$key] = $context->lookup($expression);
        }

        $result = $this->runCommand($interpretedArray);

        $context->replace($this, $result);
    }

    private function runCommand(array $arrayExpression)
    {
        $arrayExpression['__PERFORMED__'] = true;

        return $arrayExpression;
    }
}

<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression;

use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\InterpreterContextInterface;

/**
 * Class PlainArrayExpression
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class PlainArrayExpression extends AbstractExpression
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

        $context->replace($this, $interpretedArray);
    }
}

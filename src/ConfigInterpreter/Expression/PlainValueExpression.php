<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\InterpreterContextInterface;

/**
 * Represents a plain value. It doesn't change the value.
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class PlainValueExpression extends AbstractExpression
{
    private $expressionValue;
    
    public function __construct($value)
    {
        $this->expressionValue = $value;
    }
    
    public function interpret(InterpreterContextInterface $context)
    {
        $context->replace($this, $this->expressionValue);
    }
}

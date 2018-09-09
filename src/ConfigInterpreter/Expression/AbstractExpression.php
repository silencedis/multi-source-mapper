<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\InterpreterContext;

/**
 * Abstract expression that implements ExpressionInteface functionality partially.
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
abstract class AbstractExpression implements Expression
{
    private $key = null;
    
    /**
     * @inheritDoc
     */
    abstract function interpret(InterpreterContext $context);
    
    public function getKey(): string
    {
        if ($this->key === null) {
            $this->key = uniqid();
        }
        
        return $this->key;
    }
}

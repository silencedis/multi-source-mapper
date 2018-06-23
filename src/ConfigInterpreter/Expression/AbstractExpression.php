<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression;

use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\ExpressionInterface;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\InterpreterContextInterface;

/**
 * Class AbstractExpression
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
abstract class AbstractExpression implements ExpressionInterface
{
    private $key = null;
    
    abstract function interpret(InterpreterContextInterface $context);
    
    public function getKey(): string
    {
        if ($this->key === null) {
            $this->key = uniqid();
        }
        
        return $this->key;
    }
}

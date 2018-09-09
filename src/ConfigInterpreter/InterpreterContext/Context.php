<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\Expression;

/**
 * Class Context
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
final class Context implements InterpreterContext
{
    private $storage = [];
    
    public function replace(Expression $expression, $value)
    {
        $this->storage[$expression->getKey()] = $value;
    }
    
    public function lookup(Expression $expression)
    {
        return $this->storage[$expression->getKey()] ?? null;
    }
}

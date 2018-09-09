<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\Expression;

/**
 * Class DefaultInterpreterContext
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
final class DefaultInterpreterContext implements InterpreterContext
{
    /**
     * Array of values
     *
     * @var array
     */
    private $storage = [];
    
    /**
     * @inheritDoc
     */
    public function replace(Expression $expression, $value)
    {
        $this->storage[$expression->getKey()] = $value;
    }
    
    /**
     * @inheritDoc
     */
    public function lookup(Expression $expression)
    {
        return $this->storage[$expression->getKey()] ?? null;
    }
}

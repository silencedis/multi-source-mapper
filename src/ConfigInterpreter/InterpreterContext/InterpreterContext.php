<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\Expression;

/**
 * Represents a required functionality of interpreter context
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface InterpreterContext
{
    /**
     * @param Expression $expression
     * @param $value
     *
     * @return mixed
     */
    public function replace(Expression $expression, $value);
    
    /**
     * @param Expression $expression
     *
     * @return mixed
     */
    public function lookup(Expression $expression);
}

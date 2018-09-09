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
     * Sets new value, that corresponds to an expression
     *
     * @param Expression $expression Expression object
     * @param mixed $value A value, that corresponds to the expression
     *
     * @return mixed
     */
    public function replace(Expression $expression, $value);
    
    /**
     * Returns a value, corresponding to an expression
     *
     * @param Expression $expression Expression, for which a value will be searched.
     *
     * @return mixed
     */
    public function lookup(Expression $expression);
}

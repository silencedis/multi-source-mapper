<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\Expression;

/**
 * Instantiates a configuration expression.
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface ExpressionInstantiator
{
    /**
     * Indicates whether the instantiator recognizes a value as a raw expression
     * that can be used to create an expression object.
     *
     * @param mixed $value A value that may represent an expression
     *
     * @return bool
     */
    public function recognizes($value): bool;
    
    /**
     * Instantiates an instance of {@see Expression}.
     *
     * @param mixed $value A value to create an expression based on it.
     *
     * @return \SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\Expression
     *
     * @throws CannotInstantiateExpression Throws an exception when instantiator cannot instantiate an expression.
     * For example when expression doesn't recognize a value but despite that the instantiation was called.
     */
    public function instantiate($value): Expression;
}

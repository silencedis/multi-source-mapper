<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter;

/**
 * Instantiates configuration expressions.
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface ExpressionInstantiatorInterface
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
     * Instantiates an instance of {@see ExpressionInterface}.
     *
     * @param mixed $value A value to create an expression based on it.
     *
     * @return ExpressionInterface
     */
    public function instantiate($value): ExpressionInterface;
}

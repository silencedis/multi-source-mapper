<?php

namespace SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter;

/**
 * Interface ExpressionInstantiatorInterface
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface ExpressionInstantiatorInterface
{
    public function recognizes($value): bool;
    
    /**
     * Instantiates an instance of {@see ExpressionInterface}.
     *
     * @param mixed $value A value to create an expression based on it.
     * @param SyntaxTreeBuilderInterface $builder An instance of {@see SyntaxTreeBuilderInterface}.
     * It may be used to delegate to it the value analysis and building internal expressions.
     *
     * @return ExpressionInterface
     */
    public function instantiate($value, SyntaxTreeBuilderInterface $builder): ExpressionInterface;
}

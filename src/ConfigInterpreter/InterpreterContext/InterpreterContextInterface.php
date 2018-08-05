<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\ExpressionInterface;

/**
 * Represents a required functionality of interpreter context
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface InterpreterContextInterface
{
    /**
     * @param ExpressionInterface $expression
     * @param $value
     *
     * @return mixed
     */
    public function replace(ExpressionInterface $expression, $value);
    
    /**
     * @param ExpressionInterface $expression
     *
     * @return mixed
     */
    public function lookup(ExpressionInterface $expression);
}

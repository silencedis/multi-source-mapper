<?php

namespace SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter;

/**
 * Interface InterpreterContextInterface
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface InterpreterContextInterface
{
    public function replace(ExpressionInterface $expression, $value);

    public function lookup(ExpressionInterface $expression);
}

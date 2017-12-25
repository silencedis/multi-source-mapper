<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext;

use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\ExpressionInterface;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\InterpreterContextInterface;

/**
 * Class InterpreterContext
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class InterpreterContext implements InterpreterContextInterface
{
    private $storage = [];

    public function replace(ExpressionInterface $expression, $value)
    {
        $this->storage[$expression->getKey()] = $value;
    }

    public function lookup(ExpressionInterface $expression)
    {
        return $this->storage[$expression->getKey()] ?? null;
    }
}

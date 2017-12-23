<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\CommandStringExpression;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\ExpressionInstantiatorInterface;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\ExpressionInterface;

/**
 * Class CommandStringExpressionInstantiator
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class CommandStringExpressionInstantiator implements ExpressionInstantiatorInterface
{
    public function recognizes($value): bool
    {
        return is_string($value) &&
               strncmp($value, '!', 1) === 0;
    }
    
    public function instantiate($value): ExpressionInterface
    {
        return new CommandStringExpression($value);
    }
}

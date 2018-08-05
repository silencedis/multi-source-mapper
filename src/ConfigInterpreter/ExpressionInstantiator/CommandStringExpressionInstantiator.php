<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\StringCommandResolver;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\StringCommandExpression;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiatorInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\SyntaxTreeBuilderInterface;

/**
 * Class CommandStringExpressionInstantiator
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class CommandStringExpressionInstantiator implements ExpressionInstantiatorInterface
{
    /**
     * @inheritDoc
     */
    public function recognizes($value): bool
    {
        return is_string($value) &&
               strncmp($value, '!', 1) === 0;
    }
    
    /**
     * @inheritDoc
     */
    public function instantiate($value): ExpressionInterface
    {
        return new StringCommandExpression($value, new StringCommandResolver());
    }
}

<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\StringCommandResolver;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\Expression;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\StringCommandExpression;

/**
 *
 * Instantiates {@see \SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\StringCommandExpression}
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
final class CommandStringExpressionInstantiator implements ExpressionInstantiator
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
    public function instantiate($value): Expression
    {
        return new StringCommandExpression($value, new StringCommandResolver());
    }
}

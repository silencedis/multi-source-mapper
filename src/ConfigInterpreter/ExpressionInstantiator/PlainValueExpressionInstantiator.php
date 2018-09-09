<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\Expression;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\PlainValueExpression;

/**
 * Instantiates {@see \SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\PlainValueExpression}
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
final class PlainValueExpressionInstantiator implements ExpressionInstantiator
{
    /**
     * @inheritDoc
     */
    public function recognizes($value): bool
    {
        return true;
    }
    
    /**
     * @inheritDoc
     */
    public function instantiate($value): Expression
    {
        return new PlainValueExpression($value);
    }
}

<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\ExpressionInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\PlainValueExpression;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\SyntaxTreeBuilderInterface;

/**
 * Instantiates {@see \SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\PlainValueExpression}
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class PlainValueExpressionInstantiator implements ExpressionInstantiatorInterface
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
    public function instantiate($value): ExpressionInterface
    {
        return new PlainValueExpression($value);
    }
}

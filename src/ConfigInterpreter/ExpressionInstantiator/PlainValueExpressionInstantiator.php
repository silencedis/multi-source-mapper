<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\PlainValueExpression;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiatorInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\SyntaxTreeBuilderInterface;

/**
 * Class PlainValueExpressionInstantiator
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

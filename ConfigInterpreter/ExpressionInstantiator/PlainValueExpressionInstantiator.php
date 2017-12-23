<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\PlainValueExpression;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\ExpressionInstantiatorInterface;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\ExpressionInterface;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\SyntaxTreeBuilderInterface;

/**
 * Class PlainValueExpressionInstantiator
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class PlainValueExpressionInstantiator implements ExpressionInstantiatorInterface
{
    public function recognizes($value): bool
    {
        return true;
    }

    public function instantiate($value, SyntaxTreeBuilderInterface $builder): ExpressionInterface
    {
        return new PlainValueExpression($value);
    }
}

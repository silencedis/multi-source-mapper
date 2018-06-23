<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\PlainArrayExpression;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiatorInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\SyntaxTreeBuilderInterface;

/**
 * Class PlainArrayExpressionInstantiator
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class PlainArrayExpressionInstantiator implements ExpressionInstantiatorInterface
{
    public function recognizes($value): bool
    {
        return is_array($value);
    }
    
    public function instantiate($value, SyntaxTreeBuilderInterface $builder): ExpressionInterface
    {
        $rebuildedArray = [];
        
        foreach ($value as $k => $v) {
            $rebuildedArray[$k] = $builder->build($v);
        }
        
        return new PlainArrayExpression($rebuildedArray);
    }
}

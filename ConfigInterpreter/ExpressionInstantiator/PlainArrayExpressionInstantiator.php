<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\PlainArrayExpression;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\ExpressionInstantiatorInterface;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\ExpressionInterface;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\SyntaxTreeBuilderInterface;

/**
 * Class PlainArrayExpressionInstantiator
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class PlainArrayExpressionInstantiator implements ExpressionInstantiatorInterface
{
    private $syntaxTreeBuilder;
    
    public function __construct(SyntaxTreeBuilderInterface $syntaxTreeBuilder)
    {
        $this->syntaxTreeBuilder = $syntaxTreeBuilder;
    }
    
    public function recognizes($value): bool
    {
        return is_array($value);
    }
    
    public function instantiate($value): ExpressionInterface
    {
        $rebuildedArray = [];
        
        foreach ($value as $k => $v) {
            $rebuildedArray[$k] = $this->syntaxTreeBuilder->instantiateExpression($v);
        }
        
        return new PlainArrayExpression($rebuildedArray);
    }
}

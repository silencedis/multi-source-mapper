<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\CommandArrayExpression;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\ExpressionInstantiatorInterface;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\ExpressionInterface;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\SyntaxTreeBuilderInterface;

/**
 * Class CommandArrayExpressionInstantiator
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class CommandArrayExpressionInstantiator implements ExpressionInstantiatorInterface
{
    private $syntaxTreeBuilder;
    
    public function __construct(SyntaxTreeBuilderInterface $syntaxTreeBuilder)
    {
        $this->syntaxTreeBuilder = $syntaxTreeBuilder;
    }
    
    public function recognizes($value): bool
    {
        if (!is_array($value)) {
            return false;
        }
        
        $commandKeys = ['_command', '!'];
        $arrayKeys   = array_keys($value);
        
        $filteredArrayKeys = array_filter($arrayKeys, function ($value) use ($commandKeys) {
            return in_array($value, $commandKeys);
        });
        
        return !empty($filteredArrayKeys);
    }
    
    public function instantiate($value): ExpressionInterface
    {
        $rebuildedArray = [];
        
        foreach ($value as $k => $v) {
            $rebuildedArray[$k] = $this->syntaxTreeBuilder->instantiateExpression($v);
        }
        
        return new CommandArrayExpression($rebuildedArray);
    }
}

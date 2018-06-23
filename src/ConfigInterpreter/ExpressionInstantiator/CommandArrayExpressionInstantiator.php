<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\ArrayCommandResolver;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Exception\ExpressionInstantiationFailedExceptionInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\ArrayCommandExpression;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiatorInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\SyntaxTreeBuilderInterface;

/**
 * Class CommandArrayExpressionInstantiator
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class CommandArrayExpressionInstantiator implements ExpressionInstantiatorInterface
{
    public function recognizes($value): bool
    {
        if (!is_array($value)) {
            return false;
        }
        
        $commandKeys = ['_command', '!'];
        $arrayKeys = array_keys($value);
        
        $filteredArrayKeys = array_filter(
            $arrayKeys,
            function ($value) use ($commandKeys) {
                return in_array($value, $commandKeys);
            }
        );
        
        return !empty($filteredArrayKeys);
    }
    
    /**
     * @param mixed $value
     * @param SyntaxTreeBuilderInterface $builder
     *
     * @return ExpressionInterface
     * @throws \SilenceDis\MultiSourceMapper\ConfigInterpreter\Exception\ExpressionInstantiationFailedExceptionInterface
     */
    public function instantiate($value, SyntaxTreeBuilderInterface $builder): ExpressionInterface
    {
        $rebuildedArray = [];
        
        foreach ($value as $k => $v) {
            $rebuildedArray[$k] = $builder->build($v);
        }
        
        return new ArrayCommandExpression($rebuildedArray, new ArrayCommandResolver());
    }
}

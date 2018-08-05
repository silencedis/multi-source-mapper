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
    /**
     * An instance of {@see SyntaxTreeBuilderInterface}.
     * The instantiator will delegate to it the value analysis and building internal expressions.
     *
     * @var SyntaxTreeBuilderInterface
     */
    private $syntaxTreeBuilder;
    
    /**
     * CommandArrayExpressionInstantiator constructor.
     *
     * @param SyntaxTreeBuilderInterface $syntaxTreeBuilder An instance of {@see SyntaxTreeBuilderInterface}.
     * The instantiator will delegate to it the value analysis and building internal expressions.
     */
    public function __construct(SyntaxTreeBuilderInterface $syntaxTreeBuilder)
    {
        $this->syntaxTreeBuilder = $syntaxTreeBuilder;
    }
    
    /**
     * @inheritDoc
     */
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
     * @inheritDoc
     */
    public function instantiate($value): ExpressionInterface
    {
        $rebuildedArray = [];
        
        foreach ($value as $k => $v) {
            $rebuildedArray[$k] = $this->syntaxTreeBuilder->build($v);
        }
        
        return new ArrayCommandExpression($rebuildedArray, new ArrayCommandResolver());
    }
}

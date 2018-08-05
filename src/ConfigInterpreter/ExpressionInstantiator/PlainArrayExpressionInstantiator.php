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
        return is_array($value);
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
        
        return new PlainArrayExpression($rebuildedArray);
    }
}

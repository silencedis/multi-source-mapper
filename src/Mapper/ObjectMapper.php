<?php

namespace SilenceDis\MultiSourceMapper\Mapper;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Exception\ExpressionInstantiationFailedExceptionInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\CommandArrayExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\CommandStringExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\PlainArrayExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\PlainValueExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\InterpreterContext;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\SyntaxTreeBuilder\SyntaxTreeBuilder;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\SyntaxTreeBuilderInterface;
use SilenceDis\MultiSourceMapper\Mapper\Exception\MapperException;

/**
 * Class ObjectMapper
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class ObjectMapper implements MapperInterface
{
    /**
     * @inheritDoc
     *
     * @throws MapperException
     */
    public function map($mapConfig)
    {
        // todo #improve An interpreter context factory dependency injection may be used to create instance of InterpreterContextInterface
        $context = new InterpreterContext();
        
        // todo #improve The syntax tree builder may be created outside of the mapper and injected into the mapper just to use it.
        $syntaxTreeBuilder = $this->prepareSyntaxTreeBuilder();
        
        try {
            // Build the high-level expression.
            $expression = $syntaxTreeBuilder->build($mapConfig);
        } catch (ExpressionInstantiationFailedExceptionInterface $e) {
            throw new MapperException('Failed to instantiate an expression');
        }
        
        $expression->interpret($context);
        
        return $context->lookup($expression);
    }
    
    private function prepareSyntaxTreeBuilder(): SyntaxTreeBuilderInterface
    {
        $syntaxTreeBuilder = new SyntaxTreeBuilder();
        
        $syntaxTreeBuilder->registerInstantiator(new CommandStringExpressionInstantiator());
        $syntaxTreeBuilder->registerInstantiator(new CommandArrayExpressionInstantiator($syntaxTreeBuilder));
        $syntaxTreeBuilder->registerInstantiator(new PlainArrayExpressionInstantiator($syntaxTreeBuilder));
        $syntaxTreeBuilder->registerInstantiator(new PlainValueExpressionInstantiator());
        
        return $syntaxTreeBuilder;
    }
}

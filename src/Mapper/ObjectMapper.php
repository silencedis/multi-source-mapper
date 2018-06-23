<?php

namespace SilenceDis\MultiSourceMapper\Mapper;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\CommandArrayExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\CommandStringExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\PlainArrayExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\PlainValueExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\InterpreterContext;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\SyntaxTreeBuilder\SyntaxTreeBuilder;
use SilenceDis\MultiSourceMapper\Mapper\Exception\MapperException;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\Exception\ExpressionInstantiationFailedExceptionInterface;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\SyntaxTreeBuilderInterface;
use SilenceDis\MultiSourceMapper\MsmInterface\Mapper\MapperInterface;

/**
 * Class ObjectMapper
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class ObjectMapper implements MapperInterface
{
    private $mapConfig;
    
    public function __construct($mapConfig)
    {
        $this->mapConfig = $mapConfig;
    }
    
    /**
     * @return mixed
     * @throws MapperException
     */
    public function map()
    {
        $context = new InterpreterContext();
        
        $syntaxTreeBuilder = $this->prepareSyntaxTreeBuilder();
        
        try {
            $expression = $syntaxTreeBuilder->build($this->mapConfig);
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
        $syntaxTreeBuilder->registerInstantiator(new CommandArrayExpressionInstantiator());
        $syntaxTreeBuilder->registerInstantiator(new PlainArrayExpressionInstantiator());
        $syntaxTreeBuilder->registerInstantiator(new PlainValueExpressionInstantiator());
        
        return $syntaxTreeBuilder;
    }
}

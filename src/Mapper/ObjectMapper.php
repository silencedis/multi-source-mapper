<?php

namespace SilenceDis\MultiSourceMapper\Mapper;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\CommandArrayExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\CommandStringExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\CompositeExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\ExpressionInstantiationFailed;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\PlainArrayExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\PlainValueExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\Context;

/**
 * Class ObjectMapper
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
final class ObjectMapper implements Mapper
{
    /**
     * @inheritDoc
     *
     * @throws MappingFailed
     */
    public function map($mapConfig)
    {
        // todo #improve An interpreter context factory dependency injection may be used to create instance of InterpreterContext
        $context = new Context();
        
        // todo #improve The syntax tree builder may be created outside of the mapper and injected into the mapper just to use it.
        $compositeInstantiator = $this->createCompositeInstantiator();
        
        try {
            // Build the high-level expression.
            $expression = $compositeInstantiator->instantiate($mapConfig);
        } catch (ExpressionInstantiationFailed $e) {
            throw new MappingFailed('Failed to instantiate an expression');
        }
        
        $expression->interpret($context);
        
        return $context->lookup($expression);
    }
    
    /**
     * Returns a composite instantiator.
     *
     * @return CompositeExpressionInstantiator
     */
    private function createCompositeInstantiator(): CompositeExpressionInstantiator
    {
        $compositeInstantiator = new CompositeExpressionInstantiator();
        
        $compositeInstantiator->registerInstantiator(new CommandStringExpressionInstantiator());
        $compositeInstantiator->registerInstantiator(new CommandArrayExpressionInstantiator($compositeInstantiator));
        $compositeInstantiator->registerInstantiator(new PlainArrayExpressionInstantiator($compositeInstantiator));
        $compositeInstantiator->registerInstantiator(new PlainValueExpressionInstantiator());
        
        return $compositeInstantiator;
    }
}

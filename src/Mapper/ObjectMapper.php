<?php

namespace SilenceDis\MultiSourceMapper\Mapper;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\CannotInstantiateExpression;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\ExpressionInstantiationFailed;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\ExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\DefaultInterpreterContext;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\InterpreterContext;

/**
 * Class ObjectMapper
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
final class ObjectMapper implements Mapper
{
    /**
     * General expression instantiator that can instantiate an expression for the root configuration value
     *
     * @var ExpressionInstantiator
     */
    private $expressionInstantiator;
    /**
     * An interpreter context in which an expression will be interpreted in {@see ObjectMapper::map()}.
     *
     * @var InterpreterContext
     */
    private $context;
    
    /**
     * ObjectMapper constructor.
     *
     * @param ExpressionInstantiator $expressionInstantiator General expression instantiator that can instantiate an expression for the root configuration value
     * @param InterpreterContext $context
     */
    public function __construct(ExpressionInstantiator $expressionInstantiator, InterpreterContext $context)
    {
        $this->expressionInstantiator = $expressionInstantiator;
        $this->context = $context;
    }
    
    /**
     * @inheritDoc
     *
     * @param $mapConfig
     *
     * @return mixed|null
     *
     * @throws CannotInstantiateExpression
     * @throws MappingFailed
     */
    public function map($mapConfig)
    {
        // todo #improve An interpreter context factory dependency injection may be used to create instance of InterpreterContext
        $context = new DefaultInterpreterContext();
        
        try {
            // Build the high-level expression.
            $expression = $this->expressionInstantiator->instantiate($mapConfig);
        } catch (ExpressionInstantiationFailed $e) {
            throw new MappingFailed('Failed to instantiate an expression');
        }
        
        $expression->interpret($context);
        
        return $context->lookup($expression);
    }
}

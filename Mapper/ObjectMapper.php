<?php

namespace SilenceDis\MultiSourceMapper\Mapper;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Exception\ExpressionInstantiationFailedException;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\CommandArrayExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\CommandStringExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\PlainArrayExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\PlainValueExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\InterpreterContext;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\SyntaxTreeBuilder\SyntaxTreeBuilder;
use SilenceDis\MultiSourceMapper\Mapper\Exception\MapperException;
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

        $syntaxTreeBuilder = new SyntaxTreeBuilder();
        $syntaxTreeBuilder->registerInstantiator(new CommandStringExpressionInstantiator());
        $syntaxTreeBuilder->registerInstantiator(new CommandArrayExpressionInstantiator());
        $syntaxTreeBuilder->registerInstantiator(new PlainArrayExpressionInstantiator());
        $syntaxTreeBuilder->registerInstantiator(new PlainValueExpressionInstantiator());

        try {
            $expression = $syntaxTreeBuilder->build($this->mapConfig);
        } catch (ExpressionInstantiationFailedException $e) {
            throw new MapperException('Failed to instantiate an expression');
        }

        $expression->interpret($context);

        return $context->lookup($expression);
    }
}

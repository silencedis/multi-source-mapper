<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\ArrayCommandResolver;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\CommandResolver;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\ArrayCommandExpression;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\Expression;

/**
 *
 * Instantiates {@see \SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\ArrayCommandExpression}.
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
final class CommandArrayExpressionInstantiator implements ExpressionInstantiator
{
    /**
     * Resolver of array commands
     *
     * @var ArrayCommandResolver
     */
    private $commandResolver;
    /**
     * An instance of InstantiatorInterface which is able to perform instantion of items of array that represents a raw expression value.
     * The instantiator will delegate to it the value analysis and building internal expressions.
     *
     * @var ExpressionInstantiator
     */
    private $auxExpressionInstantiator;
    
    /**
     * CommandArrayExpressionInstantiator constructor.
     *
     * @param CommandResolver $commandResolver Resolver of commands
     * @param ExpressionInstantiator $auxExpressionInstantiator Another instance of InstantiatorInterface
     *      which is able to perform instantion of items of array that represents a raw expression value.
     *      The instantiator will delegate to it the value analysis and building internal expressions.
     */
    public function __construct(
        CommandResolver $commandResolver,
        ExpressionInstantiator $auxExpressionInstantiator
    ) {
        $this->commandResolver = $commandResolver;
        $this->auxExpressionInstantiator = $auxExpressionInstantiator;
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
    public function instantiate($value): Expression
    {
        $rebuildedArray = [];
        
        foreach ($value as $k => $v) {
            if (!$this->auxExpressionInstantiator->recognizes($v)) {
                throw $this->createException($k, $v);
            }
            $rebuildedArray[$k] = $this->auxExpressionInstantiator->instantiate($v);
        }
        
        return new ArrayCommandExpression($rebuildedArray, $this->commandResolver);
    }
    
    /**
     * Returns an exception with specific message.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return CannotInstantiateExpression
     */
    private function createException($key, $value): CannotInstantiateExpression
    {
        return new CannotInstantiateExpression(
            "Failed to instantiate an expression for the following value array value with key \"{$key}\":" .
            PHP_EOL .
            print_r($value, true),
            PHP_EOL .
            "You can fix it by injecting through the constructor other instance " .
            "of ExpressionInstantiator that is able to instantiate the aforementioned value."
        );
    }
}

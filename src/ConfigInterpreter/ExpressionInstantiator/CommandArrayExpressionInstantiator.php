<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\ArrayCommandResolver;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\ArrayCommandExpression;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\ExpressionInterface;

/**
 *
 * Instantiates {@see \SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\ArrayCommandExpression}.
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class CommandArrayExpressionInstantiator implements ExpressionInstantiatorInterface
{
    /**
     * An instance of InstantiatorInterface which is able to perform instantion of items of array that represents a raw expression value.
     * The instantiator will delegate to it the value analysis and building internal expressions.
     *
     * @var ExpressionInstantiatorInterface
     */
    private $auxExpressionInstantiator;
    
    /**
     * CommandArrayExpressionInstantiator constructor.
     *
     * @param ExpressionInstantiatorInterface $auxExpressionInstantiator Another instance of InstantiatorInterface
     * which is able to perform instantion of items of array that represents a raw expression value.
     * The instantiator will delegate to it the value analysis and building internal expressions.
     */
    public function __construct(ExpressionInstantiatorInterface $auxExpressionInstantiator)
    {
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
    public function instantiate($value): ExpressionInterface
    {
        $rebuildedArray = [];
        
        foreach ($value as $k => $v) {
            if (!$this->auxExpressionInstantiator->recognizes($v)) {
                throw $this->createException($k, $v);
            }
            $rebuildedArray[$k] = $this->auxExpressionInstantiator->instantiate($v);
        }
        
        return new ArrayCommandExpression($rebuildedArray, new ArrayCommandResolver());
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
            "of ExpressionInstantiatorInterface that is able to instantiate the aforementioned value."
        );
    }
}

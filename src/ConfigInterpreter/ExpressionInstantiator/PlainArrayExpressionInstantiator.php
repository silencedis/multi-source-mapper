<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\Expression;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\PlainArrayExpression;

/**
 * Instantiates {\SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\PlainValueExpression}
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
final class PlainArrayExpressionInstantiator implements ExpressionInstantiator
{
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
     * @param ExpressionInstantiator $auxExpressionInstantiator Another instance of InstantiatorInterface
     * which is able to perform instantion of items of array that represents a raw expression value.
     * The instantiator will delegate to it the value analysis and building internal expressions.
     */
    public function __construct(ExpressionInstantiator $auxExpressionInstantiator)
    {
        $this->auxExpressionInstantiator = $auxExpressionInstantiator;
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
    public function instantiate($value): Expression
    {
        $rebuildedArray = [];
        
        foreach ($value as $k => $v) {
            if (!$this->auxExpressionInstantiator->recognizes($v)) {
                throw $this->createException($k, $v);
            }
            $rebuildedArray[$k] = $this->auxExpressionInstantiator->instantiate($v);
        }
        
        return new PlainArrayExpression($rebuildedArray);
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

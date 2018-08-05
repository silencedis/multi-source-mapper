<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\SyntaxTreeBuilder;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Exception\ExpressionInstantiationFailedException;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\ExpressionInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\ExpressionInstantiatorInterface;

/**
 * Composite instantiator.
 * It includes other instantiators and relies on their functionality.
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class CompositeExpressionInstantiator implements ExpressionInstantiatorInterface
{
    /**
     * Expression instantiators array
     *
     * @var ExpressionInstantiatorInterface[]
     */
    private $instantiators = [];
    
    /**
     * Adds an expression instantiator to the syntax tree builder.
     *
     * The instantiators are used to delegate to one of them creating an expression
     * that represents a configuration and may be interpreted.
     *
     * @internal Instantiators registering might be implemented through a constructor.
     * But it may be needed to pass the tree builder into an instantiarot before registering it.
     *
     * @param ExpressionInstantiatorInterface $instantiator
     */
    public function registerInstantiator(ExpressionInstantiatorInterface $instantiator)
    {
        $this->instantiators[] = $instantiator;
    }
    
    /**
     * @inheritDoc
     */
    public function recognizes($value): bool
    {
        foreach ($this->instantiators as $instantiator) {
            // todo #improve It may be good to cache checking results to save time when running the "instantiate" method.
            if ($instantiator->recognizes($value)) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * @inheritDoc
     *
     * @throws ExpressionInstantiationFailedException
     */
    public function instantiate($value): ExpressionInterface
    {
        foreach ($this->instantiators as $instantiator) {
            if ($instantiator->recognizes($value)) {
                return $instantiator->instantiate($value);
            }
        }
        
        throw new ExpressionInstantiationFailedException();
    }
}

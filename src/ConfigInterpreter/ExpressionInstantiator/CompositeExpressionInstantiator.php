<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\Expression;

/**
 * Composite instantiator.
 * It includes other instantiators and relies on their functionality.
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
final class CompositeExpressionInstantiator implements ExpressionInstantiator
{
    /**
     * Expression instantiators array
     *
     * @var ExpressionInstantiator[]
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
     * @param ExpressionInstantiator $instantiator
     */
    public function registerInstantiator(ExpressionInstantiator $instantiator): void
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
     * @throws ExpressionInstantiationFailed
     */
    public function instantiate($value): Expression
    {
        foreach ($this->instantiators as $instantiator) {
            if ($instantiator->recognizes($value)) {
                return $instantiator->instantiate($value);
            }
        }
        
        throw new ExpressionInstantiationFailed();
    }
}

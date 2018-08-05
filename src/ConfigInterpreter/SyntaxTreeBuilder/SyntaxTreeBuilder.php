<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\SyntaxTreeBuilder;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Exception\ExpressionInstantiationFailedException;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiatorInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\SyntaxTreeBuilderInterface;

/**
 * Class SyntaxTreeBuilder
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class SyntaxTreeBuilder implements SyntaxTreeBuilderInterface
{
    /**
     * @var ExpressionInstantiatorInterface[]
     */
    private $instantiators = [];
    
    /**
     * @param $value
     *
     * @return \SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInterface
     * @throws \SilenceDis\MultiSourceMapper\ConfigInterpreter\Exception\ExpressionInstantiationFailedException
     */
    public function build($value): ExpressionInterface
    {
        foreach ($this->instantiators as $instantiator) {
            if ($instantiator->recognizes($value)) {
                return $instantiator->instantiate($value);
            }
        }
        
        throw new ExpressionInstantiationFailedException();
    }
    
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
}

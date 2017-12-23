<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\SyntaxTreeBuilder;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Exception\ExpressionInstantiationFailedException;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\ExpressionInstantiatorInterface;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\ExpressionInterface;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\SyntaxTreeBuilderInterface;

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
     * @return \SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\ExpressionInterface
     * @throws \SilenceDis\MultiSourceMapper\ConfigInterpreter\Exception\ExpressionInstantiationFailedException
     */
    public function build($value): ExpressionInterface
    {
        foreach ($this->instantiators as $instantiator) {
            if ($instantiator->recognizes($value)) {
                return $instantiator->instantiate($value, $this);
            }
        }

        throw new ExpressionInstantiationFailedException();
    }

    /**
     * @param \SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\ExpressionInstantiatorInterface $instantiator
     */
    public function registerInstantiator(ExpressionInstantiatorInterface $instantiator)
    {
        $this->instantiators[] = $instantiator;
    }
}

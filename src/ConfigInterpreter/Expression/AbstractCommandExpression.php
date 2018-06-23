<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\CommandResolverInterface;

/**
 * `CommandExpression` means that the expression interpretation
 * will be delegated to another object named "Command" ({@see CommandInterface}).
 * An instance of command object may be returned by {@see CommandResolverInterface}.
 * The CommandResolver must be passed to the constructor.
 * All the child classes must ensure passing the instance of CommandResolver
 * to the constructor of AbstractCommandExpression.
 * AbstractCommandExpression provides the protected method {@see AbstractCommandExpression::getCommandResolver}
 * which is an internal getter of the private property that keeps the CommandResolver instance.
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
abstract class AbstractCommandExpression extends AbstractExpression
{
    /**
     * @var CommandResolverInterface
     */
    private $commandResolver;
    
    /**
     * AbstractCommandExpression constructor.
     *
     * @param \SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\CommandResolverInterface $commandResolver
     */
    public function __construct(CommandResolverInterface $commandResolver)
    {
        $this->commandResolver = $commandResolver;
    }
    
    /**
     * @return \SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\CommandResolverInterface
     */
    protected function getCommandResolver(): CommandResolverInterface
    {
        return $this->commandResolver;
    }
}

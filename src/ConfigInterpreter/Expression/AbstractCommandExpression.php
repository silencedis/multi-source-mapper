<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\CommandResolver;

/**
 * `CommandExpression` means that the expression interpretation
 * will be delegated to another object named "Command" ({@see Command}).
 * An instance of command object may be returned by {@see CommandResolver}.
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
     * @var CommandResolver
     */
    private $commandResolver;
    
    /**
     * AbstractCommandExpression constructor.
     *
     * @param CommandResolver $commandResolver
     */
    public function __construct(CommandResolver $commandResolver)
    {
        $this->commandResolver = $commandResolver;
    }
    
    /**
     * @return CommandResolver
     */
    protected function getCommandResolver(): CommandResolver
    {
        return $this->commandResolver;
    }
}

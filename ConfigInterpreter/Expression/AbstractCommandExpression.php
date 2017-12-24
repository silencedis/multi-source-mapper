<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression;

use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\CommandResolver\CommandResolverInterface;

/**
 * Class AbstractCommandExpression
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
     * @param CommandResolverInterface $commandResolver
     */
    public function __construct(CommandResolverInterface $commandResolver)
    {
        $this->commandResolver = $commandResolver;
    }

    /**
     * @return CommandResolverInterface
     */
    protected function getCommandResolver(): CommandResolverInterface
    {
        return $this->commandResolver;
    }
}

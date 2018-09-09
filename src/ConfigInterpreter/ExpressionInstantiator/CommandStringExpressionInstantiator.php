<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\CommandResolver;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\Expression;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\StringCommandExpression;

/**
 *
 * Instantiates {@see \SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\StringCommandExpression}
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
final class CommandStringExpressionInstantiator implements ExpressionInstantiator
{
    /**
     * @var CommandResolver Resolver of commands
     */
    private $commandResolver;
    
    /**
     * CommandStringExpressionInstantiator constructor.
     *
     * @param CommandResolver $commandResolver
     */
    public function __construct(CommandResolver $commandResolver)
    {
        $this->commandResolver = $commandResolver;
    }
    
    /**
     * @inheritDoc
     */
    public function recognizes($value): bool
    {
        return is_string($value) && strncmp($value, '!', 1) === 0;
    }
    
    /**
     * @inheritDoc
     */
    public function instantiate($value): Expression
    {
        return new StringCommandExpression($value, $this->commandResolver);
    }
}

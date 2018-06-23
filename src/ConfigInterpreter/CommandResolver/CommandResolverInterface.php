<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Command\CommandInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\Exception\CommandResolverExceptionInterface;

/**
 * Provides a method for an interpreter command resolving.
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface CommandResolverInterface
{
    /**
     * Resolves a command based on a raw configuration value
     *
     * @param mixed $commandConfig Data for command resolving.
     * The `commandConfig` parameter type constraint depends on a concrete resolver implementation.
     *
     * @return CommandInterface Resolved command instance
     *
     * @throws CommandResolverExceptionInterface
     * If resolver cannot resolve a command, the exception must be thrown.
     */
    public function resolve($commandConfig): CommandInterface;
}

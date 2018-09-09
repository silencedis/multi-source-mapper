<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Command\Command;

/**
 * Provides a method for an interpreter command resolving.
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface CommandResolver
{
    /**
     * Resolves a command based on a raw configuration value
     *
     * @param mixed $commandConfig Data for command resolving.
     * The `commandConfig` parameter type constraint depends on a concrete resolver implementation.
     *
     * @return Command Resolved command instance
     */
    public function resolve($commandConfig): Command;
}

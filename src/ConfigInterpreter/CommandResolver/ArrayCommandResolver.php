<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Command\Command;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Command\GetSourceValueCommand;

/**
 * Resolver of command based on an array value
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
final class ArrayCommandResolver implements CommandResolver
{
    /**
     * @inheritdoc
     *
     * @param array $commandConfig
     * The parameter value must be an array.
     *
     * @return Command
     *
     * @throws CommandIsNotResolvable
     */
    public function resolve($commandConfig): Command
    {
        // todo Review the value verification
        $this->verifyCommandConfig($commandConfig);
        
        $commandName = $commandConfig['!'] ?? $commandConfig['_command'] ?? null;
        
        if ($commandName === null) {
            throw new CommandIsNotResolvable();
        }
        
        switch ($commandName) {
            case 'get-source-value':
                return new GetSourceValueCommand($commandConfig['source'], $commandConfig['query']);
            default:
                throw new CommandIsNotResolvable();
        }
    }
    
    /**
     * @param array $commandConfig
     *
     * @throws CommandIsNotResolvable
     */
    private function verifyCommandConfig($commandConfig): void
    {
        if (!is_array($commandConfig)) {
            throw new CommandIsNotResolvable();
        }
        if (!isset($commandConfig['source'])) {
            throw new CommandIsNotResolvable();
        }
        if (!isset($commandConfig['query'])) {
            throw new CommandIsNotResolvable();
        }
    }
}

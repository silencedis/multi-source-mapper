<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Command\CommandInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Command\GetSourceValueCommand;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\Exception\CommandResolverException;

/**
 * Resolver of command based on an array value
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class ArrayCommandResolver implements CommandResolverInterface
{
    /**
     * @inheritdoc
     *
     * @param array $commandConfig
     * The parameter value must be an array.
     *
     */
    public function resolve($commandConfig): CommandInterface
    {
        // todo Review the value verification
        $this->verifyCommandConfig($commandConfig);
        
        $commandName = $commandConfig['!'] ?? $commandConfig['_command'] ?? null;
        
        if ($commandName === null) {
            throw new CommandResolverException();
        }
        
        switch ($commandName) {
            case 'get-source-value':
                return new GetSourceValueCommand($commandConfig['source'], $commandConfig['query']);
            default:
                throw new CommandResolverException();
        }
    }
    
    /**
     * @param array $commandConfig
     *
     * @throws CommandResolverException
     */
    private function verifyCommandConfig($commandConfig): void
    {
        if (!is_array($commandConfig)) {
            throw new CommandResolverException();
        }
        if (!isset($commandConfig['source'])) {
            throw new CommandResolverException();
        }
        if (!isset($commandConfig['query'])) {
            throw new CommandResolverException();
        }
    }
}

<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Command\GetSourceValueCommand;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\Exception\CommandResolverException;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\Command\CommandInterface;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\CommandResolver\CommandResolverInterface;

/**
 * Class ArrayCommandResolver
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class ArrayCommandResolver implements CommandResolverInterface
{
    /**
     * @inheritDoc
     */
    public function resolve($commandConfig): CommandInterface
    {
        $this->checkCommandConfig($commandConfig);

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
     * @throws CommandResolverException
     */
    private function checkCommandConfig($commandConfig): void
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

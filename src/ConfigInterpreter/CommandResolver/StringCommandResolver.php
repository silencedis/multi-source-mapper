<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Command\Command;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Command\GetSourceValueCommand;

/**
 * Resolver of command based on a string value
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
final class StringCommandResolver implements CommandResolver
{
    /**
     * @param string $commandConfig A raw command configuration.
     * The parameter value must be a string and must have the following format:
     * `!<command-name> <command-body>`.
     * The expnanation mark is a sign that the next string part may be considered as a string command configuration.
     * `<command-name>` is an idendifier of command.
     * `<command-body>` is a string that may be considered as a configuration of command.
     *
     * @return Command
     * @throws CommandIsNotResolvable
     */
    public function resolve($commandConfig): Command
    {
        $this->verifyCommandConfig($commandConfig);
        
        // !source api.source some.new.api.key
        $pattern = '/^!(?P<commandName>[\w-]+)\s(?P<commandBody>.+)$/';
        preg_match_all($pattern, $commandConfig, $matches, PREG_SET_ORDER);
        $commandName = $matches[0]['commandName'];
        $commandBody = $matches[0]['commandBody'];
        
        switch ($commandName) {
            case 'get-source-value':
                $sourceCommandParams = explode(' ', $commandBody);
                list($sourceName, $query) = $sourceCommandParams;
                
                return new GetSourceValueCommand($sourceName, $query);
            default:
                throw new CommandIsNotResolvable();
        }
    }
    
    /**
     * Checks if the command config string is valid.
     *
     * @param mixed $commandConfig Configuration string to verify
     *
     * @throws CommandIsNotResolvable The exception is thrown if the config string isn't valid.
     */
    private function verifyCommandConfig($commandConfig)
    {
        if (!is_string($commandConfig)) {
            throw new CommandIsNotResolvable('The command config must be a string.');
        }
        
        if (substr($commandConfig, 0, 1) != '!') {
            throw new CommandIsNotResolvable('The command config string must begin from the explanation mark.');
        }
    }
}

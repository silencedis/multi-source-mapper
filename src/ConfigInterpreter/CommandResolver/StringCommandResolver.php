<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Command\CommandInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Command\GetSourceValueCommand;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\Exception\CommandResolverException;

/**
 * Class StringCommandResolver
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class StringCommandResolver implements CommandResolverInterface
{
    /**
     * @param $commandConfig
     *
     * @return \SilenceDis\MultiSourceMapper\ConfigInterpreter\Command\CommandInterface
     * @throws CommandResolverException
     */
    public function resolve($commandConfig): CommandInterface
    {
        // тут предварительно стоит проверить, начинается ли строка со служебного символа.
        // ...
        
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
                throw new CommandResolverException();
        }
    }
}

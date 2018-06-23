<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Command\CommandInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\Exception\CommandResolverExceptionInterface;

/**
 * Interface CommandResolverInterface
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface CommandResolverInterface
{
    /**
     * @param $commandConfig
     *
     * @return CommandInterface
     * @throws CommandResolverExceptionInterface
     */
    public function resolve($commandConfig): CommandInterface;
}

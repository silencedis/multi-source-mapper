<?php

namespace SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\CommandResolver;

use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\Command\CommandInterface;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\CommandResolver\Exception\CommandResolverExceptionInterface;

/**
 * Interface CommandResolverInterface
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface CommandResolverInterface
{
    /**
     * @param $commandConfig
     * @return CommandInterface
     * @throws CommandResolverExceptionInterface
     */
    public function resolve($commandConfig): CommandInterface;
}

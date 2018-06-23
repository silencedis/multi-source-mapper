<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\CommandResolverInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\Exception\CommandResolverExceptionInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContextInterface;

/**
 * Class StringCommandExpression
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class StringCommandExpression extends AbstractCommandExpression
{
    /**
     * @var string
     */
    private $expressionValue;
    
    /**
     * StringCommandExpression constructor.
     *
     * @param string $string
     * @param \SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\CommandResolverInterface $commandResolver
     */
    public function __construct(string $string, CommandResolverInterface $commandResolver)
    {
        parent::__construct($commandResolver);
        $this->expressionValue = $string;
    }
    
    /**
     * @param InterpreterContextInterface $context
     *
     * @throws \SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\Exception\CommandResolverExceptionInterface
     */
    public function interpret(InterpreterContextInterface $context)
    {
        $result = $this->runCommand($this->expressionValue);
        $context->replace($this, $result);
    }
    
    /**
     * @param string $commandConfig
     *
     * @return mixed
     * @throws \SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\Exception\CommandResolverExceptionInterface
     */
    private function runCommand(string $commandConfig)
    {
        $command = $this->getCommandResolver()->resolve($commandConfig);
        
        return $command->execute();
    }
}

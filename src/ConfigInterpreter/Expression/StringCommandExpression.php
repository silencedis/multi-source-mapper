<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\CommandResolver;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\InterpreterContext;

/**
 * Represents an expression, defined as a string, that is a command.
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
final class StringCommandExpression extends AbstractCommandExpression
{
    /**
     * @var string
     */
    private $expressionValue;
    
    /**
     * StringCommandExpression constructor.
     *
     * @param string $string
     * @param \SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\CommandResolver $commandResolver
     */
    public function __construct(string $string, CommandResolver $commandResolver)
    {
        parent::__construct($commandResolver);
        $this->expressionValue = $string;
    }
    
    /**
     * @param InterpreterContext $context
     */
    public function interpret(InterpreterContext $context)
    {
        $result = $this->runCommand($this->expressionValue);
        $context->replace($this, $result);
    }
    
    /**
     * @param string $commandConfig
     *
     * @return mixed
     */
    private function runCommand(string $commandConfig)
    {
        $command = $this->getCommandResolver()->resolve($commandConfig);
        
        return $command->execute();
    }
}

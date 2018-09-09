<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\CommandResolver;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\InterpreterContext;

/**
 * Represents a command expression that is a command, defined in an array format.
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
final class ArrayCommandExpression extends AbstractCommandExpression
{
    /**
     * @var array
     */
    private $expressionValue;
    
    /**
     * ArrayCommandExpression constructor.
     *
     * @param array $array
     * @param CommandResolver $commandResolver
     */
    public function __construct(array $array, CommandResolver $commandResolver)
    {
        $this->expressionValue = $array;
        parent::__construct($commandResolver);
    }
    
    /**
     * @param InterpreterContext $context
     */
    public function interpret(InterpreterContext $context)
    {
        $interpretedArray = [];
        
        foreach ($this->expressionValue as $key => $expression) {
            $expression->interpret($context);
            $interpretedArray[$key] = $context->lookup($expression);
        }
        
        $result = $this->runCommand($interpretedArray);
        
        $context->replace($this, $result);
    }
    
    /**
     * @param array $commandConfig
     *
     * @return mixed
     */
    private function runCommand(array $commandConfig)
    {
        $command = $this->getCommandResolver()->resolve($commandConfig);
        
        return $command->execute();
    }
}

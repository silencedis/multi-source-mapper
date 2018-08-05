<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\CommandResolverInterface;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\InterpreterContextInterface;

/**
 * Represents a command expression that is a command, defined in an array format.
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class ArrayCommandExpression extends AbstractCommandExpression
{
    /**
     * @var array
     */
    private $expressionValue;
    
    /**
     * ArrayCommandExpression constructor.
     *
     * @param array $array
     * @param CommandResolverInterface $commandResolver
     */
    public function __construct(array $array, CommandResolverInterface $commandResolver)
    {
        $this->expressionValue = $array;
        parent::__construct($commandResolver);
    }
    
    /**
     * @param \SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\InterpreterContextInterface $context
     *
     * @throws \SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\Exception\CommandResolverExceptionInterface
     */
    public function interpret(InterpreterContextInterface $context)
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
     * @throws \SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\Exception\CommandResolverExceptionInterface
     */
    private function runCommand(array $commandConfig)
    {
        $command = $this->getCommandResolver()->resolve($commandConfig);
        
        return $command->execute();
    }
}

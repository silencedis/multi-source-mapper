<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression;

use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\InterpreterContextInterface;

/**
 * Class CommandStringExpression
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class CommandStringExpression extends AbstractExpression
{
    private $string;

    public function __construct(string $string)
    {
        $this->string = $string;
    }

    public function interpret(InterpreterContextInterface $context)
    {
        $result = $this->runCommand($this->string);
        $context->replace($this, $result);
    }

    private function runCommand(string $string)
    {
        return '[STRING_COMMAND_HAS_BEEN_PERFORMED]'.$string;
    }
}

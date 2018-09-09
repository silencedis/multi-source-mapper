<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\InterpreterContext;

/**
 * Represents an expression required functionality.
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface Expression
{
    /**
     * Interprets the expression in a passed context.
     *
     * @param \SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\InterpreterContext $context
     *
     * @return mixed
     */
    public function interpret(InterpreterContext $context);
    
    /**
     * Returns an expression unique key.
     *
     * @return string
     */
    public function getKey(): string;
}

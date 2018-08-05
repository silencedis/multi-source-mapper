<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\InterpreterContextInterface;

/**
 * Represents an expression required functionality.
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface ExpressionInterface
{
    /**
     * Interprets the expression in a passed context.
     *
     * @param \SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\InterpreterContextInterface $context
     *
     * @return mixed
     */
    public function interpret(InterpreterContextInterface $context);
    
    /**
     * Returns an expression unique key.
     *
     * @return string
     */
    public function getKey(): string;
}

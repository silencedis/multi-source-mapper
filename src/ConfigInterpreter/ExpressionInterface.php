<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter;

/**
 * Class ExpressionInterface
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface ExpressionInterface
{
    public function interpret(InterpreterContextInterface $contest);
    
    public function getKey(): string;
}

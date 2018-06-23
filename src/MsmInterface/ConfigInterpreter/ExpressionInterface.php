<?php

namespace SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter;

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

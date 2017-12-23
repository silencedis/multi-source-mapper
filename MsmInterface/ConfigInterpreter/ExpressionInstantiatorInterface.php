<?php

namespace SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter;

/**
 * Interface ExpressionInstantiatorInterface
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface ExpressionInstantiatorInterface
{
    public function recognizes($value): bool;
    
    public function instantiate($value): ExpressionInterface;
}

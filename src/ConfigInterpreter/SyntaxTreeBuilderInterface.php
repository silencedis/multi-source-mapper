<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter;

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Exception\ExpressionInstantiationFailedExceptionInterface;

/**
 * Interface SyntaxTreeBuilderInterface
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface SyntaxTreeBuilderInterface
{
    /**
     * @param $value
     *
     * @return ExpressionInterface
     * @throws ExpressionInstantiationFailedExceptionInterface
     */
    public function build($value): ExpressionInterface;
}

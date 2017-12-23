<?php

namespace SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter;

/**
 * Interface SyntaxTreeBuilderInterface
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface SyntaxTreeBuilderInterface
{
    public function build($value): ExpressionInterface;
}

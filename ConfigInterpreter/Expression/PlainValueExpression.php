<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression;

use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\InterpreterContextInterface;

/**
 * Class PlainValueExpression
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class PlainValueExpression extends AbstractExpression
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function interpret(InterpreterContextInterface $context)
    {
        $context->replace($this, $this->value);

        return $context->lookup($this);
    }
}

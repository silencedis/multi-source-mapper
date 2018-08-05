<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator;

/**
 * This exception is designed to use it in expression instantiators when instantiation cannot be performed.
 * For example, when an instantiator doesn't recognize a value but despite that the instantiation was called.
 *
 * @author Yurii Slobodeniuk <yurii.slobodeniuk@cosmonova.net>
 */
final class CannotInstantiateExpression extends \Exception
{
}


<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Exception;

use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\Exception\ExpressionInstantiationFailedExceptionInterface;

/**
 * Class ExpressionInstantiationFailedException
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
class ExpressionInstantiationFailedException extends \Exception implements ExpressionInstantiationFailedExceptionInterface
{
}

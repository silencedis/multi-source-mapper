<?php

namespace SilenceDis\MultiSourceMapper;

/**
 * Interface TargetDataSetterInterface
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface TargetDataSetterInterface
{
    public function set($value, string $property, $target);
}

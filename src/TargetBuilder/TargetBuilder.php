<?php

namespace SilenceDis\MultiSourceMapper\TargetBuilder;

/**
 * Interface TargetBuilder
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface TargetBuilder
{
    public function setProperty(string $property, $value);
    
    public function save();
}

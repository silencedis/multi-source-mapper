<?php

namespace SilenceDis\MultiSourceMapper\MsmInterface\TargetBuilder;

/**
 * Interface TargetBuilderInterface
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface TargetBuilderInterface
{
    public function setProperty(string $property, $value);

    public function save();
}

<?php

namespace SilenceDis\MultiSourceMapper;

/**
 * Interface TargetFactoryInterface
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface TargetFactoryInterface
{
    public function createTarget();
    
    public function createTargetDataSetter(): TargetDataSetterInterface;
}

<?php

namespace SilenceDis\MultiSourceMapper;

/**
 * Interface MapperInterface
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface MapperInterface
{
    public function registerSource(SourceInterface $source);
    
    public function setTargetFactory(TargetFactoryInterface $targetFactory);
    
    public function setMapConfig(array $config);
    
    public function map();
}

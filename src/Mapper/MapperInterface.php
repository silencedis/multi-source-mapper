<?php

namespace SilenceDis\MultiSourceMapper\Mapper;

/**
 * Maps a configuration
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface MapperInterface
{
    /**
     * Performs mapping.
     *
     * @param mixed $mapConfig Map configuration. It may be a value of any type that is allowed by a concrete mapper implementation.
     *
     * @return mixed Mapping result.
     */
    public function map($mapConfig);
}

<?php

namespace SilenceDis\MultiSourceMapperInterface\Source;

/**
 * Interface SourceInterface
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface SourceInterface
{
    public function get($query);
}

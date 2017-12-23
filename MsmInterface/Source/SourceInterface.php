<?php

namespace SilenceDis\MultiSourceMapper\MSMInterface\Source;

/**
 * Interface SourceInterface
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface SourceInterface
{
    public function get($query);
}

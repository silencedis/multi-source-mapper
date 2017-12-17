<?php

namespace SilenceDis\MultiSourceMapper;

/**
 * Interface SourceInterface
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface SourceInterface
{
    public function get($query);
}

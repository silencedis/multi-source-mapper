<?php

namespace SilenceDis\MultiSourceMapper\Source;

/**
 * Interface Source
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface Source
{
    public function get($query);
}

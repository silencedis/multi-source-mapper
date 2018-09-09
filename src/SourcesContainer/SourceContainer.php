<?php

namespace SilenceDis\MultiSourceMapper\SourcesContainer;

use SilenceDis\MultiSourceMapper\MsmInterface\SourcesContainer\Exception;
use SilenceDis\MultiSourceMapper\Source\Source;

/**
 * Interface SourceContainer
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface SourceContainer
{
    /**
     * Finds a source instance by its identifier and returns it.
     *
     * @param string $id Identifier of the source to look for.
     *
     * @return \SilenceDis\MultiSourceMapper\Source\Source Source
     */
    public function get($id): Source;
    
    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($id): bool;
}

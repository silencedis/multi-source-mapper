<?php

namespace SilenceDis\MultiSourceMapper\SourceContainer;

use SilenceDis\MultiSourceMapper\Source\SourceInterface;

/**
 * Interface SourceContainerInterface
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
interface SourceContainerInterface
{
    /**
     * Finds a source instance by its identifier and returns it.
     *
     * @param string $id Identifier of the source to look for.
     *
     * @throws Exception\SourceContainerExceptionInterface
     * @throws Exception\NotFoundExceptionInterface
     *
     * @return SourceInterface Source
     */
    public function get($id): SourceInterface;
    
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

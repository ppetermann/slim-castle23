<?php
namespace Castle23\Slim;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Interop\Container\Exception\NotFoundException;
use King23\DI\DependencyContainer;

/**
 * this is a a bit of a cheat wrapper, as it makes the King23\DI have the methods of the Interopt\Containerinterface
 * but its actually a bit messy to do it this way - as the King23\DI is supposed to use interface names as id's, which
 * slim is not
 *
 * @package Castle23\Slim
 */
class CompatibilityContainer extends DependencyContainer implements ContainerInterface
{
    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundException  No entry was found for this identifier.
     * @throws ContainerException Error while retrieving the entry.
     *
     * @return mixed Entry.
     */

    public function get($id)
    {
        return $this->getInstanceOf($id);
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return boolean
     */
    public function has($id)
    {
        return $this->hasServiceFor($id);
    }
}

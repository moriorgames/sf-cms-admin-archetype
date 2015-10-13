<?php

namespace CoreBundle\Manager\Interfaces;

/**
 * Interface ManagerInterface.
 */
interface ManagerInterface
{
    /**
     * @param int $id
     *
     * @return Object
     */
    public function getById($id);

    /**
     * @return Object
     */
    public function getRepository();
}

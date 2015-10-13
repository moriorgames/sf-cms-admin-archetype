<?php

namespace CoreBundle\Entity\Traits;

/**
 * Class SortTrait.
 */
trait SortTrait
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $sort;

    /**
     * Get id.
     *
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param int $sort
     *
     * @return $this
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }
}

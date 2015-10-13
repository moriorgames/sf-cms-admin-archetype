<?php

namespace CoreBundle\Entity\Traits;

use DateTime;

/**
 * Class DateTimeTrait.
 */
trait DateTimeTrait
{
    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * Return created_at value.
     *
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set locally created at value.
     *
     * @param DateTime $createdAt Created at value
     *
     * @return $this Self object
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Return updated_at value.
     *
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set locally updated at value.
     *
     * @param DateTime $updatedAt Updated at value
     *
     * @return $this Self object
     */
    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}

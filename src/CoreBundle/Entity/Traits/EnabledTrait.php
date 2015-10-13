<?php

namespace CoreBundle\Entity\Traits;

/**
 * Class EnabledTrait.
 */
trait EnabledTrait
{
    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * Set if is enabled.
     *
     * @param bool $enabled enabled value
     *
     * @return $this Self object
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get is enabled.
     *
     * @return bool is enabled
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Enable.
     *
     * @return $this Self object
     */
    public function enable()
    {
        return $this->setEnabled(true);
    }

    /**
     * Disable.
     *
     * @return $this Self object
     */
    public function disable()
    {
        return $this->setEnabled(false);
    }
}

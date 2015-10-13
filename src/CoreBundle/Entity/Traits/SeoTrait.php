<?php

namespace CoreBundle\Entity\Traits;

/**
 * Class SeoTrait.
 */
trait SeoTrait
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="not_blank_string")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="not_blank_string")
     */
    private $description;

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description.
     *
     * @param string $content
     *
     * @return $this
     */
    public function setDescription($content)
    {
        $this->description = $content;

        return $this;
    }
}

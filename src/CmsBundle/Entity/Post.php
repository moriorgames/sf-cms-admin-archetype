<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CoreBundle\Entity\Traits\SeoTrait;
use CoreBundle\Entity\Traits\EnabledTrait;
use CoreBundle\Entity\Traits\DateTimeTrait;
use CoreBundle\Entity\Traits\NameSlugTrait;
use CoreBundle\Entity\Traits\IdentifiableTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Post.
 *
 * @ORM\Entity
 * @ORM\Table(name="cms_post")
 * @ORM\Entity(repositoryClass="CmsBundle\Repository\PostRepository")
 */
class Post
{
    use IdentifiableTrait;
    use NameSlugTrait;
    use EnabledTrait;
    use DateTimeTrait;
    use SeoTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="not_blank_string")
     */
    private $content;

    /**
     * Get Content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set Content.
     *
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
}
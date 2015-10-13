<?php

namespace CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CoreBundle\Entity\Traits\EnabledTrait;
use CoreBundle\Entity\Traits\DateTimeTrait;
use CoreBundle\Entity\Traits\NameSlugTrait;
use CoreBundle\Entity\Traits\IdentifiableTrait;

/**
 * Class Page.
 *
 * @ORM\Entity
 * @ORM\Table(name="cms_page")
 * @ORM\Entity(repositoryClass="CmsBundle\Repository\PageRepository")
 */
class Page
{
    use IdentifiableTrait;
    use NameSlugTrait;
    use EnabledTrait;
    use DateTimeTrait;
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Traits\NameSlugTrait;
use AppBundle\Entity\Traits\ArchetypeTrait;

/**
 * Class Archetype.
 *
 * @ORM\Entity
 * @ORM\Table(name="char_archetype")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArchetypeRepository")
 */
class Archetype
{
    use NameSlugTrait;
    use ArchetypeTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

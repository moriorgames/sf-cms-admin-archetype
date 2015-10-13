<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Traits\NameSlugTrait;
use AppBundle\Entity\Traits\ArchetypeTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Character.
 *
 * @ORM\Entity
 * @ORM\Table(name="char_character")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CharacterRepository")
 */
class Character
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
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $experience;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param int $experience
     *
     * @return $this
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }
}

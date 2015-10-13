<?php

namespace AppBundle\Entity;

use ReflectionClass;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Traits\NameSlugTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Image.
 *
 * @ORM\Entity
 * @ORM\Table(name="media_image")
 */
class Image
{
    use NameSlugTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

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
     * @return null|string
     */
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir() . '/' . $this->path;
    }

    /**
     * @return null|string
     */
    public function getPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir() . '/' . $this->path;
    }

    /**
     * Sets path.
     *
     * @param string $file
     *
     * @return $this
     */
    public function setPath($file = null)
    {
        $this->path = $file;

        return $this;
    }

    /**
     * @return string
     */
    protected function getUploadRootDir()
    {
        $reflection = new ReflectionClass(get_class($this));

        return dirname($reflection->getFileName()) . '/../../../../web/' . $this->getUploadDir();
    }

    /**
     * @return string
     */
    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/images';
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     *
     * @return $this
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
}

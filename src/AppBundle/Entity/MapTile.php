<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class MapTile.
 *
 * @ORM\Table(name="map_map_tile")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MapTileRepository")
 */
class MapTile
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Map
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Map", inversedBy="mapTiles")
     * @ORM\JoinColumn(name="map_id", referencedColumnName="id")
     */
    private $map;

    /**
     * @var Tile
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tile", inversedBy="mapTiles")
     * @ORM\JoinColumn(name="tile_id", referencedColumnName="id")
     */
    private $tile;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     */
    private $x;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     */
    private $y;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Map
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * @param Map $map
     *
     * @return $this
     */
    public function setMap(Map $map)
    {
        $this->map = $map;

        return $this;
    }

    /**
     * @return Tile
     */
    public function getTile()
    {
        return $this->tile;
    }

    /**
     * @param Tile $tile
     *
     * @return $this
     */
    public function setTile(Tile $tile)
    {
        $this->tile = $tile;

        return $this;
    }

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param int $x
     *
     * @return $this
     */
    public function setX($x)
    {
        $this->x = $x;

        return $this;
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param int $y
     *
     * @return $this
     */
    public function setY($y)
    {
        $this->y = $y;

        return $this;
    }
}

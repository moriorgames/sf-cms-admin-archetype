<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Map;
use AppBundle\Entity\Tile;
use AppBundle\Entity\MapTile;
use Doctrine\ORM\EntityRepository;

/**
 * Class MapRepository.
 */
class MapTileRepository extends EntityRepository
{
    /**
     * @param int  $x
     * @param int  $y
     * @param Map  $map
     * @param Tile $tile
     *
     * @return bool
     */
    public function insertPosition($x, $y, Map $map, Tile $tile)
    {
        $mapTile = $this->findOneBy(
            [
                'x' => $x,
                'y' => $y,
                'map' => $map,
            ]
        );

        if (!$mapTile instanceof MapTile) {
            $mapTile = new MapTile();
        }

        $mapTile
            ->setMap($map)
            ->setX($x)
            ->setY($y)
            ->setTile($tile);

        $this->_em->persist($mapTile);
        $this->_em->flush();

        return true;
    }
}

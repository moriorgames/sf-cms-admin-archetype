<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Map;
use AppBundle\Entity\Tile;
use AppBundle\Entity\MapTile;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\EntityManager;
use AppBundle\Repository\MapRepository;
use AppBundle\Manager\Interfaces\ManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class MapManager.
 */
class MapManager implements ManagerInterface
{
    const TILE = 112;
    const INCREMENTAL_TOP = 28;
    const INCREMENTAL_LEFT = 83;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return Tile[]
     */
    public function getTiles()
    {
        return $this->em
            ->getRepository('AppBundle:Tile')
            ->findAll();
    }

    /**
     * Get Map by id or throw exception.
     *
     * @param int $id
     *
     * @return Map|NotFoundHttpException
     */
    public function getById($id)
    {
        /** @var Map $map */
        $map = $this->getRepository()
            ->findOneBy(['id' => $id]);

        if (!$map instanceof Map) {
            throw new NotFoundHttpException('Map not found!');
        }

        return $map;
    }

    /**
     * @return MapRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository('AppBundle:Map');
    }

    /**
     * @param Map $map
     */
    public function persistMap(Map $map)
    {
        try {
            $this->em->persist($map);
            $this->em->flush();
        } catch (ORMException $e) {
            echo 'Fail when persist: '.$e->getMessage()."\n";
        }
    }

    /**
     * @param Map $map
     *
     * @return array
     */
    public function createView(Map $map)
    {
        $tiles = [];

        for ($top = 1; $top <= $map->getHeight(); ++$top) {
            for ($left = 0; $left <= $map->getWidth(); ++$left) {
                if ($top % 2 === 0 && $left % 2 === 0) {
                    continue;
                }
                if ($top % 2 === 1 && $left % 2 === 1) {
                    continue;
                }

                $mapTile = $this->getMapTile($left, $top, $map);

                $tiles[] = [
                    'id' => self::generateIdTile($mapTile),
                    'class' => $mapTile->getTile()->getClass(),
                    'top' => self::INCREMENTAL_TOP * $top,
                    'left' => self::INCREMENTAL_LEFT * $left + 20,
                    'y' => $top,
                    'x' => $left,
                ];
            }
        }

        return $tiles;
    }

    /**
     * @param     $x
     * @param     $y
     * @param Map $map
     *
     * @return MapTile
     */
    public function getMapTile($x, $y, Map $map)
    {
        $mapTile = $this->em
            ->getRepository('AppBundle:MapTile')
            ->findOneBy(
                [
                    'x' => $x,
                    'y' => $y,
                    'map' => $map,
                ]
            );

        if (!$mapTile instanceof MapTile) {
            $tile = $this->em
                ->getRepository('AppBundle:Tile')
                ->findOneBy(['tileType' => Tile::TYPE_GRASS]);
            $mapTile = new MapTile();
            $mapTile
                ->setMap($map)
                ->setX($x)
                ->setY($y)
                ->setTile($tile);
        }

        return $mapTile;
    }

    /**
     * Standard method to generate id for tiles.
     *
     * @param MapTile $mapTile
     *
     * @return string
     */
    public static function generateIdTile(MapTile $mapTile)
    {
        return 'x_'.$mapTile->getX().'_y_'.$mapTile->getY();
    }
}

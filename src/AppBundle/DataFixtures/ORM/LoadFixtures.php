<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Map;
use AppBundle\Entity\Tile;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines the sample data to load in the database when running the unit and
 * functional tests. Execute this command to load the data:.
 *
 *   $ php app/console doctrine:fixtures:load
 *
 * See http://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html
 *
 * @author MoriorGames <moriorgames@gmail.com>
 */
class LoadFixtures implements FixtureInterface, ContainerAwareInterface
{
    /** @var ContainerInterface */
    private $container;

    public function load(ObjectManager $manager)
    {
        $this->loadMaps($manager);
        $this->loadTiles($manager);
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    private function loadMaps(ObjectManager $manager)
    {
        $map = new Map();
        $map
            ->setName('Base Map')
            ->setSlug('base-map')
            ->setEnabled(true)
            ->setHeight(17)
            ->setWidth(10);

        $manager->persist($map);
        $manager->flush();
    }

    private function loadTiles(ObjectManager $manager)
    {
        $tile = new Tile();
        $tile
            ->setName('Grass')
            ->setClass('grass')
            ->setTileType(Tile::TYPE_GRASS);
        $manager->persist($tile);
        $manager->flush();

        $tile = new Tile();
        $tile
            ->setName('Blue Home')
            ->setClass('blue_home')
            ->setTileType(Tile::TYPE_BLUE_HOME);
        $manager->persist($tile);
        $manager->flush();

        $tile = new Tile();
        $tile
            ->setName('Blue Castle')
            ->setClass('blue_castle')
            ->setTileType(Tile::TYPE_BLUE_CASTLE);
        $manager->persist($tile);
        $manager->flush();

        $tile = new Tile();
        $tile
            ->setName('Blue Tower')
            ->setClass('blue_tower')
            ->setTileType(Tile::TYPE_BLUE_TOWER);
        $manager->persist($tile);
        $manager->flush();

        $tile = new Tile();
        $tile
            ->setName('Red Home')
            ->setClass('red_home')
            ->setTileType(Tile::TYPE_RED_HOME);
        $manager->persist($tile);
        $manager->flush();

        $tile = new Tile();
        $tile
            ->setName('Red Castle')
            ->setClass('red_castle')
            ->setTileType(Tile::TYPE_RED_CASTLE);
        $manager->persist($tile);
        $manager->flush();

        $tile = new Tile();
        $tile
            ->setName('Red Castle')
            ->setClass('red_tower')
            ->setTileType(Tile::TYPE_RED_TOWER);
        $manager->persist($tile);
        $manager->flush();

        $tile = new Tile();
        $tile
            ->setName('Npc')
            ->setClass('npc')
            ->setTileType(Tile::TYPE_NPC);
        $manager->persist($tile);
        $manager->flush();

        $tile = new Tile();
        $tile
            ->setName('Woods')
            ->setClass('woods')
            ->setTileType(Tile::TYPE_WOODS);
        $manager->persist($tile);
        $manager->flush();
    }
}

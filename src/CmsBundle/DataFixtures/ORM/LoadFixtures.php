<?php

namespace CmsBundle\DataFixtures\ORM;

use DateTime;
use CmsBundle\Entity\Page;
use CmsBundle\Entity\Post;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

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
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadPages($manager);
        $this->loadPosts($manager);
    }


// ------------------------------ PRIVATE METHODS ------------------------------


    /**
     * @param ObjectManager $manager
     */
    private function loadPages(ObjectManager $manager)
    {
        for ($i = 0; $i < 4; ++$i) {

            $created = new DateTime('now + ' . mt_rand(1, 50) . ' hours');
            $updated = new DateTime('now + ' . mt_rand(100, 150) . ' hours');

            /** @var Page $page */
            $page = new Page();
            $title = $this->getRandomTitle();
            $page
                ->setName($title)
                ->setTitle($title)
                ->setSlug($title)
                ->setDescription($this->getRandomDescription())
                ->setCreatedAt($created)
                ->setUpdatedAt($updated)
                ->setSort(mt_rand(1, 10))
                ->setEnabled(mt_rand(0, 1));
            $manager->persist($page);

        }

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadPosts(ObjectManager $manager)
    {
        for ($i = 0; $i < 9; ++$i) {

            $created = new DateTime('now + ' . mt_rand(1, 50) . ' hours');
            $updated = new DateTime('now + ' . mt_rand(100, 150) . ' hours');

            /** @var Post $post */
            $post = new Post();
            $title = $this->getRandomTitle();
            $post
                ->setName($title)
                ->setTitle($title)
                ->setSlug($title)
                ->setDescription($this->getRandomDescription())
                ->setContent($this->getRandomDescription(12))
                ->setCreatedAt($created)
                ->setUpdatedAt($updated)
                ->setEnabled(mt_rand(0, 1));
            $manager->persist($post);

        }

        $manager->flush();
    }

    /**
     * @return mixed
     */
    private function getRandomTitle()
    {
        $titles = $this->getTitles();

        return $titles[array_rand($titles)];
    }

    /**
     * @param int $limit
     *
     * @return string
     */
    private function getRandomDescription($limit = 5)
    {
        $phrases = $this->getPhrases();

        $numPhrases = rand(1, $limit);
        shuffle($phrases);

        return implode(' ', array_slice($phrases, 0, $numPhrases - 1));
    }

    /**
     * @return array
     */
    private function getPhrases()
    {
        return [
            'Lorem ipsum dolor sit amet consectetur adipiscing elit',
            'Pellentesque vitae velit ex',
            'Mauris dapibus risus quis suscipit vulputate',
            'Eros diam egestas libero eu vulputate risus',
            'In hac habitasse platea dictumst',
            'Morbi tempus commodo mattis',
            'Ut suscipit posuere justo at vulputate',
            'Ut eleifend mauris et risus ultrices egestas',
            'Aliquam sodales odio id eleifend tristique',
            'Urna nisl sollicitudin id varius orci quam id turpis',
            'Nulla porta lobortis ligula vel egestas',
            'Curabitur aliquam euismod dolor non ornare',
            'Sed varius a risus eget aliquam',
            'Nunc viverra elit ac laoreet suscipit',
            'Pellentesque et sapien pulvinar consectetur',
        ];
    }

    /**
     * @return array
     */
    private function getTitles()
    {
        return [
            'Lorem ipsum',
            'Pellentesque vitae',
            'Mauris dapibus risus',
            'Eros diam egestas',
            'In hac habitasse',
            'Morbi tempus',
            'Ut suscipit',
            'ultrices egestas',
            'Aliquam sodales odio',
            'sollicitudin id varius',
            'Nulla porta lobortis',
            'euismod dolor non ornare',
            'risus eget aliquam',
            'laoreet suscipit',
            'Pellentesque et sapien',
        ];
    }
}

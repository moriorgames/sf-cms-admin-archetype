<?php

namespace MoriorGames\DataFixtures\ORM;

use MoriorGames\UserBundle\Entity\User;
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
        $this->loadUsers($manager);
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    private function loadUsers(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setUsername('Morior')
            ->setEmail('moriorgames@gmail.com')
            ->setPlainPassword('nomejodas')
            ->setRoles(['ROLE_SUPER_ADMIN'])
            ->setEnabled(true);

        $manager->persist($user);
        $manager->flush();
    }
}

<?php

namespace CmsBundle\Manager;

use CmsBundle\Entity\Page;
use Doctrine\ORM\EntityManager;
use CmsBundle\Repository\PageRepository;
use CoreBundle\Manager\Interfaces\ManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PageManager.
 */
class PageManager implements ManagerInterface
{
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
     * @param int $id
     *
     * @return Page
     */
    public function getById($id)
    {
        /** @var Page $page */
        $page = $this->getRepository()
            ->findOneBy(['id' => $id]);

        if (!$page instanceof Page) {
            throw new NotFoundHttpException('Page not found!');
        }

        return $page;
    }

    /**
     * @param array $params
     *
     * @return Page
     */
    public function getOneByParams(array $params)
    {
        /** @var Page $page */
        $page = $this->getRepository()
            ->findOneBy($params);

        if (!$page instanceof Page) {
            throw new NotFoundHttpException('Page not found!');
        }

        return $page;
    }

    /**
     * @return PageRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository('CmsBundle:Page');
    }
}

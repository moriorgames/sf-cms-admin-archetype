<?php

namespace CmsBundle\Controller;

use CmsBundle\Entity\Page;
use CmsBundle\Manager\PageManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Map controller.
 *
 * @Route("/")
 */
class PageController extends Controller
{
    /**
     * @param $slug
     *
     * @Route("/page/{slug}", name="page_show")
     * @Method("GET")
     * @Template()
     *
     * @return array
     */
    public function showAction($slug)
    {
        /** @var PageManager $manager */
        $manager = $this->get('cms.page_manager');
        /** @var Page $page */
        $page = $manager->getOneByParams([
            'slug' => $slug,
        ]);

        return ['page' => $page];
    }
}

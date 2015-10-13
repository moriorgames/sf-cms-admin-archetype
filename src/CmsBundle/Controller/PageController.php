<?php

namespace CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Map controller.
 *
 * @Route("/")
 */
class PageController extends Controller
{
    /**
     * @Route()
     * @Template()
     */
    public function indexAction($slug)
    {
        return ['name' => $slug];
    }
}

<?php

namespace AppBundle\Menu;

use CmsBundle\Entity\Page;
use Knp\Menu\FactoryInterface;
use CmsBundle\Manager\PageManager;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Class Builder.
 */
class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        /** @var PageManager $pageManager */
        $pageManager = $this->container->get('cms.page_manager');
        $pages = $pageManager->getRepository()->findAll();

        /** @var Page $page */
        foreach ($pages as $page) {
            $menu->addChild($page->getName(), [
                'route' => 'page_show',
                'routeParameters' => [
                    'slug' => $page->getSlug(),
                ],
            ]);
        }

        return $menu;
    }
}

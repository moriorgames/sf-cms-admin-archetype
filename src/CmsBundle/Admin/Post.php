<?php

namespace CmsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

/**
 * Class Post.
 */
class Post extends Admin
{
    /**
     * @var string
     */
    protected $translationDomain = 'messages';

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('slug');
    }

    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name', 'text', ['label' => 'admin.name'])
            ->add('slug', 'text', ['label' => 'admin.slug'])
            ->add('content', 'text', ['label' => 'admin.content'])
            ->add('title', 'text', ['label' => 'admin.title'])
            ->add('description', 'text', ['label' => 'admin.description'])
            ->add('createdAt', 'sonata_type_datetime_picker',
                [
                    'dp_side_by_side' => false,
                    'required' => false,
                    'dp_icons' => [
                            'time' => 'icon-clock',
                            'date' => 'icon-calendar',
                            'up' => 'icon-chevron-up',
                            'down' => 'icon-chevron-down',
                        ],
                    'label' => 'admin.created_at',
                ]
            )
            ->add('updatedAt', 'sonata_type_datetime_picker',
                [
                    'dp_side_by_side' => false,
                    'required' => false,
                    'dp_icons' => [
                            'time' => 'icon-clock',
                            'date' => 'icon-calendar',
                            'up' => 'icon-chevron-up',
                            'down' => 'icon-chevron-down',
                        ],
                    'label' => 'admin.updated_at',
                ]
            )
            ->add('enabled', null, ['label' => 'admin.enabled'])
            ->end();
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }
}

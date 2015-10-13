<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class MapType.
 */
class MapType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'hidden')
            ->add('name', null, ['label' => 'map.form.name'])
            ->add('slug', null, ['label' => 'map.form.slug'])
            ->add('height', null, ['label' => 'map.form.height'])
            ->add('width', null, ['label' => 'map.form.width'])
            ->add('enabled', null, ['label' => 'map.form.enabled']);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Map',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_bundle_map_type';
    }
}

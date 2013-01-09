<?php

namespace Birrols\BeerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BeersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brewery', 'entity', array(
            'label' => 'business.name',
            'class' => 'BirrolsBeerBundle:Business',
            'property' => 'name',
            ))
            ->add('name')
            ->add('category', 'entity', array(
            'label' => 'beer.category',
            'class' => 'BirrolsBeerBundle:BeerCategories',
            'property' => 'category',
            ))
            ->add('type', 'entity', array(
            'label' => 'beer.type',
            'class' => 'BirrolsBeerBundle:BeerTypes',
            'property' => 'type',
            ))
            ->add('abv')
            ->add('ibu')
            ->add('og')
            ->add('srm')
            ->add('ebc')
            ->add('malts')
            ->add('hops')
            ->add('description')
            ->add('score')
            ->add('image', 'file', array(
                'required' => false,
                'label'     => 'profile.show.image',
                'translation_domain' => 'BirrolsUserBundle',
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Birrols\BeerBundle\Entity\Beers'
        ));
    }

    public function getName()
    {
        return 'birrols_beerbundle_beerstype';
    }
}

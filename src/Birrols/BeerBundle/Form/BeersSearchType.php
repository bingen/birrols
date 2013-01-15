<?php

namespace Birrols\BeerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BeersSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('category', 'entity', array(
            'label' => 'beer.category',
            'class' => 'BirrolsBeerBundle:BeerCategories',
            'property' => 'category',
            'expanded' => true,
            'multiple' => true,
            ));
        $builder->add('type', 'entity', array(
            'label' => 'beer.type',
            'class' => 'BirrolsBeerBundle:BeerTypes',
            'property' => 'type',
            ));
//        $builder->add('brewery', 'entity', array(
//            'label' => 'business.name',
//            'class' => 'BirrolsBeerBundle:Business',
//            'property' => 'name',
//            ));
        $builder->add('country', 'country', array(
            'mapped' => false,
            'required' => false,
            'data' => '',
            'preferred_choices' => array('US', 'UK', 'ES')
            ));
        $builder->add('abv');
        $builder->add('ibu');
        //$builder->add('');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Birrols\BeerBundle\Entity\Beers'
        ));
    }

    public function getName()
    {
        return 'birrols_beerbundle_beerssearchtype';
    }
}
?>

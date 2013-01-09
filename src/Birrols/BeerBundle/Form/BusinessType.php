<?php

namespace Birrols\BeerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BusinessType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brewery')
            ->add('pub')
            ->add('store')
            ->add('homebrewStore')
            ->add('food')
            ->add('wifi')
            ->add('name')
            ->add('description')
            ->add('tapsNumber')
            ->add('score')
            ->add('address1')
            ->add('address2')
            ->add('zipCode')
            ->add('country')
            ->add('state')
            ->add('city')
            ->add('url')
            ->add('facebookUrl')
            ->add('twitterUrl')
            ->add('gplusUrl')
            ->add('foursquareUrl')
            ->add('email')
            ->add('phone')
            ->add('lat')
            ->add('lon')
            ->add('imagePath')
            ->add('imageUpdate')
            ->add('userAdmin')
            ->add('register')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Birrols\BeerBundle\Entity\Business'
        ));
    }

    public function getName()
    {
        return 'birrols_beerbundle_businesstype';
    }
}

<?php

namespace Birrols\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraint\UserPassword;

class ProfileFormType extends BaseType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('name', null, array(
                'label'     => 'profile.show.name',
                'translation_domain' => 'BirrolsUserBundle',
                ));
        $builder->add('lastName', null, array(
                'label'     => 'profile.show.lastname',
                'translation_domain' => 'BirrolsUserBundle',
                ));
        $builder->add('sex', 'choice', array( 
                'choices'   => array(1 => 'Male', 2 => 'Female'),
                'label'     => 'profile.show.sex',
                'translation_domain' => 'BirrolsUserBundle'
                ));
        $builder->add('birthday', 'birthday', array(
                'label'     => 'profile.show.birthday',
                'translation_domain' => 'BirrolsUserBundle',
                ));
        $builder->add('country', 'country', array(
                'label'     => 'profile.show.country',
                'translation_domain' => 'BirrolsUserBundle',
                ));
        $builder->add('language', 'language', array(
                'label'     => 'profile.show.language',
                'translation_domain' => 'BirrolsUserBundle',
                ));
        $builder->add('url', 'url', array(
                'label'     => 'profile.show.url',
                'translation_domain' => 'BirrolsUserBundle',
                ));
        $builder->add('image', 'file', array(
                'label'     => 'profile.show.image',
                'translation_domain' => 'BirrolsUserBundle',
                ));
    }

    public function getName()
    {
        return 'birrols_user_profile';
    }

}

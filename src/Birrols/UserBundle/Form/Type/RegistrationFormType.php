<?php

namespace Birrols\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('name', null, array(
                'required' => false,
                'label'     => 'profile.show.name',
                'translation_domain' => 'BirrolsUserBundle',
                ));
        $builder->add('lastName', null, array(
                'required' => false,
                'label'     => 'profile.show.lastname',
                'translation_domain' => 'BirrolsUserBundle',
                ));
        $builder->add('sex', 'choice', array( 
                'choices'   => array(1 => 'profile.show.sex.male', 2 => 'profile.show.sex.female'),
                'required' => false,
                'label'     => 'profile.show.sex.label',
                'translation_domain' => 'BirrolsUserBundle'
                ));
        $builder->add('birthday', 'birthday', array(
                'required' => false,
                'label'     => 'profile.show.birthday',
                'translation_domain' => 'BirrolsUserBundle',
                ));
        $builder->add('country', 'country', array(
                'required' => false,
                'label'     => 'profile.show.country',
                'translation_domain' => 'BirrolsUserBundle',
                'preferred_choices' => array('US', 'ES', 'UK')
                ));
        $builder->add('language', 'language', array(
                'required' => false,
                'label'     => 'profile.show.language',
                'translation_domain' => 'BirrolsUserBundle',
//TODO:                'choices' => array('ca', 'en', 'es'),
                ));
        $builder->add('url', 'url', array(
                'required' => false,
                'label'     => 'profile.show.url',
                'translation_domain' => 'BirrolsUserBundle',
                ));
        $builder->add('image', 'file', array(
                'required' => false,
                'label'     => 'profile.show.image',
                'translation_domain' => 'BirrolsUserBundle',
                ));
    }

    public function getName()
    {
        return 'birrols_user_registration';
    }
}

?>

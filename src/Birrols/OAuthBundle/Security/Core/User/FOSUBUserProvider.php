<?php

/*
 * This file is part of the HWIOAuthBundle package.
 *
 * (c) Hardware.Info <opensource@hardware.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Birrols\OAuthBundle\Security\Core\User;

//use FOS\UserBundle\Model\UserManagerInterface;

//use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface,
//    HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException,
//    HWI\Buuse FOS\UserBundle\Model\UserManagerInterface;

use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseProvider;

use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface,
    HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException,
    Birrols\OAuthBundle\OAuth\Response\GoogleUserResponse;

/**
 * Class providing a bridge to use the FOSUB user provider with HWIOAuth.
 *
 * In order to use the class as a connector, the appropriate setters for the
 * property mapping should be available.
 *
 * @author Alexander <iam.asm89@gmail.com>
 */
class FOSUBUserProvider extends BaseProvider
{
    protected $container;

    public function __construct(UserManagerInterface $userManager, array $properties, ContainerInterface $container)
    {
        $this->userManager = $userManager;
        // TODO: why? appears as an array nested in an array
        $this->properties  = $properties[0];
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        var_dump($this->properties);
        
        $username = $response->getUsername();
        $user = $this->userManager->findUserBy(array($this->getProperty($response) => $username));

        if (null === $user) {
//            if( $this->container->getParameter('hwi_oauth.user.policy') != 'auto') {
                throw new AccountNotLinkedException(sprintf("User '%s' not found.", $username));
//            }

            // create new user here
            $user = $this->userManager->createUser();

//            $formHandler = $this->container->get('hwi_oauth.registration.form.handler');
//            $username = $formHandler->getUniqueUsernameExtended($response, $user);
//            if( empty($username) ){
//                throw new AccountNotLinkedException(sprintf("User '%s' not found, and unable to create a new one.", $username));
//            }
//            // set user name, email ...
//            $user->setUsername($username);
//            $user->setPassword($user->randString(8));
//            $user->setEmail($response->getEmail());
//            if( $response instanceof GoogleUserResponse ) {
//                $user->setName($response->getFirstName());
//                $user->setLastName($response->getLastName());
//                $user->setSex($response->getGender());
//                //$user->setBirthday();
//                $user->setUrl($response->getUrl());
//                $user->setLanguage(locale_get_primary_language($response->getLocale()));
//                $user->setCountry(locale_get_region($response->getLocale()));
//                $user->setGoogleId($response->getGoogleId());
//                $user->setEnabled(TRUE);
//            }
            

//            $this->userManager->updateUser($user);
        }

        return $user;
    }

}

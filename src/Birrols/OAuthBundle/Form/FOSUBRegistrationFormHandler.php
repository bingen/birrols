<?php

namespace Birrols\OAuthBundle\Form;

use HWI\Bundle\OAuthBundle\Form\FOSUBRegistrationFormHandler as BaseHandler;

use HWI\Bundle\OAuthBundle\OAuth\Response\AdvancedUserResponseInterface,
    HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface,
    Birrols\OAuthBundle\OAuth\Response\GoogleUserResponse;

use Symfony\Component\Form\Form,
    Symfony\Component\HttpFoundation\Request;

use Birrols\UserBundle\Entity\Users;

/**
 * Description of FOSUBRegistrationFormHandler
 *
 * @author bingen
 */
class FOSUBRegistrationFormHandler extends BaseHandler {

    public function process(Request $request, Form $form, UserResponseInterface $userInformation)
    {
        $formHandler = $this->reconstructFormHandler($request, $form);

        // make FOSUB process the form already
        $processed = $formHandler->process();

        // if the form is not posted we'll try to set some properties
        if ('POST' !== $request->getMethod()) {
            $this->fillForm($form, $userInformation);
        }

        return $processed;
    }
    
    public function fillForm( Form $form, UserResponseInterface $userInformation ) {
            $user = $form->getData();

            $user->setUsername($this->getUniqueUsernameExtended($userInformation, $user));

            if ($userInformation instanceof AdvancedUserResponseInterface && method_exists($user, 'setEmail')) {
                $user->setEmail($userInformation->getEmail());
            }

            if ($userInformation instanceof GoogleUserResponse && method_exists($user, 'setName')) {
                $user->setName($userInformation->getFirstName());
            }

            if ($userInformation instanceof GoogleUserResponse && method_exists($user, 'setLastName')) {
                $user->setLastName($userInformation->getLastName());
            }
            if ($userInformation instanceof GoogleUserResponse && method_exists($user, 'setSex')) {
                $user->setSex($userInformation->getGender());
            }
            if ($userInformation instanceof GoogleUserResponse && method_exists($user, 'setLocale')) {
                $user->setLocale($userInformation->getLocale());
            }
            if ($userInformation instanceof GoogleUserResponse && method_exists($user, 'setUrl')) {
                $user->setUrl($userInformation->getUrl());
            }
            // TODO: picture
//            if ($userInformation instanceof AdvancedUserResponseInterface && method_exists($user, 'setAvatar')) {
//                $user->setAvatar($userInformation->getProfilePicture());
//            }

            $form->setData($user);
        
    }

    /**
     * Attempts to get a unique username for the user.
     *
     * @param string $name
     *
     * @return string Name, or empty string if it failed after all the iterations.
     */
    public function getUniqueUserNameExtended(UserResponseInterface $userInformation, Users $user)
    {
        $arrayNames = array();
        
        // e-mail
        if ($userInformation instanceof AdvancedUserResponseInterface ) {
            $arrayNames[] = preg_replace( '/([^@]*).*/', '$1', $userInformation->getEmail() );
        }
        // first name
        if ($userInformation instanceof AdvancedUserResponseInterface ) {
            $firstName = $userInformation->getFirstName();
            $arrayNames[] = trim($firstName);
        }
        // last name
        if ($userInformation instanceof AdvancedUserResponseInterface ) {
            $lastName = $userInformation->getLastName();
            $arrayNames[] = trim($lastName);
        }
        // first.last
        if( !empty($firstName) && !empty($lastName) ) {
            $arrayNames[] = $firstName . '.' . $lastName;
        }
        // nickname
        $arrayNames[] = trim($userInformation->getNickname());

        $i = 0;
        $sufix = '';
        do {
            $j = 0;
            do {
                $testName = $arrayNames[$j] . $sufix;
                $user = $this->userManager->findUserByUsername($testName);
            } while ($user !== null && array_key_exists(++$j, $arrayNames) );
        } while ($user !== null && $i < $this->iterations && $sufix = ++$i);

        return $user !== null ? '' : strtolower($testName);
    }

}
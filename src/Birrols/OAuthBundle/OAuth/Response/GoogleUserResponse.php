<?php

namespace Birrols\OAuthBundle\OAuth\Response;

use HWI\Bundle\OAuthBundle\OAuth\Response\AdvancedPathUserResponse;

/**
 * GoogleUserResponse
 *
 */
class GoogleUserResponse extends AdvancedPathUserResponse
{
    /**
     * {@inheritdoc}
     */
    public function getNickname()
    {
        return trim($this->getValueForPath('firstname'))
               . '.' . trim($this->getValueForPath('lastname'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->getValueForPath('email', false);
    }

    /**
     * {@inheritdoc}
     */
    public function getProfilePicture()
    {
        return $this->getValueForPath('profilepicture', false);
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstName()
    {
        return $this->getValueForPath('firstname', false);
    }

    /**
     * {@inheritdoc}
     */
    public function getLastName()
    {
        return $this->getValueForPath('lastname', false);
    }

    /**
     * {@inheritdoc}
     */
    public function getGender()
    {
        return strtr( $this->getValueForPath('gender', false), array(
            'male' => 1,
            'female' =>2
        ) );
    }

    /**
     * {@inheritdoc}
     */
    public function getLocale()
    {
        return $this->getValueForPath('locale', false);
    }

    public function getGoogleId()
    {
        return $this->getValueForPath('identifier', false);
    }

    public function getUrl()
    {
        return $this->getValueForPath('url', false);
    }
}
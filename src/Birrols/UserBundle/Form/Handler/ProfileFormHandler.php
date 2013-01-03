<?php

namespace Birrols\UserBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\ProfileFormHandler as BaseHandler;

use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class ProfileFormHandler extends BaseHandler
{
    public function process(UserInterface $user)
    {
        $this->form->setData($user);

        if ('POST' === $this->request->getMethod()) {
            if( $user->image ) {
                $user->updateImage++;
            }
            $this->form->bind($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($user);

                return true;
            }

            // Reloads the user to reset its username. This is needed when the
            // username or password have been changed to avoid issues with the
            // security layer.
            $this->userManager->reloadUser($user);
        }

        return false;
    }

}

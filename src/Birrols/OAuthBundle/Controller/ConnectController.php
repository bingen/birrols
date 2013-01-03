<?php

namespace Birrols\OAuthBundle\Controller;

use HWI\Bundle\OAuthBundle\Controller\ConnectController as BaseController;

use HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\RedirectResponse;

class ConnectController extends BaseController
{
//    public function connectAction(Request $request)
//    {
//        $connect = $this->container->getParameter('hwi_oauth.connect');
//        $hasUser = $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED');
//
//        $error = $this->getErrorForRequest($request);
//
//        // if connecting is enabled and there is no user, redirect to the registration form
//        if ($connect
//            && !$hasUser
//            && $error instanceof AccountNotLinkedException
//        ) {
//            $key = time();
//            $session = $request->getSession();
//            $session->set('_hwi_oauth.registration_error.'.$key, $error);
//
//            return new RedirectResponse($this->generate('hwi_oauth_connect_registration', array('key' => $key)));
////            return $this->container->get('templating')->renderResponse('BirrolsOAuthBundle:Default:index.html.twig', array(
////                'error'   => $error->getMessage(),
////                'error_instance' => $error->getTraceAsString(),
////                'connect' => $connect ,
////                'hasUser' => $hasUser,
////                'donde'   => 'primero',
////                ));
//        }
//
//        if ($error) {
//            // TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
//            $error = $error->getMessage();
//        }
//
//        return $this->container->get('templating')->renderResponse('HWIOAuthBundle:Connect:login.html.twig', array(
//            'error'   => $error,
//        ));
//    }

    public function registrationAction(Request $request, $key)
    {
        $hasUser = $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED');
        $connect = $this->container->getParameter('hwi_oauth.connect');

        $session = $request->getSession();
        $error = $session->get('_hwi_oauth.registration_error.'.$key);
        $session->remove('_hwi_oauth.registration_error.'.$key);

        if (!$connect || $hasUser || !($error instanceof AccountNotLinkedException) || (time() - $key > 300)) {
            // todo: fix this
            throw new \Exception('Cannot register an account.');
        }

        $userInformation = $this->getResourceOwnerByName($error->getResourceOwnerName())
            ->getUserInformation($error->getAccessToken());

        $form = $this->container->get('hwi_oauth.registration.form');
        $formHandler = $this->container->get('hwi_oauth.registration.form.handler');
        if( $this->container->getParameter('hwi_oauth.user.policy') === 'auto') {
            $userManager = $this->container->get('fos_user.user_manager');
            $user = $userManager->createUser();
            $form->setData($user);
            $formHandler->fillForm($form, $userInformation);
            $this->prepareRequest( $form, $request, $user );
        }
        if ($formHandler->process($request, $form, $userInformation)) {
            $this->container->get('hwi_oauth.account.connector')->connect($form->getData(), $userInformation);

            // Authenticate the user
            $this->authenticateUser($form->getData());

            return $this->container->get('templating')->renderResponse('HWIOAuthBundle:Connect:registration_success.html.twig', array(
                'userInformation' => $userInformation,
            ));
        }

        // reset the error in the session
        $key = time();
        $session->set('_hwi_oauth.registration_error.'.$key, $error);

        return $this->container->get('templating')->renderResponse('HWIOAuthBundle:Connect:registration.html.twig', array(
            'key' => $key,
            'form' => $form->createView(),
            'userInformation' => $userInformation,
        ));
    }
    
    public function prepareRequest( $form, $request, $user ) {
        $request->setMethod('POST');
        // TODO: Symfony\Component\Form\Util\PropertyPath
        // setValue -> writeProperty 'username' is not index and 'viewData is not object
        // $viewData = array();
        // $form->getConfig()->getDataMapper()->mapFormsToData($form->all(), $viewData);
        $fields = array();
        foreach( $form->all() as $key => $child ) {
            $fields[$key] = $child->getData();
        }
        $password = $user->randString(8);
        $fields['plainPassword'] = array('first' => $password, 'second' => $password);
        // TODO: !!!!!!!
        $fields['_token'] = '2bdfb709a7b2b569d8b79dc189bda59dbd0b427d';
        $request->request->add( array('fos_user_registration_form' => $fields ) );
        if( $fields['language'] ) {
//            $request->setDefaultLocale( $fields['language'] );
            $request->setLocale( $fields['language'] );
        }
        
    }
}

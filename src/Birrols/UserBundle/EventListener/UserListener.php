<?php

// https://gist.github.com/1670163
// http://stackoverflow.com/questions/12146282/changing-locale-with-symfony-2-1
// http://symfony.com/doc/current/book/translation.html#handling-the-user-s-locale
// https://github.com/symfony/symfony/blob/master/UPGRADE-2.1.md#httpfoundation-1

namespace Birrols\UserBundle\EventListener;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent,
    Symfony\Component\HttpKernel\Event\GetResponseEvent,
    Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Session;

class UserListener
{
    private $session;

    public function setSession($session) {
        $this->session = $session;
    }    

    /**
     * kernel.request event. If a guest user doesn't have an opened session, locale is equal to
     * "undefined" as configured by default in parameters.ini. If so, set as a locale the user's
     * preferred language.
     *
     * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
     */
    public function setLocaleForUnauthenticatedUser(GetResponseEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }
        $request = $event->getRequest();
        if ('undefined' == $request->getLocale()) {
            if($locale = $request->getSession()->get('_locale')) {
                $request->setLocale($locale);
            } else {
                $request->setLocale($request->getPreferredLanguage());
            }
        }
    }
 
    /**
     * security.interactive_login event. If a user chose a locale in preferences, it would be set,
     * if not, a locale that was set by setLocaleForUnauthenticatedUser remains.
     *
     * @param \Symfony\Component\Security\Http\Event\InteractiveLoginEvent $event
     */
    public function setLocaleForAuthenticatedUser(InteractiveLoginEvent $event)
    {
        /** @var \Birrols\UserBundle\Entity\User $user  */
        $user = $event->getAuthenticationToken()->getUser();
 
        if ($locale = $user->getLocale()) {
//            $event->getRequest()->setLocale($user->getLocale());
            $this->session->set('_locale', $locale);
        }
    }
}
?>

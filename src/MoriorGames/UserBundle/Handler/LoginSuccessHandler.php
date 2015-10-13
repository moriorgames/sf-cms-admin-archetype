<?php

namespace MoriorGames\UserBundle\Handler;

use Symfony\Component\Routing\Router;
use MoriorGames\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

/**
 * Class LoginSuccessHandler.
 */
class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * @var TokenStorage
     */
    protected $security;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @param Router       $router
     * @param TokenStorage $security
     * @param Session      $session
     */
    public function __construct(Router $router, TokenStorage $security, Session $session)
    {
        $this->router = $router;
        $this->security = $security;
        $this->session = $session;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        /** @var User $user */
        $user = $this->security->getToken()->getUser();
        $response = new RedirectResponse(
            $this->router->generate('fos_user_profile_show')
        );

        // If the user is an admin redirect to dashboard
        if ($user->hasRole('ROLE_SUPER_ADMIN') || $user->hasRole('ROLE_ADMIN')) {
            $response = new RedirectResponse(
                $this->router->generate('sonata_admin_dashboard')
            );
        }

        return $response;
    }
}

<?php

namespace Genedys\CsrfRouteBundle\Twig\Extension;

use Genedys\CsrfRouteBundle\Handler\TokenHandlerInterface;
use Genedys\CsrfRouteBundle\Routing\CsrfRouterInterface;
use Genedys\CsrfRouteBundle\Routing\Router\CsrfRouter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CsrfTokenExtension extends AbstractExtension
{
    /**
     * @var CsrfRouter
     */
    protected $csrfRouter;

    /**
     * @var TokenHandlerInterface
     */
    protected $tokenHandler;

    /**
     * @param CsrfRouterInterface   $csrfRouter
     * @param TokenHandlerInterface $tokenHandler
     */
    public function __construct(CsrfRouterInterface $csrfRouter, TokenHandlerInterface $tokenHandler)
    {
        $this->csrfRouter   = $csrfRouter;
        $this->tokenHandler = $tokenHandler;
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('csrf_token', [$this, 'getToken']),
        ];
    }

    /**
     * @param string $routeName
     *
     * @return string
     */
    public function getToken($routeName): string
    {
        $token = $this->csrfRouter->getCsrfToken($routeName);

        return $token ? $this->tokenHandler->getToken($token->getIntention() ?: $routeName) : '';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'genedys_csrf.csrf_token';
    }
}

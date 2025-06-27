<?php

namespace Genedys\CsrfRouteBundle\Routing\Loader;

use Genedys\CsrfRouteBundle\Annotation\CsrfToken;
use Genedys\CsrfRouteBundle\Routing\TokenProviderInterface;
use Symfony\Bundle\FrameworkBundle\Routing\AttributeRouteControllerLoader;
use Symfony\Component\Routing\Route;

/**
 * @author Fabien Antoine <fabien@fantoine.fr>
 */
class CsrfLoader extends AttributeRouteControllerLoader
{
    /**
     * Configures the CSRF token options
     *
     * @param Route             $route  A route instance
     * @param \ReflectionClass  $class  A ReflectionClass instance
     * @param \ReflectionMethod $method A ReflectionClass method
     * @param mixed             $annot  The annotation class instance
     *
     * @throws \LogicException When the service option is specified on a method
     */
    protected function configureRoute(Route $route, \ReflectionClass $class, \ReflectionMethod $method, $annot): void
    {
        parent::configureRoute($route, $class, $method, $annot);

        /** @var CsrfToken|null $attribute */
        $attribute = ($method->getAttributes(CsrfToken::class)[0] ?? null)?->newInstance();

        if (null !== $attribute) {
            // Store the CsrfToken options on Route options
            $route->setOption(TokenProviderInterface::OPTION_NAME, $attribute->toOption());
        }
    }
}

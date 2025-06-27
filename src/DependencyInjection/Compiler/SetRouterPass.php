<?php

namespace Genedys\CsrfRouteBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Fabien Antoine <fabien@fantoine.fr>
 */
class SetRouterPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container): void
    {
        // Replace default router
        if ($container->hasAlias('router')) {
            // Set parent router
            $container
                ->findDefinition('genedys_csrf_route.routing.router')
                ->addArgument(new Reference((string) $container->getAlias('router')));
            ;

            // Update alias
            $container->setAlias('router', 'genedys_csrf_route.routing.router');
        }

        // Replace route attribute loader
        $container
            ->findDefinition('routing.loader.attribute')
            ->setClass('%genedys_csrf_route.routing.loader.class%')
        ;
    }
}

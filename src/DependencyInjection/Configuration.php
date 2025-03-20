<?php

namespace Genedys\CsrfRouteBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Fabien Antoine <fabien@fantoine.fr>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('genedys_csrf_route');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->booleanNode('enabled')->defaultTrue()->end()
                ->scalarNode('field_name')->defaultValue('_token')->end()
                ->scalarNode('token_provider_class')->defaultValue('Genedys\\CsrfRouteBundle\\Routing\\TokenProvider\\TokenProvider')->end()
                ->scalarNode('token_provider_base_class')->defaultValue('Genedys\\CsrfRouteBundle\\Routing\\TokenProvider\\AbstractTokenProvider')->end()
                ->scalarNode('token_provider_dumper_class')->defaultValue('Genedys\\CsrfRouteBundle\\Routing\\TokenProvider\\Dumper\\TokenProviderDumper')->end()
                ->scalarNode('token_provider_cache_class')->defaultValue('%kernel.container_class%CsrfTokenProvider')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

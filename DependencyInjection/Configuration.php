<?php

namespace C33s\ContactFormBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('c33s_contact_form');
        
        $rootNode
            ->children()
                ->scalarNode('sender_email')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->arrayNode('recipients')
                    ->defaultValue(array())
                    ->useAttributeAsKey('email')
                    ->prototype('scalar')
                        ->isRequired()
                        ->cannotBeEmpty()
                    ->end()
                ->end()
                ->booleanNode('send_copy_to_user')
                    ->defaultValue(false)
                ->end()
            ->end()
        ;
        
        return $treeBuilder;
    }
}

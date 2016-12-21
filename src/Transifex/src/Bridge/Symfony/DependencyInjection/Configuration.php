<?php

/*
 * This file is part of the PHP Translation package.
 *
 * (c) PHP Translation team <tobias.nyholm@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Translation\PlatformAdapter\Transifex\Bridge\Symfony\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $root = $treeBuilder->root('translation_adapter_transifex');

        $root->children()
            ->scalarNode('username')->cannotBeEmpty()->end()
            ->scalarNode('password')->cannotBeEmpty()->end()
        ->end();

        return $treeBuilder;
    }

    /**
     * @return \Symfony\Component\Config\Definition\Builder\NodeDefinition
     */
    private function getProjectNode()
    {
        $treeBuilder = new TreeBuilder();
        $node = $treeBuilder->root('projects');
        $node
            ->useAttributeAsKey('name')
            ->prototype('array')
            ->children()
                ->arrayNode('domains')
                    ->requiresAtLeastOneElement()
                    ->prototype('scalar')->end()
                ->end()
            ->end()
        ->end();

        return $node;
    }
}

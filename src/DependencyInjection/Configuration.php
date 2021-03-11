<?php

declare(strict_types=1);

namespace Darake\SculpinNewPostsListBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('sculpin_new_posts_list');

        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
            ->scalarNode('relative_path')->end()
            ->scalarNode('max_per_page')->end()
            ->end();

        return $treeBuilder;
    }
}

<?php

namespace Darake\SculpinNewPostsListBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class SculpinNewPostsListExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration;
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $relativePath = array_key_exists('relative_path', $config) ? $config['relative_path'] : "_posts";
        $maxPerPage = array_key_exists('max_per_page', $config) ? $config['max_per_page'] : 5;

        $container->setParameter('sculpin_new_posts_list.relative_path', $relativePath);
        $container->setParameter('sculpin_new_posts_list.max_per_page', $maxPerPage);
    }
}

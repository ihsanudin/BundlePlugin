<?php

namespace Matthias\BundlePlugins\Tests;

use Matthias\BundlePlugins\BundlePlugin;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class CorePlugin implements BundlePlugin
{
    public function name()
    {
        return 'core';
    }

    public function load(array $pluginConfiguration, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__));
        $loader->load('core.yml');
    }

    public function addConfiguration(ArrayNodeDefinition $pluginNode)
    {
        $pluginNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('where')
                    ->defaultValue('Amsterdam')
                ->end()
            ->end();
    }
}

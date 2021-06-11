<?php

declare(strict_types=1);

namespace AdgoalCommon\ErrorReportingBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration.
 *
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 *
 * @category AdgoalCommon\ErrorReportingBundle
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     *
     * @psalm-suppress PossiblyUndefinedMethod
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('adgoal_error_reporting');
        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('client_name')->info('for example error')->end()
                ->scalarNode('client_producer')->info('for example @enqueue.client.error.producer')->end()
            ->end();

        return $treeBuilder;
    }
}

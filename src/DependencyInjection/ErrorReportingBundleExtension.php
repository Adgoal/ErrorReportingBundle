<?php

declare(strict_types=1);

namespace AdgoalCommon\ErrorReportingBundle\DependencyInjection;

use AdgoalCommon\ErrorReporting\Application\Processor\ErrorEventProcessor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * Class ErrorReportingBundleExtension.
 *
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 *
 * @category AdgoalCommon\ErrorReportingBundle
 */
class ErrorReportingBundleExtension extends ConfigurableExtension
{
    /**
     * Configures the passed container according to the merged configuration.
     *
     * @param mixed[]          $mergedConfig
     * @param ContainerBuilder $container
     *
     * @throws \Exception
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container): void
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $loader->load('error_reporting.yml');

        $container->setAlias(
            'adgoal.error_reporting.client_producer',
            new Alias($mergedConfig['client_producer'], true)
        );

        $errorEventProcessor = $container->getDefinition(ErrorEventProcessor::class);
        $errorEventProcessor->addTag('enqueue.topic_subscriber', ['client' => $mergedConfig['client_name']]);
        $container->setDefinition(ErrorEventProcessor::class, $errorEventProcessor);
    }

    /**
     * Returns the bundle configuration alias.
     *
     * @return string
     */
    public function getAlias(): string
    {
        return 'adgoal_error_reporting';
    }
}

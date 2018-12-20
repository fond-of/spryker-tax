<?php

namespace FondOfSpryker\Zed\Tax;

use FondOfSpryker\Zed\Tax\Dependency\Facade\TaxToCountryBridge;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Tax\TaxDependencyProvider as SprykerTaxDependencyProvider;

class TaxDependencyProvider extends SprykerTaxDependencyProvider
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        parent::provideCommunicationLayerDependencies($container);

        $container[self::FACADE_COUNTRY] = function (Container $container) {
            return new TaxToCountryBridge($container->getLocator()->country()->facade());
        };
    }
}

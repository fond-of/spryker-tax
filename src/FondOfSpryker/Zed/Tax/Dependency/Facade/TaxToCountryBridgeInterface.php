<?php

namespace FondOfSpryker\Zed\Tax\Dependency\Facade;

use Spryker\Zed\Tax\Dependency\Facade\TaxToCountryBridgeInterface as SprykerTaxToCountryBridgeInterface;

interface TaxToCountryBridgeInterface extends SprykerTaxToCountryBridgeInterface
{
    public function getCountryByIso2Code(string $iso2Code);

    public function getCountryByIdCountry(int $idCountry);
}

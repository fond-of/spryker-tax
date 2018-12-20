<?php

namespace FondOfSpryker\Zed\Tax\Dependency\Facade;

use Generated\Shared\Transfer\CountryCollectionTransfer;
use Spryker\Zed\Tax\Dependency\Facade\TaxToCountryBridge as SprykerTaxToCountryBridge;

class TaxToCountryBridge extends SprykerTaxToCountryBridge implements TaxToCountryBridgeInterface
{
    public function getCountryByIso2Code(string $iso2Code)
    {
        return $this->countryFacade->getCountryByIso2Code($iso2Code);
    }

    public function getCountryByIdCountry(int $idCountry)
    {
        return $this->countryFacade->getCountryByIdCountry($idCountry);
    }
}


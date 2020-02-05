<?php

namespace FondOfSpryker\Zed\Tax\Communication\Form\DataProvider;

use FondOfSpryker\Zed\Tax\Communication\Form\TaxRateForm;
use Spryker\Zed\Tax\Communication\Form\DataProvider\TaxRateFormDataProvider as SprykerTaxRateFormDataProvider;

class TaxRateFormDataProvider extends SprykerTaxRateFormDataProvider
{
    /**
     * @return array
     */
    public function getOptions()
    {
        return [
            TaxRateForm::FIELD_COUNTRY => $this->createCountryList(),
            TaxRateForm::FIELD_REGION => $this->createRegionList(),
        ];
    }

    /**
     * @return array
     */
    protected function createRegionList()
    {
        $regions = [0 => 'No Region'];

        if (!$this->taxRateTransfer) {
            return $regions;
        }

        $countryTransfer = $this->countryFacade->getCountryByIso2Code($this->taxRateTransfer->getCountry()->getIso2Code());

        foreach ($countryTransfer->getRegions() as $regionTransfer) {
            $regions[$regionTransfer->getIdRegion()] = $regionTransfer->getName();
        }

        return $regions;
    }
}

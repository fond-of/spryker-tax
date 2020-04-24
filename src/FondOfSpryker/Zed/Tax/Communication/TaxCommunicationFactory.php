<?php

namespace FondOfSpryker\Zed\Tax\Communication;

use FondOfSpryker\Zed\Tax\Communication\Form\DataProvider\TaxRateFormDataProvider as FondOfSprykerTaxRateFormDataProvider;
use FondOfSpryker\Zed\Tax\Communication\Form\TaxRateForm;
use FondOfSpryker\Zed\Tax\Communication\Table\RateTable;
use FondOfSpryker\Zed\Tax\TaxDependencyProvider;
use Generated\Shared\Transfer\TaxRateTransfer;
use Spryker\Zed\Tax\Communication\Form\DataProvider\TaxRateFormDataProvider;
use Spryker\Zed\Tax\Communication\TaxCommunicationFactory as SprykerTaxCommunicationFactory;

/**
 * @method \Spryker\Zed\Tax\Persistence\TaxQueryContainerInterface getQueryContainer()
 */
class TaxCommunicationFactory extends SprykerTaxCommunicationFactory
{
    /**
     * @param \Spryker\Zed\Tax\Communication\Form\DataProvider\TaxRateFormDataProvider|null $taxRateFormDataProvider Deprecated: TaxRateFormDataProvider must not be passed in.
     * @param \Generated\Shared\Transfer\TaxRateTransfer|null $taxRateTransfer
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getTaxRateForm(?TaxRateFormDataProvider $taxRateFormDataProvider = null, ?TaxRateTransfer $taxRateTransfer = null)
    {
        return $this->getFormFactory()->create(
            TaxRateForm::class,
            $taxRateTransfer ?: $this->getTaxRateFormData($taxRateFormDataProvider),
            [
                'data_class' => TaxRateTransfer::class,
            ]
        );
    }

    /**
     * @return \Spryker\Zed\Tax\Communication\Table\RateTable
     */
    public function createTaxRateTable()
    {
        $taxRateQuery = $this->getQueryContainer()->queryAllTaxRates();

        return new RateTable($taxRateQuery, $this->getDateTimeService());
    }

    /**
     * @param \Generated\Shared\Transfer\TaxRateTransfer|null $taxRateTransfer
     *
     * @return \Spryker\Zed\Tax\Communication\Form\DataProvider\TaxRateFormDataProvider
     */
    public function createTaxRateFormDataProvider(?TaxRateTransfer $taxRateTransfer = null)
    {
        return new FondOfSprykerTaxRateFormDataProvider(
            $this->getCountryFacade(),
            $this->getFacade(),
            $taxRateTransfer
        );
    }

    /**
     * @return \Spryker\Zed\Tax\Dependency\Facade\TaxToCountryBridgeInterface
     */
    public function getCountryFacade()
    {
        return $this->getProvidedDependency(TaxDependencyProvider::FACADE_COUNTRY);
    }
}

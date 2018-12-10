<?php

namespace FondOfSpryker\Zed\Tax\Communication;

use FondOfSpryker\Zed\Tax\Communication\Table\RateTable;
use Spryker\Zed\Tax\Communication\TaxCommunicationFactory as SprykerTaxCommunicationFactory;

/**
 * @method \Spryker\Zed\Tax\Persistence\TaxQueryContainerInterface getQueryContainer()
 */
class TaxCommunicationFactory extends SprykerTaxCommunicationFactory
{
    /**
     * @return \Spryker\Zed\Tax\Communication\Table\RateTable
     */
    public function createTaxRateTable()
    {
        $taxRateQuery = $this->getQueryContainer()->queryAllTaxRates();

        return new RateTable($taxRateQuery, $this->getDateTimeService());
    }

}

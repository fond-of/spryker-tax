<?php

namespace FondOfSpryker\Zed\Tax\Persistence;

use FondOfSpryker\Zed\Tax\Persistence\Propel\Mapper\TaxRateMapper;
use Spryker\Zed\Tax\Persistence\Propel\Mapper\TaxRateMapperInterface;
use Spryker\Zed\Tax\Persistence\TaxPersistenceFactory as SprykerTaxPersistenceFactory;

class TaxPersistenceFactory extends SprykerTaxPersistenceFactory
{
    /**
     * @return \FondOfSpryker\Zed\Tax\Persistence\Propel\Mapper\TaxRateMapperInterface
     */
    public function createTaxRateMapper(): TaxRateMapperInterface
    {
        return new TaxRateMapper();
    }

}

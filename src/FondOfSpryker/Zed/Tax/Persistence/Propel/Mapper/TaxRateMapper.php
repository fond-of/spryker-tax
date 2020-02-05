<?php

namespace FondOfSpryker\Zed\Tax\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\RegionTransfer;
use Generated\Shared\Transfer\TaxRateTransfer;
use Orm\Zed\Tax\Persistence\SpyTaxRate;
use Spryker\Zed\Tax\Persistence\Propel\Mapper\TaxRateMapper as SprykerTaxRateMapper;

class TaxRateMapper extends SprykerTaxRateMapper
{
    /**
     * @param \Orm\Zed\Tax\Persistence\SpyTaxRate $taxRateEntity
     * @param \Generated\Shared\Transfer\TaxRateTransfer $taxRateTransfer
     *
     * @return \Generated\Shared\Transfer\TaxRateTransfer
     */
    public function mapTaxRateEntityToTaxRateTransfer(
        SpyTaxRate $taxRateEntity,
        TaxRateTransfer $taxRateTransfer
    ): TaxRateTransfer {
        $taxRateTransfer = parent::mapTaxRateEntityToTaxRateTransfer($taxRateEntity, $taxRateTransfer);

        /**
         * @var \Orm\Zed\Country\Persistence\SpyRegion|null
         */
        $regionEntity = $taxRateEntity->getSpyRegion();

        if ($regionEntity === null) {
            return $taxRateTransfer;
        }

        $regionTransfer = new RegionTransfer();
        $regionTransfer->fromArray($regionEntity->toArray(), true);
        $taxRateTransfer->setRegion($regionTransfer);

        return $taxRateTransfer;
    }
}

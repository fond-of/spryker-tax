<?php

namespace FondOfSpryker\Zed\Tax\Communication\Table;

use Orm\Zed\Country\Persistence\Map\SpyCountryTableMap;
use Orm\Zed\Country\Persistence\Map\SpyRegionTableMap;
use Orm\Zed\Tax\Persistence\Map\SpyTaxRateTableMap;
use Orm\Zed\Tax\Persistence\SpyTaxRate;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use Spryker\Zed\Tax\Communication\Table\RateTable as SprykerRateTable;

class RateTable extends SprykerRateTable
{
    public const REGION_NOT_AVAILABLE = 'N/A';

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    protected function configure(TableConfiguration $config)
    {
        $url = Url::generate('listTable')->build();

        $config->setUrl($url);
        $config->setHeader([
            SpyTaxRateTableMap::COL_ID_TAX_RATE => 'Tax rate ID',
            SpyTaxRateTableMap::COL_NAME => 'Name',
            SpyTaxRateTableMap::COL_CREATED_AT => 'Created at',
            SpyCountryTableMap::COL_NAME => 'Country',
            SpyRegionTableMap::COL_NAME => 'Region',
            SpyTaxRateTableMap::COL_RATE => 'Percentage',
            self::TABLE_COL_ACTIONS => 'Actions',
        ]);

        $config->setSearchable([
            SpyTaxRateTableMap::COL_NAME,
            SpyCountryTableMap::COL_NAME,
        ]);

        $config->setSortable([
            SpyTaxRateTableMap::COL_ID_TAX_RATE,
            SpyCountryTableMap::COL_NAME,
            SpyTaxRateTableMap::COL_NAME,
            SpyTaxRateTableMap::COL_RATE,
            SpyTaxRateTableMap::COL_CREATED_AT,
        ]);

        $config->setDefaultSortColumnIndex(0);
        $config->setDefaultSortDirection(TableConfiguration::SORT_DESC);
        $config->addRawColumn(self::TABLE_COL_ACTIONS);

        return $config;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config)
    {
        $result = [];
        $query = $this->taxRateQuery
            ->leftJoinCountry(SpyCountryTableMap::TABLE_NAME)
            ->leftJoinSpyRegion(SpyRegionTableMap::TABLE_NAME);

        /** @var \Orm\Zed\Tax\Persistence\SpyTaxRate[] $queryResult */
        $queryResult = $this->runQuery($query, $config, true);

        foreach ($queryResult as $taxRateEntity) {
            $result[] = [
                SpyTaxRateTableMap::COL_ID_TAX_RATE => $taxRateEntity->getIdTaxRate(),
                SpyTaxRateTableMap::COL_CREATED_AT => $this->utilDateTimeService->formatDateTime($taxRateEntity->getCreatedAt()),
                SpyTaxRateTableMap::COL_NAME => $taxRateEntity->getName(),
                SpyCountryTableMap::COL_NAME => $this->getCountryName($taxRateEntity),
                SpyTaxRateTableMap::COL_RATE => $taxRateEntity->getRate(),
                SpyRegionTableMap::COL_NAME => $this->getRegionName($taxRateEntity),
                self::TABLE_COL_ACTIONS => $this->getActionButtons($taxRateEntity),
            ];
        }

        return $result;
    }

    /**
     * @param \Orm\Zed\Tax\Persistence\SpyTaxRate $taxRateEntity
     *
     * @return string
     */
    protected function getRegionName(SpyTaxRate $taxRateEntity)
    {
        $regionName = self::REGION_NOT_AVAILABLE;

        /** @var \Orm\Zed\Country\Persistence\SpyCountry|null $countryEntity */
        $regionEntity = $taxRateEntity->getSpyRegion();
        if ($regionEntity) {
            $regionName = $regionEntity->getName();
        }

        return $regionName;
    }
}

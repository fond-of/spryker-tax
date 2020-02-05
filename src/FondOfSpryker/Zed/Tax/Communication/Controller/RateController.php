<?php

namespace FondOfSpryker\Zed\Tax\Communication\Controller;

use Spryker\Zed\Tax\Communication\Controller\RateController as SprykerRateController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \FondOfSpryker\Zed\Tax\Communication\TaxCommunicationFactory getFactory()
 * @method \Spryker\Zed\Tax\Business\TaxFacadeInterface getFacade()
 * @method \Spryker\Zed\Tax\Persistence\TaxQueryContainerInterface getQueryContainer()
 */
class RateController extends SprykerRateController
{
    public const PARAM_URL_ID_COUNTRY = 'id_country';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array
     */
    public function regionsAction(Request $request)
    {
        $idCountry = $request->query->getInt(self::PARAM_URL_ID_COUNTRY);
        $country = $this->getFactory()->getCountryFacade()->getCountryByIdCountry($idCountry);
        $regions[] = [
            'value' => '0',
            'label' => 'No Region',
        ];

        foreach ($country->getRegions() as $regionTransfer) {
            $regions[] = [
                'value' => $regionTransfer->getIdRegion(),
                'label' => $regionTransfer->getName(),
            ];
        }

        return $this->jsonResponse($regions);
    }
}

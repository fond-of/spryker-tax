<?php

namespace FondOfSpryker\Zed\Tax\Communication\Controller;

use Spryker\Zed\Tax\Communication\Controller\SetController as SprykerSetController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\Tax\Communication\TaxCommunicationFactory getFactory()
 * @method \Spryker\Zed\Tax\Business\TaxFacadeInterface getFacade()
 * @method \Spryker\Zed\Tax\Persistence\TaxQueryContainerInterface getQueryContainer()
 */
class SetController extends SprykerSetController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array
     */
    public function viewAction(Request $request)
    {
        $idTaxSet = $this->castId($request->query->getInt(static::PARAM_URL_ID_TAX_SET));

        $taxSetTransfer = $this->getFacade()->findTaxSet($idTaxSet);

        if ($taxSetTransfer === null) {
            $this->addErrorMessage(sprintf('Tax set with id %s doesn\'t exist', $idTaxSet));

            return $this->redirectResponse(static::REDIRECT_URL_DEFAULT);
        }

        return [
            'taxSet' => $taxSetTransfer,
        ];
    }
}

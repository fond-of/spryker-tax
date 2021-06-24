<?php

namespace FondOfSpryker\Zed\Tax\Communication\Form;

use FondOfSpryker\Zed\Tax\Communication\Form\Type\ChoiceType;
use Generated\Shared\Transfer\TaxRateTransfer;
use Spryker\Zed\Tax\Communication\Form\TaxRateForm as SprykerTaxRateForm;
use Symfony\Component\Form\FormBuilderInterface;

class TaxRateForm extends SprykerTaxRateForm
{
    public const FIELD_REGION = 'fkRegion';
    public const DATA = 'data';

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param string[] $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        if (isset($options[static::DATA])) {
            $this->addRegion($builder, $options[static::DATA]);
        }
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addRegion(FormBuilderInterface $builder, TaxRateTransfer $taxRateTransfer)
    {
        $builder->add(self::FIELD_REGION, ChoiceType::class, [
            'required' => false,
            'multiple' => false,
            'label' => 'Region',
            'choices' => array_flip($this->getFactory()->createTaxRateFormDataProvider($taxRateTransfer)->getOptions()[self::FIELD_REGION]),
            'choices_as_values' => true,
            'constraints' => [],
            'attr' => [],
            'placeholder' => '-Select region-'
        ]);

        return $this;
    }
}

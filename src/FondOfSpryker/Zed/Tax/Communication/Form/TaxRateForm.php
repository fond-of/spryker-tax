<?php

namespace FondOfSpryker\Zed\Tax\Communication\Form;

use Generated\Shared\Transfer\TaxRateTransfer;
use Spryker\Zed\Tax\Communication\Form\TaxRateForm as SprykerTaxRateForm;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\GreaterThan;

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
            'expanded' => false,
            'multiple' => false,
            'label' => 'Region',
            'choices' => array_flip($this->getFactory()->createTaxRateFormDataProvider($taxRateTransfer)->getOptions()[self::FIELD_REGION]),
            'choices_as_values' => true,
            'constraints' => [
                new GreaterThan([
                    'value' => 0,
                    'message' => 'Select country.',
                ]),
            ],
            'attr' => [],
        ]);

        return $this;
    }
}

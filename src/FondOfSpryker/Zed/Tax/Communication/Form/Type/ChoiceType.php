<?php

namespace FondOfSpryker\Zed\Tax\Communication\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType as SymfonyChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChoiceType extends SymfonyChoiceType
{
    /**
     * {@inheritDoc}
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefault('choices_as_values', true);

        $resolver->setAllowedTypes('choices_as_values', ['null', 'bool', 'string']);
    }
}

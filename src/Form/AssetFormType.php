<?php

namespace App\Form;

use App\Entity\Asset;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssetFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', NumberType::class, [
                'label' => 'Amount',
                'attr' => [
                    'placeholder' => 'Amount',
                    'min' => 0.5,
                    'class' => 'balance-container__modal-container__form-input',
                ],
                'required' => true,
            ])
            ->add('portfolio', ChoiceType::class, [
                'label' => 'Portfolio',
                'attr' => [
                    'placeholder' => 'Portfolio',
                    'class' => 'balance-container__modal-container__form-input',
                ],
                'required' => true,
                'choices' => $options['data']['portfolios']->toArray(),
                'choice_label' => function ($choice, $key, $value) {
                    return strtoupper($choice->getName());
                },
                'choice_value' => function ($choice) {
                    return $choice ? $choice->getId() : '';
                },
            ])
            ->add('buy', SubmitType::class, [
                'label' => 'Buy',
                'attr' => [
                    'class' => 'home-container__stock-details__form-item-button',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Asset::class,
        ]);
    }
}

<?php

namespace SuiviEnsBundle\Form;

use CalendrierBundle\Entity\prof;
use SuiviEnsBundle\Entity\Ens;
use SuiviEnsBundle\Entity\Suivi;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SuiviType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('presAbsc',ChoiceType::class, [
            'choices'  => [
                'Présent' => 'Présent',
                'Absent'  => 'Absent'

            ],
        ])
            ->add('Ajouter',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SuiviEnsBundle\Entity\Suivi'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'suiviensbundle_suivi';
    }


}

<?php

namespace SuiviBundle\Form;

use Gregwar\CaptchaBundle\Type\CaptchaType;
use SuiviBundle\Entity\Matiere;
use SuiviBundle\Entity\Note;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('valeur')->add('matiere', EntityType::class, [

                'class' => Matiere::class,


                'choice_label' => 'libelle',


            ]


        )->add('captcha', CaptchaType::class)->add('Ajouter',SubmitType::class,['attr'=>['formnovalidate'=>'formnovalidate']]);;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SuiviBundle\Entity\Note'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'suivibundle_note';
    }


}

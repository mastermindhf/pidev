<?php

namespace SuiviBundle\Form;

use Doctrine\ORM\EntityRepository;
use SuiviBundle\Entity\Classe;
use SuiviBundle\Entity\Eleve;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ListeAppelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('eleve', EntityType::class, [

                'class' => Eleve::class,


                'choice_label' => 'nom',


            ]


        )
            ->add('date')

            ->add('Ajout',SubmitType::class,['attr'=>['formnovalidate'=>'formnovalidate']])
            ;;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SuiviBundle\Entity\ListeAppel'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'suivibundle_listeappel';
    }


}

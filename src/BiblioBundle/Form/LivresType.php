<?php

namespace BiblioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\FileType;

class LivresType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('auteur')
            ->add('type',EntityType::class,
                array('class'=>'BiblioBundle:Type',		//Recuperer les nom et l'afficher dans une liste
                    'choice_label'=>'libelle'))

            ->add('quantite')
            ->add('description')

            ->add('Ajout',SubmitType::class,['attr'=>['formnovalidate'=>'formnovalidate']]);
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BiblioBundle\Entity\Livres'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bibliobundle_livres';
    }


}

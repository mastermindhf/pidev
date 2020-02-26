<?php

namespace ClubBundle\Form;

use ClubBundle\Entity\Club;
use Doctrine\DBAL\Types\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('dateDebut',\Symfony\Component\Form\Extension\Core\Type\DateType::class,array('widget'=>'single_text'))
            ->add('dateFin',\Symfony\Component\Form\Extension\Core\Type\DateType::class,array('widget'=>'single_text'))
            ->add('nbPlaces')
            ->add('description')
            ->add('idClub',EntityType::class,['class'=>Club::class,
                'choice_label'=>'id'])
            ->add('confirmer',SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ClubBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'clubbundle_event';
    }


}

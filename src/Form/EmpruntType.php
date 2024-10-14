<?php

namespace App\Form;

use App\Entity\Emprunt;
use App\Entity\objet;
use App\Entity\user;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
<<<<<<< HEAD
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

=======
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;
>>>>>>> origin/main


class EmpruntType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
            ->add('DateStart', null, [
                'widget' => 'single_text',
                'label' => 'Date Début',
                ],)
<<<<<<< HEAD
                
=======
>>>>>>> origin/main
            ->add('DateEnd', null, [
                'widget' => 'single_text',
                'label' => 'Date Retour',
            ])
<<<<<<< HEAD

            ->add('enregistrer', SubmitType::class)
        ;


    }
    
   
=======
            ->add('enregistrer', SubmitType::class)
        ;
    }
>>>>>>> origin/main

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emprunt::class,
        ]);
    }

}

<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Chambre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('prenom')
            ->add('nom')
            ->add('email')
            ->add('adresse')
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'boursierloger' => 'boursierloger',
                    'boursiernonloger' => 'boursiernonloger',
                    'nonboursier' => 'nonboursier',
                ],
            ])
            ->add('montant_bourse', ChoiceType::class, [
                'choices'  => [
                    '40000' => 40000,
                    '20000' => 20000,

                ],
            ])
            ->add('telephone')
            ->add('chambre', EntityType::class, [
                'class' => Chambre::class,
                'choice_label' => 'id'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
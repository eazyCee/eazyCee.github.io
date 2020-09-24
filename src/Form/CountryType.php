<?php

namespace App\Form;

use App\Entity\Person;
use App\Entity\Country;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CountryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('country', EntityType::class,
                [ 'placeholder' => 'Choose an option',
                  'required' => true,
                  'class' => Country::class,
                  'query_builder' => function (EntityRepository $er)
                  {
                      return $er->createQueryBuilder ('c')
                          ->orderBy ('c.name', 'DESC');
                  },
                  'choice_label' => 'name'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}

<?php

namespace NominaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as Type;

class UsuarioType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('usuName', Type\TextType::class, array(
                    'required' => true,
                    'label' => 'Nombre del Usuario',
                    'attr' => array(
                        'maxlength' => 100,
                        'placeholder' => 'Nombre del Usuario',
                        'class' => 'form-control title-case'
                    )
                ))
                ->add('usuCedula', Type\TextType::class, array(
                    'required' => true,
                    'label' => 'Cédula',
                    'attr' => array(
                        'maxlength' => 20,
                        'placeholder' => 'Cédula',
                        'class' => 'form-control title-case'
                    )
                ))
                ->add('usuSalary', Type\TextType::class, array(
                    'required' => true,
                    'label' => 'Salario',
                    'attr' => array(
                        'maxlength' => 100,
                        'placeholder' => 'Salario',
                        'class' => 'form-control number_format'
                    )
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'NominaBundle\Entity\Usuario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'nominabundle_usuario';
    }

}

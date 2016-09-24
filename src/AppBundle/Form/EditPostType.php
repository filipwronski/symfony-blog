<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Response;

class EditPostType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
                ->add('content', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
                ->add('category', EntityType::class, array(
                    'class' => 'AppBundle:Category',
                    'choice_label' => 'name',
                    'attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')
                ))
                ->add('slug', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
                ->add('createDate', DateTimeType::class, array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(
                        'class' => 'form-control input-inline datepicker',
                        'data-provide' => 'datepicker',
                        'data-date-format' => 'dd-mm-yyyy'
            )))
                ->add('published', CheckboxType::class, array(
                    'label' => 'Published?',
                    'required' => false,
                    'attr' => array('class' => 'checkbox', 'style' => 'margin-bottom: 15px'))
                )
                ->add('save', SubmitType::class, array('label' => 'Save Post', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')));
    }

}

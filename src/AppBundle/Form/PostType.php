<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Response;

class PostType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
                ->add('content', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
                ->add('category', EntityType::class, array(
                    'class' => 'AppBundle:Category',
                    'choice_label' => 'name',
                    'attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px'),
                ))
                ->add('imageFile', VichImageType::class, array(
                    'required' => false,
                    'allow_delete' => true, // not mandatory, default is true
                    'download_link' => true, // not mandatory, default is true
                ))
                ->add('published', ChoiceType::class, array('choices' => array('True' => True, 'False' => False), 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom: 15px')))
                ->add('save', SubmitType::class, array('label' => 'Create Post', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')));
    }

}

<?php
namespace ChooxBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

/**
 * Created by PhpStorm.
 * User: msoliman
 * Date: 24.04.2016
 * Time: 20:08
 */
class LogoType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('teamName')
            ->add('teamNameAlternatives', CollectionType::class, array(
                'entry_type'    => TextType::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'prototype'     => true,
                'required'      => false,
                'entry_options' => ['label' => false]
            ))
            ->add('teamCountry')
            ->add('teamHint')
            ->add('originalLogoFile', VichImageType::class, array(
                'required'      => true,
                'allow_delete'  => false,
                'download_link' => false
            ))
            ->add('alteredLogoFile', VichImageType::class, array(
                'required'      => true,
                'allow_delete'  => false,
                'download_link' => false
            ))
            ->add('save', SubmitType::class, [
                'label' => 'label.logo.save',
                'attr' => ['class' => 'btn-success']
            ])
        ;
    }

}
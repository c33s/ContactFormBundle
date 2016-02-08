<?php

namespace C33s\ContactFormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * NewType
 */
class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('sender_name', new TextType(), array(
            'required' => true,
            'label' => 'Name',
            'translation_domain' => 'C33sContactForm',
        ));

        $builder->add('sender_email', new EmailType(), array(
            'required' => false,
            'label' => 'E-Mail',
            'translation_domain' => 'C33sContactForm',
        ));

        $builder->add('sender_phone', new TextType(), array(
            'required' => false,
            'label' => 'Phone number',
            'translation_domain' => 'C33sContactForm',
        ));

        $builder->add('subject', new TextType(), array(
            'required' => true,
            'label' => 'Subject',
            'translation_domain' => 'C33sContactForm',
        ));

        $builder->add('message', new TextareaType(), array(
            'required' => true,
            'label' => 'Message',
            'translation_domain' => 'C33sContactForm',
        ));

        $builder->add('send', new SubmitType(), array(
            'label' => 'Send',
            'translation_domain' => 'C33sContactForm',
            'attr' => array(
                'class' => 'btn btn-default',
            ),
        ));
    }
}

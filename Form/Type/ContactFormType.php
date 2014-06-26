<?php

namespace C33s\ContactFormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * NewType
 */
class ContactFormType extends AbstractType
{
    protected $securityContext;
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $formOptions = array(
            'required' => true,
            'label' => 'Name',
            'translation_domain' => 'C33sContactForm',
        );
        $builder->add('sender_name', 'text', $formOptions);
        
        $formOptions = array(
            'required' => false,
            'label' => 'E-Mail',
            'translation_domain' => 'C33sContactForm',
        );
        $builder->add('sender_email', 'email', $formOptions);
        
        $formOptions = array(
            'required' => false,
            'label' => 'Phone number',
            'translation_domain' => 'C33sContactForm',
        );
        $builder->add('sender_phone', 'text', $formOptions);
        
        $formOptions = array(
            'required' => true,
            'label' => 'Subject',
            'translation_domain' => 'C33sContactForm',
        );
        $builder->add('subject', 'text', $formOptions);
        
        $formOptions = array(
            'required' => true,
            'label' => 'Message',
            'translation_domain' => 'C33sContactForm',
        );
        $builder->add('message', 'textarea', $formOptions);
        
        $formOptions = array(
            'buttons' => array(
                'send' => array('type' => 'submit', 'options' => array('label' => 'Send', 'translation_domain' => 'C33sContactForm')),
            ),
        );
        $builder->add('actions', 'form_actions', $formOptions);
    }
    
    public function getName()
    {
        return 'new_c33s_contact_inquiry';
    }
}

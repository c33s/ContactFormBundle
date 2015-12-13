<?php

namespace C33s\ContactFormBundle\Block;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormBlockService extends BaseBlockService
{
    /**
     * Define the default options for the block.
     *
     * @param OptionsResolver $resolver
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'success_message' => null,
            'title' => null,
            'template' => 'C33sContactFormBundle:Block:contact_form.html.twig',
        ));
    }

    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper
            ->add('settings', 'sonata_type_immutable_array', array(
                'keys' => array(
                    array('title', TextType::class, array('required' => false)),
                    array('success_message', TextareaType::class, array('required' => true)),
                )
            ))
        ;
    }

    public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
    {
        $errorElement
            ->with('settings.success_message')
                ->assertNotNull(array())
                ->assertNotBlank()
            ->end()
            ->with('settings.title')
                ->assertMaxLength(array('limit' => 200))
            ->end()
        ;
    }
}

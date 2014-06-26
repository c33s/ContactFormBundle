<?php

namespace C33s\ContactFormBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use C33s\ContactFormBundle\Model\ContactInquiry;
use C33s\ContactFormBundle\Form\Type\ContactFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ContactFormController extends Controller
{
    /**
     * @Route("/contact_form/show", name="C33s_ContactFormBundle_form")
     * @Template()
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function formAction(Request $request)
    {
        $useAjax = $request->get('use_ajax', true);
        
        $inquiry = new ContactInquiry();
        
        $form = $this->createForm(new ContactFormType(), $inquiry, array(
            'action' => $this->generateUrl('C33s_ContactFormBundle_form'),
            'method' => 'POST',
            'attr' => array(
                'id' => 'c33s_contact_form',
            ),
        ));
        
        $message = $request->get('success_message', false);
        $form->handleRequest($request);
        
        if ($form->isValid())
        {
            $inquiry->save();
            
            $this->sendEmails($inquiry);
            
            return array('form' => null, 'use_ajax' => $useAjax, 'success_message' => null, 'success' => true);
        }
        
        return array('form' => $form->createView(), 'use_ajax' => $useAjax, 'success_message' => $message, 'success' => false);
    }
    
    /**
     * Send all notification emails for the given inquiry object.
     *
     * @param ContactInquiry $inquiry
     */
    protected function sendEmails(ContactInquiry $inquiry)
    {
        $recipients = $this->container->getParameter('c33s_contact_form.recipients');
        if ($this->container->getParameter('c33s_contact_form.send_copy_to_user') && $inquiry->hasSenderEmail())
        {
            $recipients[] = $inquiry->getSenderEmail();
        }
        
        if (empty($recipients))
        {
            return;
        }
        
        $translator = $this->get('translator');
        
        $message = \Swift_Message::newInstance()
            ->setSubject($translator->trans('New contact inquiry', array(), 'C33sContactForm'))
            ->setFrom($this->container->getParameter('c33s_contact_form.sender_email'))
            ->setTo($recipients)
            ->setBody(
                $this->renderView(
                    'C33sContactFormBundle:ContactForm:email.txt.twig',
                    array('inquiry' => $inquiry)
                )
            )
        ;
        
        $result = $this->get('mailer')->send($message);
    }
}

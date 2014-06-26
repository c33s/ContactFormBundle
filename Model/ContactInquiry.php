<?php

namespace C33s\ContactFormBundle\Model;

use C33s\ContactFormBundle\Model\om\BaseContactInquiry;
use Symfony\Component\Validator\ExecutionContextInterface;

class ContactInquiry extends BaseContactInquiry
{
    public function isInquiryValid(ExecutionContextInterface $context)
    {
        if (null === $this->getSenderEmail() && null === $this->getSenderPhone())
        {
            $context->addViolationAt('sender_email', 'Please provide an email address or a phone number', array(), null);
        }
    }
    
    /**
     * Check if a sender email address was given for this inquiry.
     *
     * @return boolean
     */
    public function hasSenderEmail()
    {
        return '' != $this->getSenderEmail();
    }
}

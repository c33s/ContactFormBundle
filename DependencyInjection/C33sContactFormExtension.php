<?php

namespace C33s\ContactFormBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class C33sContactFormExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        if ($config['email']['enabled'] === true) {
            $container->setParameter('c33s_contact_form.email.enabled', $config['email']['enabled']);
            $container->setParameter('c33s_contact_form.email.recipients', $config['email']['recipients']);
            $container->setParameter('c33s_contact_form.email.subject', $config['email']['subject']);
            $container->setParameter('c33s_contact_form.email.sender_email', $config['email']['sender_email']);
            $container->setParameter('c33s_contact_form.email.send_copy_to_user', $config['email']['send_copy_to_user']);
        }

        if ($config['database']['enabled'] === true) {
            $container->setParameter('c33s_contact_form.database.enabled', $config['database']['enabled']);
        }
    }
}

How to use ContactFormBundle
===========================

Register routes
-------------

Add the necessary routes to your `routing.yml`:

```yml

# Contact form submission routes
contact_form:
    resource: "@C33sContactFormBundle/Resources/config/routing/contact_form.yml"
    prefix:   /

# Admingenerator routes to view contact inquiries online
contact_form_inquiry_admin:
    resource: "@C33sContactFormBundle/Resources/config/routing/admingenerator.yml"
    prefix:   /

```

Add contact form to your template
--------------

Use the included controller to display the contact form inside your own template.

```twig

{% set message %}
    <div class="alert alert-success">
        This is the HTML block that will be displayed after the user has submitted the form.
    </div>
{% endset %}
{{ render(controller('C33sContactFormBundle:ContactForm:form', { 'use_ajax': true, 'success_message': message })) }}

```

The form will be submitted using ajax and replace itself with the success message if validation was successful.

Sonata Block
------------

C33sContactFormBundle comes with a ready to use Sonata (Page) block service:

```yml
# app/config/config.yml

sonata_block:
    blocks:
        c33s.block.service.contact_form:
```

ContactFormBundle installation
=============================

Require [`c33s/contact-form-bundle`](https://packagist.org/packages/c33s/contact-form-bundle), jQuery and [`jQuery.form`](https://packagist.org/packages/malsup/form)
in your `composer.json` file:

```js
{
    "require": {
        "c33s/contact-form-bundle": "~0.5.0",
        "components/jquery": ">=1.9.0",
        "malsup/form": ">=3.36",
    }
}
```

Make sure jQuery and jQuery.form are loaded in your templates.

If you don't want to use jQuery in your application, you can omit the jquery and malsup/form parts and implement your own form template based
on the included one. This is why those libraries are not required by the shipped composer.json.

Register the bundle and its dependencies in `app/AppKernel.php`:

```php
    // app/AppKernel.php

    public function registerBundles()
    {
        return array(
            // ...

            new C33s\ContactFormBundle\C33sContactFormBundle(),
        );
    }
```

Configure ContactFormBundle:

```yml
# app/config/config.yml

c33s_contact_form:
    email:
        # Email address to use as "From:" in notification emails
        sender_email:   your.email@example.com

        # These email addresses will receive notifications whenever someone submitted a contact form
        recipients:
            - notification.email1@example.com
            - notification.email2@example.com

        # Set to true to also send the notification to the user filling the contact form
        # Beware that this opens the possibility to use the contact form as a spam relay! 
        send_copy_to_user:  false

        # Enable/disable sending of emails
        enabled: true

        # Email subject
        subject: "Thank you for your inquiry!"

    database:
        # Enable/disable storing inquiries using propel
        enabled: false
```

Don't forget to rebuild your Propel models.

Use it!
-------

See [usage documentation](usage.md).

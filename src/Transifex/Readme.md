# Adapter for Transifex

[![Latest Version](https://img.shields.io/github/release/php-translation/transifex-adapter.svg?style=flat-square)](https://github.com/php-translation/transifex-adapter/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/php-translation/transifex-adapter.svg?style=flat-square)](https://packagist.org/packages/php-translation/transifex-adapter)

This is an PHP-translation adapter for [Transifex](https://www.transifex.com/). 

### Install

```bash
composer require php-translation/transifex-adapter
```

##### Symfony bundle

If you want to use the Symfony bundle you may activate it in kernel:

```
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Translation\PlatformAdapter\Transifex\Bridge\Symfony\TranslationAdapterTransifexBundle(),
    );
}
```

If you have one Transifex project per domain you may configure the bundle like this: 
``` yaml
# /app/config/config.yml
translation_adapter_transifex:
  projects:
    my_proj:
      domains: ['messages'] 
    my_nav:
      domains: ['navigation']
```

This will produce a service named `php_translation.adapter.transifex` that could be used in the configuration for
the [Translation Bundle](https://github.com/php-translation/symfony-bundle).

### Documentation

Read our documentation at [http://php-translation.readthedocs.io](http://php-translation.readthedocs.io/en/latest/).

### Contribute

Do you want to make a change? This repository is READ ONLY. Submit your 
 to [php-translation/platform-adapter](https://github.com/php-translation/platform-adapter).

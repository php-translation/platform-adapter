# Adapter for Flysystem

[![Latest Version](https://img.shields.io/github/release/php-translation/flysystem-adapter.svg?style=flat-square)](https://github.com/php-translation/flysystem-adapter/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/php-translation/flysystem-adapter.svg?style=flat-square)](https://packagist.org/packages/php-translation/flysystem-adapter)

This is an PHP-translation adapter for Flysystem ([Localise.biz](https://localise.biz/)). 

### Install

```bash
composer require php-translation/flysystem-adapter
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
        new Translation\PlatformAdapter\Flysystem\Bridge\Symfony\TranslationAdapterFlysystemBundle(),
    );
}
```

If you have one Flysystem project per domain you may configure the bundle like this: 
``` yaml
# /app/config/config.yml
translation_adapter_flysystem:
  projects:
    messages:
      api_key: 'foobar' 
    navigation:
      api_key: 'bazbar' 
```

If you just doing one project and have tags for all your translation domains you may use this configuration:
``` yaml

# /app/config/config.yml
translation_adapter_flysystem:
  projects:
    acme:
      api_key: 'foobar'   
      domains: ['messages', 'navigation']
```

This will produce a service named `php_translation.adapter.flysystem` that could be used in the configuration for
the [Translation Bundle](https://github.com/php-translation/symfony-bundle).

### Documentation

Read our documentation at [http://php-translation.readthedocs.io](http://php-translation.readthedocs.io/en/latest/).

### Contribute

Do you want to make a change? This repository is READ ONLY. Submit your 
pull request to [php-translation/platform-adapter](https://github.com/php-translation/platform-adapter).

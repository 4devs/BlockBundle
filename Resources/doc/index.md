Getting Started With BlockBundle
===========================================

## Installation and usage

Installation and usage is a quick:

1. Download BlockBundle using composer
2. Enable the Bundle
3. Use the bundle


### Step 1: Download BlockBundle using composer

Add BlockBundle in your composer.json:

```js
{
    "require": {
        "fdevs/block-bundle": "*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update fdevs/block-bundle
```

Composer will install the bundle to your project's `vendor/fdevs` directory.


### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new FDevs\BlockBundle\FDevsBlockBundle(),
        new Sonata\BlockBundle\SonataBlockBundle(),
    );
}
```

add config

``` yaml
# app/config/config.yml
f_devs_block:
    predefined_blocks:
        home_left:
            label: 'About Left'
            #....
        team:
            label: 'Team'
            template: 'AcmeDemoBundle:Block:team.html.twig'

#add Sonata Admins Edits
sonata_admin:
    dashboard:
        groups:
            label.block:
                label_catalogue: FDevsBlockBundle
                items:
                    - f_devs_block.admin_block
```


### Step 3: Use the bundle

in your template

``` twig
{{ render(controller('FDevsBlockBundle:Default:index',{'id':'home_left'})) }}
{# or #}
{{ sonata_block_render({ 'type': 'f_devs_block.service.block' }, {'id':'home_left'}) }}
```

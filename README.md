# Bootstrap form decorators for Zend Framework 1

[![Build Status](https://travis-ci.org/easybib/EasyBib_Form_Decorator.png?branch=master)](https://travis-ci.org/easybib/EasyBib_Form_Decorator)

## Installation & Configuration

### Composer

Add this to repositories:

```json
{
    "type": "vcs",
    "url": "https://github.com/easybib/EasyBib_Form_Decorator"
}
```

Then this in require:

```json
"easybib/form-decorator": "*"
```

### PEAR

 1. `sudo pear channel-discover easybib.github.com/pear`
 2. `sudo pear install easybib/EasyBib_Form_Decorator-alpha`
 3. add `autoloaderNamespaces[] = "EasyBib"` to your `application.ini`
 4. add `$view->addHelperPath('EasyBib/View/Helper', 'EasyBib_View_Helper');` 
 	in your Bootstrap
 5. follow examples in docs folder to integrate it into your forms

### Updating? (PEAR)

(We like you best!)

 1. `sudo pear upgrade -c easybib` or: `sudo pear channel-update easybib.github.com/pear`
 2. `pear upgrade easybib/EasyBib_Form_Decorator`

## Form Decorator

See `docs` folder for a example form and controller usage of decorator stuff

## MessagesFormatter

A View Helper to print out fancy twitter bootstrap messages.
Needs to be added to view helper path (see Installlation 4.)

## Create new package Version

### Package Rep (after source change)

 - change version in generate-package.php
 - php generate-package.php make
 - pear package
 - move created tgz archiv to pear rep

### Pear Rep

 - `pirum add . new_version.tgz`
 - `git add -A`
 - `git commit -a`
 - `git push origin gh-pages`

### Pear Upgrade (local/vagrant box)

 - `sudo pear upgrade -c easybib` 
 - (`sudo pear channel-update easybib.github.com/pear`)

Vtpass API class
================
A plugin to handle working with Vtpass

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist netesy/yii2-vtpass "*"
```

or add

```
"netesy/yii2-vtpass": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \netesy\vtpass\Vtpass::widget(); ?>```

```php
<?= \netesy\vtpass\ClubKonnect::getBalance(); ?>```

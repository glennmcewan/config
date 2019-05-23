# Config
[![Total Downloads](https://poser.pugx.org/glennmcewan/config/downloads)](https://packagist.org/packages/glennmcewan/config)
[![Build Status](https://travis-ci.org/glennmcewan/config.svg?branch=master)](https://travis-ci.org/glennmcewan/config)
[![StyleCI](https://styleci.io/repos/75986423/shield?style=flat)](https://styleci.io/repos/75986423)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/glennmcewan/config/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/glennmcewan/config/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/glennmcewan/config/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/glennmcewan/config/?branch=master)

Small but powerful Config package. Suitable for basic config handling with plain arrays or various config files, whilst remaining easy to use when scaling for use in larger applications with more complex configuration setups.

## Requirements
`PHP 5.5+`. Master is CI tested on the following versions of PHP: `5.5`, `5.6`, `7.0`, `7.1`, and `HHVM`.

## Installation

### With Composer
```
$ composer require glennmcewan/config
```

or add the package name to the require block in your `composer.json` file:


```
{
	"require": {
		"glennmcewan/config": "dev-master"
	}
}
```


### Without Composer
This package can still be used without Composer -- at the cost of no included autoloader.

## Usage
### Basics
- Creating a new instance of the Config Manager

```php
$config = new Glenn\Config\Manager;

```

- Setting Config Values

```php
$config->set('name', 'Glenn');
$config->set('age', 18);
$config->set('languages', ['English', 'Spanish']);

// TODO: setting array of keys in bulk. This means re-factoring @setFromParser. It's a smelly method anyway, remove it and instead add a @setFromArray or something.

```

- Getting Config values

```php
echo $config->get('name'); // 'Glenn'

echo $config->get('age'); // 18

echo $config->get('languages'); // [0 => 'English', 1 => 'Spanish']

echo $config->get('gender'); // null

echo $config->get('gender', 'male'); // 'male'
```

- Changing Config values

```php
$config->set('name', 'Glenn');

echo $config->get('name'); // 'Glenn'

$config->set('name', 'Dave');

echo $config->get('name'); // 'Dave'
```

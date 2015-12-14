
[![Build Status](https://img.shields.io/travis/lichunqiang/yii2-xmlparser.svg?style=flat-square)](http://travis-ci.org/lichunqiang/yii2-xmlparser)
[![version](https://img.shields.io/packagist/v/light/yii2-xmlparser.svg?style=flat-square)](https://packagist.org/packages/light/yii2-xmlparser)
[![Download](https://img.shields.io/packagist/dt/light/yii2-xmlparser.svg?style=flat-square)](https://packagist.org/packages/light/yii2-xmlparser)
[![Issues](https://img.shields.io/github/issues/lichunqiang/yii2-xmlparser.svg?style=flat-square)](https://github.com/lichunqiang/yii2-xmlparser/issues)

## Overview

This is a library help you to handle the xml request. As we all know, [Yii2](https://github.com/yiisoft/yii2) provided an built-in request parser for `json` like requests, it's `yii\web\JsonParser`. Sometimes, we need to handle the request of xml, so this library is birthed.

## Install

Add `light/yii2-xmlparser` to composer.json, you can assign version as `*`:

```sh
$ composer install
//or run
$ composer update
```

also we can do like this:

```sh
$ composer require light/yii2-xmlparser=* --prefer-dist
```

## Usage

```
# file app/config/main.php [your configuration file]
<?php

return [
    'components' => [
    'request' => [
        'parsers' => [
	        	'text/xml' => 'light\yii2\XmlParser',
	            'application/xml' => 'light\yii2\XmlParser',
	        ],
        ],
    ],
];

```

## Test

```
$ phpunit
```
## LICENSE

![MIT](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)

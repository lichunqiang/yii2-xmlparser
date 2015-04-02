
[![Build Status](https://img.shields.io/travis/lichunqiang/yii2-xmlparser.svg?style=flat-square)](http://travis-ci.org/lichunqiang/yii2-xmlparser)
[![version](https://img.shields.io/packagist/v/light/yii2-xmlparser.svg?style=flat-square)](https://packagist.org/packages/light/yii2-xmlparser)
[![Download](https://img.shields.io/packagist/dd/light/yii2-xmlparser.svg?style=flat-square)](https://packagist.org/packages/light/yii2-xmlparser)
[![Issues](https://img.shields.io/github/issues/lichunqiang/yii2-xmlparser.svg?style=flat-square)](https://github.com/lichunqiang/yii2-xmlparser/issues)
## Install

add `light/yii2-xmlparser` to composer.json

```sh
$ composer install
```

or

```sh
$ composer update
```

## Usage

```
# file app/config/main.php
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

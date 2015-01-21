
[![Build Status](https://travis-ci.org/lichunqiang/yii2-xmlparser.svg)](http://travis-ci.org/lichunqiang/yii2-xmlparser)

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
	        	'text/xml' => 'Light\XmlParser',
	            'application/xml' => 'Light\XmlParser',
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

[MIT](LICENSE)

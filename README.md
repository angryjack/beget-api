# beget-api
Библиотека для использования beget API

## Установка

Через Composer

``` bash
$ composer require angryjack/beget-api
```

## Использование

``` php
$beget = new Beget('login', 'password');
$info = $beget->api('user')->getAccountInfo();
```

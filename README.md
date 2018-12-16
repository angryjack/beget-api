# beget-api
Библиотека представляет собой обертку для удобного использования [Beget.API.](https://www.beget.com/ru/api)


## Установка

Через Composer

``` bash
$ composer require angryjack/beget-api
```

## Использование

### Инициализация
``` php
$beget = new Beget('login', 'password');
```
### Общая информация по использованию
Чтобы воспользоваться определенным методом, необходимо указать секцию к которой данный метод относится. 
``` php
$section = $beget->api('section');
```
Далее можно обращаться к любому методу из указанной секции. 
``` php
$result = $section->doSomething();
```
Методы в данной библиотеке имеют идентичные имена с методами описанными в официальной документации [Beget.API](https://www.beget.com/ru/api)

### Управление аккаунтом
``` php
$user = $beget->api('user');
// получить информацию об аккаунте
$accountInfo = $user->getAccountInfo();
```
Все методы из категории данной категории доступны на [официальном сайте](https://www.beget.com/ru/api/user).

### Управление бекапами
``` php
$backup = $beget->api('backup');
// получить доступный список резервных файловых копий.
$backupList = $backup->getFileBackupList();
```
Все методы из данной категории доступны на [официальном сайте](https://www.beget.com/ru/api/backup).

### Управление Cron
``` php
$cron = $beget->api('cron');
// получить список всех задач CronTab.
$cronTabList = $cron->getList();
```
Все методы из данной категории доступны на [официальном сайте](https://www.beget.com/ru/api/crontab).

### Управление DNS
``` php
$dns = $beget->api('dns');
// получить информацию с DNS-сервера о домене.
$domainDNSInfo = $dns->getData('site.com');
```
Все методы из данной категории доступны на [официальном сайте](https://www.beget.com/ru/api/dns).

### Управление FTP
``` php
$ftp = $beget->api('ftp');
// получить список дополнительных FTP-аккаунтов с их домашними директориями.
$ftpList = $ftp->getData();
```
Все методы из данной категории доступны на [официальном сайте](https://www.beget.com/ru/api/ftp).

### Управление MySQL
``` php
$mysql = $beget->api('mysql');
// получить список баз данных MySQL с их доступами.
$mysqlList = $mysql->getList();
```
Все методы из данной категории доступны на [официальном сайте](https://www.beget.com/ru/api/mysql).

### Управление сайтами
``` php
$site = $beget->api('site');
// получить список сайтов с их доменами.
$siteList = $site->getList();
```
Все методы из данной категории доступны на [официальном сайте](https://www.beget.com/ru/api/sites).

### Управление доменами
``` php
$domain = $beget->api('domain');
// получить список доменов на аккаунте пользователя.
$domainList = $domain->getList();
```
Все методы из данной категории доступны на [официальном сайте](https://www.beget.com/ru/api/domains).

### Управление почтой
``` php
$mail = $beget->api('mail');
// получить все почтовые ящики на заданном домене.
$mailboxList = $mail->getMailboxList('site.com');
```
Все методы из данной категории доступны на [официальном сайте](https://www.beget.com/ru/api/mail).

### Сбор статистики
``` php
$stat = $beget->api('stat');
// получить информацию о средней нагрузке на сайтах пользователя за последний месяц.
$siteListLoad = $stat->getSiteListLoad();
```
Все методы из данной категории доступны на [официальном сайте](https://www.beget.com/ru/api/stat).

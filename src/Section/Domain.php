<?php
/**
 * Created by angryjack
 * Date: 2018-12-13 22:45
 */

namespace Angryjack\Beget\Section;

use Angryjack\Beget\Beget;

/**
 * Класс для работы с доменами
 * @package Angryjack\Beget\Section
 */
class Domain extends Beget
{
    public $section = 'domain/';

    /**
     * Метод возвращает список доменов на аккаунте пользователя.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getList()
    {
        return $this->request($this->section, __FUNCTION__);
    }

    /**
     * Метод возвращает список зон.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getZoneList()
    {
        return $this->request($this->section, __FUNCTION__);
    }

    /**
     * Метод добавляет домен.
     * @param $hostname - доменное имя, без зоны (например, domain);
     * @param $zone_id  - id зоны, тип int;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addVirtual($hostname, $zone_id)
    {
        $params = array(
            'hostname' => $hostname,
            'zone_id' => $zone_id
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод удаляет домен. Если домен был прилинкован к сайту, то он будет отлинкован от него.
     * Также будут удалены все поддомены этого домена.
     * @param $id - id домена;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($id)
    {
        $params = array(
            'id' => $id
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод возвращает список поддоменов.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSubdomainList()
    {
        return $this->request($this->section, __FUNCTION__);
    }

    /**
     * Метод добавляет заданный поддомен.
     * @param $subdomain - имя поддомена;
     * @param $domain_id - id родительского домена;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addSubdomainVirtual($subdomain, $domain_id)
    {
        $params = array(
            'subdomain' => $subdomain,
            'domain_id' => $domain_id
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод удаляет заданный поддомен.
     * @param $id - id поддомена.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteSubdomain($id)
    {
        $params = array(
            'id' => $id
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод возвращает информацию о возможности регистрации заданного доменного имени.
     * @param $hostname - доменное имя, без зоны;
     * @param $zone_id - id зоны, получить список зон можно с помощью метода getZoneList;
     * @param $period - период регистрации (в годах), тип int.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkDomainToRegister($hostname, $zone_id, $period)
    {
        $params = array(
            'hostname' => $hostname,
            'zone_id' => $zone_id,
            'period' => $period,
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод возвращает список сохраненных персон, доступных для регистрации доменов.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDomainPersons()
    {
        return $this->request($this->section, __FUNCTION__);
    }

    /**
     * Метод добавляет домен и оставляет заявку на его регистрацию.
     * @param $hostname - имя домена, без зоны;
     * @param $zone_id - id зоны. Получить список зон можно методом getZoneList;
     * @param $period - период регистрации;
     * @param $pay_type - способ оплаты;
     * @param $person_type - тип используемой персоны;
     * @param $person_id - id базовой персоны, тип int;
     * @param $person_fields - поля персоны, массив;
     * @param $pp - активировать ли услугу скрытия персональных данных (обязательна в зонах .ru / .su / .рф) (0/1);
     * @param $enable_auto_renew - включить услугу автоматического продления домена (0/1).
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function registerVirtual(
        $hostname,
        $zone_id,
        $period,
        $pay_type,
        $person_type,
        $person_id,
        $person_fields,
        $pp,
        $enable_auto_renew
    ) {
        $params = array(
            'hostname' => $hostname,
            'zone_id' => $zone_id,
            'period' => $period,
            'pay_type' => $pay_type,
            'person_type' => $person_type,
            'person_id' => $person_id,
            'person_fields' => $person_fields,
            'pp' => $pp,
            'enable_auto_renew' => $enable_auto_renew
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод возвращает информацию о возможности и способе продления домена.
     * @param $id - id домена;
     * @param $period - желаемый период продления.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRenewInfo($id, $period)
    {
        $params = array(
            'id' => $id,
            'period' => $period
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод оставляет заявку на продление заданного доменного имени на заданный период.
     * @param $id - id домена;
     * @param $pay_type - способ оплаты;
     * @param $period - желаемый период продления.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function renew($id, $pay_type, $period)
    {
        $params = array(
            'id' => $id,
            'pay_type' => $pay_type,
            'period' => $period
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод возвращает информацию о текущей версии php для домена, включен ли php как cgi и
     * доступных для установки версиях php
     * @param $full_fqdn - полное имя домена, для которого необходимо получить информацию;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPhpVersion($full_fqdn)
    {
        $params = array(
            'full_fqdn' => $full_fqdn
        );

        return $this->request($this->section, __FUNCTION__, $params);
    }

    /**
     * Метод изменяет версию php на переданную. Позволяет установить и снять режим cgi
     * @param $full_fqdn - полное имя домена, для которого необходимо изменить версию php;
     * @param $php_version - версия php, на которую будет произведено изменение;
     * @param $is_cgi - установить или снять режим cgi. По умолчанию имеет значение false;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     */
    public function changePhpVersion($full_fqdn, $php_version, $is_cgi)
    {
        $params = array(
            'full_fqdn' => $full_fqdn,
            'php_version' => $php_version,
            'is_cgi' => $is_cgi,
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }
}

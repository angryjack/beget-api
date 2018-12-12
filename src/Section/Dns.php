<?php
/**
 * Created by angryjack
 * Date: 2018-12-12 22:51
 */

namespace Angryjack\Beget\Section;

use Angryjack\Beget\Beget;

/**
 * Класс управления DNS
 * @package Angryjack\Beget\Section
 */
class Dns extends Beget
{
    public $section = 'dns/';

    /**
     * Метод возвращает информацию с DNS-сервера о домене.
     * @param $fqdn - полное имя домена (домены на национальных языках следует передавать в punycode).
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getData($fqdn)
    {
        $params = array(
            'fqdn' => $fqdn,
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод производит изменение DNS-записей для заданного домена.
     * @param $fqdn - полное имя домена (домены на национальных языках следует передавать в punycode).
     * @param $records - массив, содержащий DNS записи.
     * // https://www.beget.com/ru/api/dns#changeRecords
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function changeRecords($fqdn, $records)
    {
        $params = array(
            'fqdn' => $fqdn,
            'records' => $records
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }
}

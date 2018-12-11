<?php
/**
 * Created by angryjack
 * Date: 2018-12-04 22:57
 */

namespace Angryjack\Beget\Section;

use Angryjack\Beget\Beget;

/**
 * Класс управления аккаунтом
 * @package Angryjack\Beget
 */
class User extends Beget
{
    public $section = 'user/';

    /**
     * Метод возвращает информацию о тарифном плане пользователя,
     * о некоторых параметрах сервера, на котором пользователь размещается в данный момент,
     * и используемых лимитах на нем.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAccountInfo()
    {
        return $this->request($this->section, __FUNCTION__);
    }

    /**
     * Метод включает или выключает SSH,
     * если нет дополнительного параметра ftplogin для основного аккаунта,
     * с ftplogin для указанного ftp аккаунта
     * @param $status - 1 - включить, 0 - выключить;
     * @param string $ftplogin - login ftp аккаунта, если передан, включает\отключает доступ к ftp аккаунту по SSH
     * если не передан включает\отключает доступ по SSH к основному аккаунту пользователя;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function toggleSsh($status, $ftplogin = '')
    {
        $params = array(
            'status' => $status
        );

        if (! empty($ftplogin)) {
            array_merge($params, ['ftplogin' => $ftplogin]);
        }

        return $this->request($this->section, __FUNCTION__, $params);
    }
}

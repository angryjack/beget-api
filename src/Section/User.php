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
     * @return mixed
     */
    public function getAccountInfo()
    {
        return $this->request($this->section, __FUNCTION__);
    }

    /**
     * Метод включает или выключает SSH,
     * если нет дополнительного параметра ftplogin для основного аккаунта,
     * с ftplogin для указанного ftp аккаунта
     * @param $status
     * @param string $ftplogin
     * @return mixed
     */
    public function toggleSsh($status, $ftplogin = '')
    {
        $params = array(
            'status' => $status
        );

        if (! empty($ftplogin)) {
            array_push($params, ['ftplogin' => $ftplogin]);
        }

        return $this->request($this->section, __FUNCTION__, $params);
    }
}

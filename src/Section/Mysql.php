<?php
/**
 * Created by angryjack
 * Date: 2018-12-12 23:24
 */

namespace Angryjack\Beget\Section;

use Angryjack\Beget\Beget;

/**
 * Класс управления Mysql
 * @package Angryjack\Beget\Section
 */
class Mysql extends Beget
{
    public $section = 'mysql/';

    /**
     * Метод возвращает список баз данных MySQL с их доступами.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getList()
    {
        return $this->request($this->section, __FUNCTION__);
    }

    /**
     * Метод добавляет задание в очередь на создание новой базы данных MySql с заданным суффиксом и
     * создает доступ для localhost с заданным паролем. Процесс создания базы данных может занимать несколько минут.
     * @param $suffix  - суффиксная часть имени базы данных. При передаче этого параметра нужно учитывать,
     * что итоговый логин вида "login_suffix" должен быть не длиннее 16 символов.;
     * @param $password - пароль для новой базы данных. Должен содержать не менее 6 символов;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addDb($suffix, $password)
    {
        if (strlen($this->login . '_' . $suffix) > 16) {
            throw new BegetException('Имя должно быть не длиннее 16 символов.');
        }

        if (strlen($password) < 6) {
            throw new BegetException('Пароль должен содержать не менее 6 символов.');
        }

        $params = array(
            'suffix' => $suffix,
            'password' => $password,
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод добавляет заданный доступ к заданной базе данных MySql.
     * @param $suffix  - суффиксная часть логина. При передаче этого параметра нужно учитывать,
     * что итоговый логин вида "login_suffix" должен быть не длиннее 16 символов.;
     * @param $access - имя доступа - это может быть: домен, IP, * или localhost;
     * @param $password - пароль для нового доступа к базе данных. Должен содержать не менее 6 символов;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addAccess($suffix, $access, $password)
    {
        if (strlen($this->login . '_' . $suffix) > 16) {
            throw new BegetException('Имя должно быть не длиннее 16 символов.');
        }

        if (strlen($password) < 6) {
            throw new BegetException('Пароль должен содержать не менее 6 символов.');
        }

        $params = array(
            'suffix' => $suffix,
            'access' => $access,
            'password' => $password,
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод удаляет заданную базу данных и все доступы к ней.
     * @param $suffix - суффиксная часть имени базы данных.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function dropDb($suffix)
    {
        $params = array(
            'suffix' => $suffix
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод удаляет заданный доступ у базы данных.
     * @param $suffix - суффиксная часть имени базы данных;
     * @param $access - имя доступа - это может быть: домен, IP, * или localhost;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function dropAccess($suffix, $access)
    {
        $params = array(
            'suffix' => $suffix,
            'access' => $access
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод изменяет пароль на указанном доступе.
     * @param $suffix - суффиксная часть имени базы данных;
     * @param $access - имя доступа - это может быть: домен, IP, * или localhost;
     * @param $password - пароль для нового доступа к базе данных. Должен содержать не менее 6 символов;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function changeAccessPassword($suffix, $access, $password)
    {
        $params = array(
            'suffix' => $suffix,
            'access' => $access,
            'password' => $password,
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }
}

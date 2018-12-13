<?php
/**
 * Created by angryjack
 * Date: 2018-12-12 23:01
 */

namespace Angryjack\Beget\Section;

use Angryjack\Beget\Beget;
use Angryjack\Beget\Exception\BegetException;

/**
 * Класс управления FTP
 * @package Angryjack\Beget\Section
 */
class Ftp extends Beget
{
    public $section = 'ftp/';

    /**
     * Метод возвращает список дополнительных FTP-аккаунтов с их домашними директориями.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getList()
    {
        return $this->request($this->section, __FUNCTION__);
    }

    /**
     * Метод добавляет новый FTP аккаунт.
     * @param $suffix - суффиксная часть логина. При передаче этого параметра нужно учитывать,
     * что итоговый логин вида "login_suffix" должен быть не длиннее 17 символов.;
     * @param $homedir - путь до домашней директории создаваемого аккаунта. Он начинается со слеша.
     * (например, /site.ru/public_html);
     * @param $password - - пароль для нового ftp-аккаунта;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function add($suffix, $homedir, $password)
    {
        if (strlen($this->login . '_' . $suffix) > 17) {
            throw new BegetException('Имя должно быть не длиннее 17 символов.');
        }

        $params = array(
            'suffix' => $suffix,
            'homedir' => $homedir,
            'password' => $password,
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * @param $suffix - суффиксная часть логина. При передаче этого параметра нужно учитывать,
     * что итоговый логин вида "login_suffix" должен быть не длиннее 17 символов.;
     * @param $password - пароль для нового ftp-аккаунта;
     * @return \Psr\Http\Message\StreamInterface
     * @throws BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function changePassword($suffix, $password)
    {
        $params = array(
            'suffix' => $suffix,
            'password' => $password,
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод удаляет дополнительный FTP-аккаунт с заданным суффиксом.
     * @param $suffix - суффиксная часть логина. При передаче этого параметра нужно учитывать,
     * что итоговый логин вида "login_suffix" должен быть не длиннее 17 символов.;
     * @return \Psr\Http\Message\StreamInterface
     * @throws BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($suffix)
    {
        $params = array(
            'suffix' => $suffix,
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }
}

<?php
/**
 * Created by angryjack
 * Date: 2018-12-12 22:16
 */

namespace Angryjack\Beget\Section;

use Angryjack\Beget\Beget;

/**
 * Класс управления Cron
 * @package Angryjack\Beget\Section
 */
class Cron extends Beget
{
    public $section = 'cron/';

    /**
     * Метод возвращает список всех задач CronTab.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getList()
    {
        return $this->request($this->section, __FUNCTION__);
    }

    /**
     * Метод добавит новое задание. После добавления задание будет активно.
     * @param $minutes
     * @param $hours
     * @param $days
     * @param $months
     * @param $weekdays
     * @param $command
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function add($minutes, $hours, $days, $months, $weekdays, $command)
    {
        $params = array(
            'minutes' => $minutes,
            'hours' => $hours,
            'days' => $days,
            'months' => $months,
            'weekdays' => $weekdays,
            'command' => $command,
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод изменит заданное задание.
     * @param $id
     * @param $minutes
     * @param $hours
     * @param $days
     * @param $months
     * @param $weekdays
     * @param $command
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function edit($id, $minutes, $hours, $days, $months, $weekdays, $command)
    {
        $params = array(
            'id' => $id,
            'minutes' => $minutes,
            'hours' => $hours,
            'days' => $days,
            'months' => $months,
            'weekdays' => $weekdays,
            'command' => $command
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод удалит задание с заданным ID.
     * @param $row_number - ID задания, тип int;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($row_number)
    {
        $params = array(
            'row_number' => $row_number
        );

        return $this->request($this->section, __FUNCTION__, $params);
    }

    /**
     * Метод изменит статус задания.
     * @param $row_number
     * @param $is_hidden
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function changeHiddenState($row_number, $is_hidden)
    {
        $params = array(
            'row_number' => $row_number,
            'is_hidden' => $is_hidden
        );

        return $this->request($this->section, __FUNCTION__, $params);
    }

    /**
     * Метод возвращает email, на который приходит вывод выполненных заданий
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getEmail()
    {
        return $this->request($this->section, __FUNCTION__);
    }

    /**
     * Метод устанавливает email, на который будет приходить вывод выполненных заданий.
     * @param string $email - Email или пустая строка;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setEmail($email = '')
    {
        $params = array(
            'email' => $email,
        );

        return $this->request($this->section, __FUNCTION__, $params);
    }
}

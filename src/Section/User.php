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

    public function getAccountInfo()
    {
        $response = parent::sendRequest($this->section, 'getAccountInfo');
        return $response->getBody();
    }

    public function toggleSsh()
    {
        //
    }
}

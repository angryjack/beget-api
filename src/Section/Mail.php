<?php
/**
 * Created by angryjack
 * Date: 2018-12-13 23:11
 */

namespace Angryjack\Beget\Section;

use Angryjack\Beget\Beget;
use Angryjack\Beget\Exception\BegetException;

/**
 * Класс для работы с почтой
 * @package Angryjack\Beget\Section
 */
class Mail extends Beget
{
    public $section = 'mail/';

    /**
     * Метод возвращает все почтовые ящики на заданном домене.
     * @param $domain - домен, почтовые ящики которого будут отображены (например, site.ru);
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMailboxList($domain)
    {
        $params = array(
            'domain' => $domain
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод изменяет пароль к заданному почтовому ящику.
     * @param $domain - домен, на котором находится почтовый ящик (например, site.ru);
     * @param $mailbox - имя почтового ящика (например, info);
     * @param $mailbox_password - пароль для почтового ящика.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function changeMailboxPassword($domain, $mailbox, $mailbox_password)
    {
        $params = array(
            'domain' => $domain,
            'mailbox' => $mailbox,
            'mailbox_password' => $mailbox_password
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод создает почтовый ящик на заданном домене.
     * @param $domain - домен, на котором будет создан почтовый ящик (например, site.ru);
     * @param $mailbox - имя почтового ящика (например, info);
     * @param $mailbox_password - пароль для почтового ящика.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createMailbox($domain, $mailbox, $mailbox_password)
    {
        $params = array(
            'domain' => $domain,
            'mailbox' => $mailbox,
            'mailbox_password' => $mailbox_password
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод удаляет почтовый ящик на заданном домене.
     * @param $domain - домен, на котором находится почтовый ящик (например, site.ru);
     * @param $mailbox - имя почтового ящика (например, info).
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function dropMailbox($domain, $mailbox)
    {
        $params = array(
            'domain' => $domain,
            'mailbox' => $mailbox
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод устанавливает опции для почтового ящика.
     * @param $domain - домен, на котором находится почтовый ящик (например, site.ru);
     * @param $mailbox - имя почтового ящика (например, info);
     * @param $spam_filter_status - статус работы спам-фильтра (0/1);
     * @param $spam_filter - уровень фильтрации спама (20 - по-умолчанию,
     * в данный момент параметр не актуален, оставлен для совместимости API);
     * @param $forward_mail_status - режим работы перенаправления для почтового ящика.
     * @return \Psr\Http\Message\StreamInterface
     * @throws BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function changeMailboxSettings($domain, $mailbox, $spam_filter_status, $spam_filter, $forward_mail_status)
    {
        $forwardMailStatusVariants = array('no_forward', 'forward', 'forward_and_delete');

        if (! in_array($forward_mail_status, $forwardMailStatusVariants)) {
            throw new BegetException('Передано неподдерживаемое значение.');
        }

        $params = array(
            'domain' => $domain,
            'mailbox' => $mailbox,
            'spam_filter_status' => $spam_filter_status,
            'spam_filter' => $spam_filter,
            'forward_mail_status' => $forward_mail_status
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод добавит почтовый ящик в список ящиков для пересылки.
     * @param $domain - домен, на котором находится почтовый ящик (например, site.ru);
     * @param $mailbox - имя почтового ящика (например, info);
     * @param $forward_mailbox - почтовый ящик, на который будут перенаправляются письма.
     * @return \Psr\Http\Message\StreamInterface
     * @throws BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function forwardListAddMailbox($domain, $mailbox, $forward_mailbox)
    {
        $params = array(
            'domain' => $domain,
            'mailbox' => $mailbox,
            'forward_mailbox' => $forward_mailbox
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод удаляет почтовый ящик из списка ящиков для пересылки.
     * @param $domain - домен, на котором находится почтовый ящик (например, site.ru);
     * @param $mailbox - имя почтового ящика (например, info);
     * @param $forward_mailbox - почтовый ящик, который будет удален из списка пересылки.
     * @return \Psr\Http\Message\StreamInterface
     * @throws BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function forwardListDeleteMailbox($domain, $mailbox, $forward_mailbox)
    {
        $params = array(
            'domain' => $domain,
            'mailbox' => $mailbox,
            'forward_mailbox' => $forward_mailbox
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод возвращает список пересылки для заданного почтового ящика.
     * @param $domain - домен, на котором находится почтовый ящик (например, site.ru);
     * @param $mailbox - имя почтового ящика (например, info).
     * @return \Psr\Http\Message\StreamInterface
     * @throws BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function forwardListShow($domain, $mailbox)
    {
        $params = array(
            'domain' => $domain,
            'mailbox' => $mailbox
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод устанавливает почту домена.
     * @param $domain - домен для которого будет установлена почта домена (например, site.ru);
     * @param $domain_mailbox - почтовый ящик, который будет установлен в качестве почты домена (например, mail@site.ru)
     * @return \Psr\Http\Message\StreamInterface
     * @throws BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setDomainMail($domain, $domain_mailbox)
    {
        $params = array(
            'domain' => $domain,
            'domain_mailbox' => $domain_mailbox
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод сбрасывает почту домена.
     * @param $domain - домен для которого будет сброшена почта домена (например, site.ru);
     * @return \Psr\Http\Message\StreamInterface
     * @throws BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function clearDomainMail($domain)
    {
        $params = array(
            'domain' => $domain
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }
}

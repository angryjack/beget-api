<?php
/**
 * Created by angryjack
 * Date: 2018-12-12 23:45
 */

namespace Angryjack\Beget\Section;

use Angryjack\Beget\Beget;

/**
 * Класс управления сайтами
 * @package Angryjack\Beget\Section
 */
class Site extends Beget
{
    public $section = 'site/';

    /**
     * Метод возвращает список сайтов. Если к сайту прилинкованы домены, то они так же будут возвращены.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getList()
    {
        return $this->request($this->section, __FUNCTION__);
    }

    /**
     * Метод создает новый сайт с заданным именем.
     * @param $name - имя директории с сайтом (например, site.ru);
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function add($name)
    {
        $params = array(
            'name' => $name,
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод удаляет сайт. Если к сайту были прилинкованы домены, то они будут отлинкованы от него
     * @param $id - id сайта, тип int;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($id)
    {
        $params = array(
            'id' => $id,
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод прилинковывает домен к сайту.
     * @param $domain_id - id домена, получить уникальный id Домена можно функцией domain/getList;
     * @param $site_id - id сайта.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function linkDomain($domain_id, $site_id)
    {
        $params = array(
            'domain_id' => $domain_id,
            'site_id' => $site_id,
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод отлинковывает домен.
     * @param $domain_id - id домена, получить уникальный id Домена можно функцией domain/getList;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function unlinkDomain($domain_id)
    {
        $params = array(
            'domain_id' => $domain_id,
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод запрещает изменение файлов сайта.
     * @param $id - id сайта, получить уникальный id сайта можно функцией site/getList;
     * @param $excludedPaths - список путей в которых будет разрешено изменение файлов
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function freeze($id, $excludedPaths)
    {
        $params = array(
            'id' => $id,
            'excludedPaths' => $excludedPaths,
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод разрешает изменение файлов сайта.
     * @param $id - id сайта, получить уникальный id сайта можно функцией site/getList;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function unfreeze($id)
    {
        $params = array(
            'id' => $id
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод возвращает текущий статус сайта, доступно ли редактирования файлов.
     * @param $site_id - id сайта, получить уникальный id сайта можно функцией site/getList;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function isSiteFrozen($site_id)
    {
        $params = array(
            'site_id' => $site_id
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }
}

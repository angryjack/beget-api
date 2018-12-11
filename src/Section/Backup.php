<?php
/**
 * User: angryjack
 * Date: 10.12.18 : 13:39
 */

namespace Angryjack\Beget\Section;

use Angryjack\Beget\Beget;

/**
 * Класс управления бекапами
 * @package Angryjack\Beget\Section
 */
class Backup extends Beget
{
    public $section = 'backup/';

    /**
     * Метод возвращает доступный список резервных файловых копий.
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFileBackupList()
    {
        return $this->request($this->section, __FUNCTION__);
    }

    /**
     * Метод возвращает доступный список резервных копий баз mysql
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMysqlBackupList()
    {
        return $this->request($this->section, __FUNCTION__);
    }

    /**
     * Метод возвращает список файлов и директорий из резервной копии по заданному пути и идентификатору.
     * @param $path - путь от корня домашней директории (например "/site.ru/public_html");
     * @param $backup_id - идентификатор резервной копии backup_id,
     * если не задан - значит листинг идет по текущей копии;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFileList($path, $backup_id = '')
    {
        $params = array(
            'path' => $path,
        );

        if (! empty($backup_id)) {
            array_merge($params, ['backup_id' => $backup_id]);
        }

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод возвращает список баз данных из резервной копии по заданному идентификатору.
     * @param $backup_id - идентификатор резервной копии backup_id,
     * если не задан - значит листинг идет по текущей копии;
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMysqlList($backup_id = '')
    {
        $params = array();
        if (! empty($backup_id)) {
            array_merge($params, ['backup_id' => $backup_id]);
        }

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод создает заявку на восстановление данных из резервной копии по заданному пути и резервной копии.
     * @param $paths - массив (одно или несколько значений) путей для восстановления от корня домашней директории
     * (например "/site.ru/public_html");
     * @param $backup_id - идентификатор резервной копии backup_id
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function restoreFile(array $paths, $backup_id)
    {
        $params = array(
            'backup_id' => $backup_id,
            'paths' => $paths
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод создает заявку на восстановление БД из резервной копии по заданному имени БД
     * и идентификатору резервной копии.
     * @param array $bases - массив (одно или несколько значений) имена баз данных MySQL для восстановления
     * @param $backup_id - идентификатор резервной копии backup_id
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function restoreMysql(array $bases, $backup_id)
    {
        $params = array(
            'backup_id' => $backup_id,
            'bases' => $bases
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод создает заявку на загрузку и выкладывание данных из резервной копии в корень аккаунта.
     * @param array $paths - массив (одно или несколько значений) путей для восстановления от корня домашней директории
     * (например "/site.ru/public_html");
     * @param $backup_id  - идентификатор резервной копии backup_id (необязательный),
     * если не указан то используется текущая копия
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function downloadFile(array $paths, $backup_id = '')
    {
        $params = array(
            'backup_id' => $backup_id,
            'paths' => $paths
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод создает заявку на загрузку и выкладывание данных из резервной копии в корень аккаунта.
     * @param array $bases - массив (одно или несколько значений) имена баз данных MySQL для восстановления
     * @param $backup_id - идентификатор резервной копии backup_id (необязательный),
     * если не указан то используется текущая копия
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function downloadMysql(array $bases, $backup_id = '')
    {
        $params = array(
            'backup_id' => $backup_id,
            'bases' => $bases
        );

        return $this->request($this->section, __FUNCTION__, $params, 'json');
    }

    /**
     * Метод возвращает список и статусы заданий по восстановлению и загрузке
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Angryjack\Beget\Exception\BegetException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLog()
    {
        return $this->request($this->section, __FUNCTION__);
    }
}

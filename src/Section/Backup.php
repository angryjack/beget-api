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
     * @return mixed
     */
    public function getFileBackupList()
    {
        return $this->request($this->section, __FUNCTION__);
    }

    /**
     * Метод возвращает доступный список резервных копий баз mysql
     * @return mixed
     */
    public function getMysqlBackupList()
    {
        return $this->request($this->section, __FUNCTION__);
    }

    /**
     * Метод возвращает список файлов и директорий из резервной копии по заданному пути и идентификатору.
     * @param $backup_id - идентификатор резервной копии backup_id,
     * если не задан - значит листинг идет по текущей копии;
     * @param $path - путь от корня домашней директории (например "/site.ru/public_html");
     * @return mixed
     */
    public function getFileList($path, $backup_id = '')
    {
        $params = array(
            'path' => $path,
        );

        if (! empty($backup_id)) {
            array_push($params, ['backup_id' => $backup_id]);
        }

        return $this->request($this->section, __FUNCTION__, $params);
    }

    /**
     * Метод возвращает список баз данных из резервной копии по заданному идентификатору.
     * @param $backup_id - идентификатор резервной копии backup_id,
     * если не задан - значит листинг идет по текущей копии;
     * @return mixed
     */
    public function getMysqlList($backup_id = '')
    {
        $params = array();
        if (! empty($backup_id)) {
            array_push($params, ['backup_id' => $backup_id]);
        }

        return $this->request($this->section, __FUNCTION__, $params);
    }

    /**
     * @param $backup_id - идентификатор резервной копии backup_id
     * @param $paths - массив (одно или несколько значений) путей для восстановления от корня домашней директории
     * (например "/site.ru/public_html");
     * @return mixed
     */
    public function restoreFile($backup_id, array $paths)
    {
        $params = array(
            'backup_id' => $backup_id,
            'paths' => $paths
        );

        return $this->request($this->section, __FUNCTION__, $params);
    }
}

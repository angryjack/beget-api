<?php
/**
 * Created by angryjack
 * Date: 2018-12-03 21:53
 */

namespace Angryjack\Beget;

use Angryjack\Beget\Exception\BegetException;
use GuzzleHttp\Client;

/**
 * Класс для работы с API бегета
 * @package Angryjack\Beget
 */
class Beget
{
    const API_URL = 'https://api.beget.com/api/';

    /**
     * @var string
     */
    protected $inputFormat = 'plain';

    /**
     * @var string
     */
    protected $outputFormat = 'json';

    /**
     * @var string
     */
    protected $instanceLogin;

    /**
     * @var string
     */
    protected $instancePassword;

    /**
     * Beget constructor.
     * @param string $login
     * @param string $password
     * @throws BegetException
     */
    public function __construct($login = '', $password = '')
    {
        if (empty($login)) {
            throw new BegetException('Логин не передан.');
        }
        if (empty($password)) {
            throw new BegetException('Пароль не передан.');
        }

        self::validateLogin($login);

        $this->instanceLogin = $login;
        $this->instancePassword = $password;
    }

    /**
     * @param $login
     */
    public static function validateLogin($login)
    {
        if (strlen($login) < 6) {
            throw new \InvalidArgumentException('Логин слишком короткий. Мин. длина логина 6 символов.');
        }
    }

    /**
     * @param $section
     * @return mixed
     */
    public function api($section)
    {
        if (empty($section)) {
            throw new \InvalidArgumentException('Не указан раздел API.');
        }
        $section = ucfirst(strtolower($section));

        $class = __NAMESPACE__ . '\Section\\' . $section;

        return new $class($this->instanceLogin, $this->instancePassword);
    }

    /**
     * @param $section
     * @param $method
     * @param array $params
     * @return mixed
     */
    public function request($section, $method, array $params = [])
    {
        $request = $this->makeRequest($section, $method, $params);
        $response = $this->sendRequest($request);

        return $response->getBody();
    }

    /**
     * @param $request
     * @return mixed
     */
    protected function sendRequest($request)
    {
        $client = new Client();
        return $client->request('POST', $request);
    }

    /**
     * @param $section
     * @param $method
     * @param array $params
     * @param string $inputFormat
     * @return string
     */
    protected function makeRequest($section, $method, array $params = [])
    {
        $url = self::API_URL . $section . $method;

        $paramsLine = '?login=' . $this->instanceLogin .
            '&passwd=' . $this->instancePassword .
            '&input_format=' . $this->inputFormat;

        foreach ($params as $key => $value) {
            $paramsLine .= '&' . $key . '=' . $value;
        }

        $paramsLine .= '&output_format=' . $this->outputFormat;

        return $url . $paramsLine;
    }
}

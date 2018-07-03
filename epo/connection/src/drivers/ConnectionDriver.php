<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 7/3/18
 * Time: 2:04 PM
 */

namespace epo\connection\src\drivers;


class ConnectionDriver
{
    public $hostUrl;
    public $authUrl;
    public $login;
    public $password;
    public $downloadPath;
    public $keywords = [];

    protected $ch;

    public function __construct()
    {
        $this->ch = curl_init();
    }
}
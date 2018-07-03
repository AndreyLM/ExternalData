<?php
namespace epo\connection\src\drivers;

use yii\base\InvalidConfigException;

interface ConnectionDriverInterface
{
    /**
     * @throws InvalidConfigException
     * @return array
     */
    public function getLinks();

    /**
     * @throws InvalidConfigException
     * @return ConnectionDriverInterface
     */
    public function connect();

    /**
     * @throws InvalidConfigException
     * @return ConnectionDriverInterface
     */
    public function logIn();

    /**
     * @throws InvalidConfigException
     * @return ConnectionDriverInterface
     */
    public function logOut();


    /**
     * @return InvalidConfigException
     */
    public function close();


    /**
     * @param string $url
     * @param string $destination
     * @throws InvalidConfigException
     * @return ConnectionDriverInterface
     */
    public function getResourse($url, $destination);

}
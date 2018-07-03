<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 7/3/18
 * Time: 2:05 PM
 */

namespace epo\connection\src\drivers;


use epo\connection\src\exceptions\InvalidConfigException;
use epo\connection\src\helpers\ParseHelper;

class HttpConnectionDriver extends ConnectionDriver implements ConnectionDriverInterface
{
    /**
     * @throws InvalidConfigException
     * @return array
     */
    public function getLinks()
    {
        curl_setopt($this->ch, CURLOPT_URL, $this->hostUrl.'/raw-data/atom');
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 1);

        $response = curl_exec($this->ch);

        if(curl_errno($this->ch)) {
            throw new InvalidConfigException(curl_error($this->ch));
        }

        return ParseHelper::find($response, $this->keywords);
    }

    /**
     * @throws InvalidConfigException
     * @return ConnectionDriverInterface
     */
    public function connect()
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_NOBODY, 0);
        curl_setopt($this->ch, CURLOPT_HEADER, 1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 300);

        if(curl_errno($this->ch)) {
            throw new InvalidConfigException(curl_error($this->ch));
        }

        return $this;
    }

    /**
     * @throws InvalidConfigException
     * @return ConnectionDriverInterface
     */
    public function logIn()
    {
        return $this;
    }

    /**
     * @throws InvalidConfigException
     * @return ConnectionDriverInterface
     */
    public function logOut()
    {
        return $this;
    }

    /**
     * @return ConnectionDriverInterface
     */
    public function close()
    {
        curl_close($this->ch);
        return $this;
    }

    /**
     * @param string $url
     * @param string $destination
     * @throws InvalidConfigException
     * @return ConnectionDriverInterface
     */
    public function getResourse($url, $destination)
    {
        $f = fopen($this->downloadPath. $destination, 'w+');

        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 300);
        curl_setopt($this->ch, CURLOPT_LOW_SPEED_LIMIT, 1024);
        curl_setopt($this->ch, CURLOPT_LOW_SPEED_TIME, 3600);
        curl_setopt($this->ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($this->ch, CURLOPT_FILE, $f);

        curl_exec($this->ch);
        fclose($f);

        if(curl_errno($this->ch)) {
            throw new ConnectionException(curl_error($this->ch));
        }

        return $this;
    }
}
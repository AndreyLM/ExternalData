<?php
namespace epo\connection\src;


use epo\connection\src\drivers\ConnectionDriverInterface;
use epo\connection\src\exceptions\InvalidConfigException;

use yii\di\Container;

class ConnectionManager
{
    /* @var Container */
    private $container;

    /* @var ConnectionDriverInterface*/
    protected $driver;

    public function __construct(Container $container)
    {
        $this->container = $container;


    }

    /**
     * @param string|ConnectionDriverInterface $driver
     * @return ConnectionDriverInterface
     * @throws  InvalidConfigException     */

    public function connect($driver)
    {
        if(!($driver instanceof ConnectionDriverInterface)) {
                $this->driver = $this->container->get($driver);
        }

        try {
            $this->driver->connect();

        } catch (\Exception $exception)
        {
            throw new InvalidConfigException();
        }

        return $this->driver;
    }

}
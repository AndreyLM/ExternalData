<?php

use epo\connection\src\ConnectionManager;
use epo\connection\src\drivers\ConnectionDriverInterface;
use epo\connection\src\drivers\HttpConnectionDriver;
use epo\connection\src\exceptions\InvalidConfigException;
use yii\di\Container;

require_once 'vendor/autoload.php';

$configs = require_once 'configs/params.php';

$di = new Container();

$di->set(ConnectionDriverInterface::class, function ($container, $params, $config) use ($configs) {
    $obj = new HttpConnectionDriver();
    foreach ($configs['epo_connection'] as $key => $value) {
        $obj->{$key} = $value;
    }
    return $obj;
});


$connectionManager = new ConnectionManager($di);

try {
    /* @var ConnectionDriverInterface */
    $adapter = $connectionManager->connect(ConnectionDriverInterface::class);
} catch (InvalidConfigException $exception) {
    echo $exception->getMessage();
}

echo var_dump($adapter->getLinks());

$adapter->close();





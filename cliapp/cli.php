<?php

/**
 * Phalcon - Cli Application Sample
 * @author: Jingle|ComingX
 */


use Phalcon\Di\FactoryDefault\Cli;

error_reporting(E_ALL);

define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');
try {

    $di = new Cli();

    $di->setShared('db', function () {
        $connection = new Phalcon\Db\Adapter\Pdo\Sqlite(array(
            'dbname'   => BASE_PATH . '/todo.sqlite'
        ));

        return $connection;
    });

    $loader = new \Phalcon\Loader();
    $loader->registerDirs(
        [
            APP_PATH . '/tasks',
            APP_PATH . '/models'
        ]
    )->register();

    $application = new \Phalcon\Cli\Console($di);

    /**
     * 处理console应用参数
     */
    $arguments = [];

    foreach ($argv as $k => $arg) {
        if ($k === 1) {
            $arguments["task"] = $arg;
        } elseif ($k === 2) {
            $arguments["action"] = $arg;
        } elseif ($k >= 3) {
            $arguments["params"][] = $arg;
        }
    }

    $application->handle($arguments);

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
    exit(255);
}

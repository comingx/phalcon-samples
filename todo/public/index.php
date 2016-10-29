<?php

/**
 * Phalcon Quick Start - ToDo Sample
 * @author: Jingle|ComingX
 */


use Phalcon\Di\FactoryDefault;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
try {

    /**
     * 实例化DI容器,该容器默认注册了许多服务
     */
    $di = new FactoryDefault();

    /**
     * 注册url服务
     * 设置BaseUri,即网站的基础Uri前缀
     */
    $di->setShared('url', function () {
        $url = new \Phalcon\Mvc\Url();
        $url->setBaseUri("http://www.todo.com/");

        return $url;
    });

    /**
     * 注册视图服务
     */
    $di->setShared('view', function () {
        $view = new \Phalcon\Mvc\View();
        $view->setDI($this);
        // 设置视图文件根目录
        $view->setViewsDir(APP_PATH . '/views/');
        // 注册volt和php视图引擎
        $view->registerEngines([
            '.volt' => function ($view) {
                $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $this);
                // 设置volt编译文件所在目录
                $volt->setOptions([
                    'compiledPath' => BASE_PATH . '/cache/',
                    'compiledSeparator' => '_'
                ]);

                return $volt;
            },
            '.phtml' => \Phalcon\Mvc\View\Engine\Php::class
        ]);

        return $view;
    });

    /**
     * 注册数据库服务
     * 注意使todo.sqlite具有写权限,同时todo.sqlite的所在文件夹应具有写权限
     * 也可以使用MySQL数据库
     */
    $di->setShared('db', function () {
        $connection = new Phalcon\Db\Adapter\Pdo\Sqlite(array(
            'dbname'   => BASE_PATH . '/todo.sqlite'
        ));

        return $connection;
    });

    $loader = new \Phalcon\Loader();
    $loader->registerDirs(
        [
            APP_PATH . '/controllers/',
            APP_PATH . '/models'
        ]
    )->register();

//    include APP_PATH . '/Debug.php';

    /**
     * 实例化应用,进入处理流
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}

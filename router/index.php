<?php
/**
 * Phalcon Quick Start - ToDo Sample
 * @author: Jingle|ComingX
 */
$router = new \Phalcon\Mvc\Router(false);
$router->add(
    "/([a-zA-Z0-9\_\-]+)/([a-zA-Z0-9\_\-]+)/([0-9]{4})/([0-9]{2})(/.*)*",
    ["controller" => 1, "action" => 2, "year" => 3, "month" => 4, "params" => 5]
);
$router->handle("/thread/list/2017/01/a");
var_dump($router->getControllerName());
var_dump($router->getActionName());
var_dump($router->getParams());


echo "Regex" . PHP_EOL;
$router = new \Phalcon\Mvc\Router();
$router->add("/thread/list/([0-9]+)\.html",
    [
        "controller" => "thread",
        "action" => "list",
        "id" => 1
    ]
);
$router->handle("/thread/list/20.html");
var_dump($router->getControllerName());
var_dump($router->getActionName());
var_dump($router->getParams());


echo "参数名" . PHP_EOL;
// 参数名
$router = new \Phalcon\Mvc\Router();
$router->add("/thread/list/{id:[0-9]+}\.html",
    [
        "controller" => "thread",
        "action" => "list"
    ]
);
$router->handle("/thread/list/20.html");
var_dump($router->getControllerName());
var_dump($router->getActionName());
var_dump($router->getParams());


echo "短语法" . PHP_EOL;
// 短语法
$router = new \Phalcon\Mvc\Router();
$router->add("/thread/list/{id:[0-9]+}\.html",
    "thread::list"
);
$router->handle("/thread/list/20.html");
var_dump($router->getControllerName());
var_dump($router->getActionName());
var_dump($router->getParams());


echo "占位符" . PHP_EOL;
$router = new \Phalcon\Mvc\Router();
// /thread
$router->add("/:controller ",
    [
        "controller" => 1,
        "action" => "index"
    ]
);
// /thread/list/20
$router->add("/:controller/:action/:params",
    [
        "controller" => 1,
        "action" => 2,
        "params" => 3
    ]
);
// /thread/list/20/2
$router->add("/:controller/:action/:int/:params",
    [
        "controller" => 1,
        "action" => 2,
        "int" => 3,
        "params" => 4
    ]
);
$router->handle("/thread/list/20/2");
var_dump($router->getControllerName());
var_dump($router->getActionName());
var_dump($router->getParams());


echo "多模块" . PHP_EOL;
// 路由到模块
$router = new \Phalcon\Mvc\Router();
$router->add("/:module/:params",
    [
        "module" => 1,
        "controller" => "index",
        "action" => "index",
        "params" => 2
    ]
);
$router->add("/:module/:controller/:params",
    [
        "module" => 1,
        "controller" => 2,
        "action" => "index",
        "params" => 3
    ]
);
$router->add("/:module/:controller/:action/:params",
    [
        "module" => 1,
        "controller" => 2,
        "action" => 3,
        "params" => 4
    ]
);
$router->handle("/admin/thread/list/8");
var_dump($router->getModuleName());
var_dump($router->getControllerName());
var_dump($router->getActionName());
var_dump($router->getParams());


echo "默认controller" . PHP_EOL;
$router->add("/thread/:action/:params",
    [
        "module" => "thread",
        "controller" => "frontend",
        "action" => 1,
        "params" => 2
    ]
);
$router->handle("/thread/list/8");
var_dump($router->getModuleName());
var_dump($router->getControllerName());
var_dump($router->getActionName());
var_dump($router->getParams());


echo "路由分组" . PHP_EOL;
$router = new \Phalcon\Mvc\Router(false);
$threadRouter = new \Phalcon\Mvc\Router\Group(
    [
        "module" => "thread",
        "controller" => "frontend"
    ]
);

$threadRouter->setPrefix("/thread");
$threadRouter->add(
    "/:action/:params",
    [
        "action" => 1,
        "params" => 2
    ]
);
$router->mount($threadRouter);
$router->handle("/thread/list/20");
var_dump($router->getModuleName());
var_dump($router->getControllerName());
var_dump($router->getActionName());
var_dump($router->getParams());


echo "notFound" . PHP_EOL;
$router = new \Phalcon\Mvc\Router(false);
$router->add("/thread/list/([0-9]+)\.html",
    [
        "controller" => "thread",
        "action" => "list",
        "id" => 1
    ]
);
$router->notFound(
    [
        "controller" => "error",
        "action" => "notfound"
    ]
);
$router->handle("/thread/list/a.html");
var_dump($router->getControllerName());
var_dump($router->getActionName());
var_dump($router->getParams());


echo "去除斜杠" . PHP_EOL;
$router = new \Phalcon\Mvc\Router(false);
$router->add("/thread/list/([0-9]+)",
    [
        "controller" => "thread",
        "action" => "list",
        "id" => 1
    ]
);
$router->handle("/thread/list/20/");
var_dump($router->getControllerName());
var_dump($router->getActionName());
var_dump($router->getParams());

$router->removeExtraSlashes(true);
$router->handle("/thread/list/20/");
var_dump($router->getControllerName());
var_dump($router->getActionName());
var_dump($router->getParams());


echo "路由命名及URL" . PHP_EOL;
$di = new \Phalcon\Di();
$di->set("router", function(){
    $router = new \Phalcon\Mvc\Router();
    $router->add("/thread/list/{id:[0-9]+}\.html",
        [
            "controller" => "thread",
            "action" => "list"
        ]
    )->setName("thread-list");
    return $router;
});
$url = new \Phalcon\Mvc\Url();
$url->setBaseUri('/phalcon-site/');
$url->setBaseUri('http://www.comingx.com/phalcon-site/');
$url->setDI($di);
var_dump($url->get(
    [
        "for" => "thread-list",
        "id" => 10
    ]
));





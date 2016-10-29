<?php
/**
 * Phalcon Quick Start - ToDo Sample
 * @author: Jingle|ComingX
 */


$di->set("dispatcher", function () {
    $em = new Phalcon\Events\Manager();
    $dispatcher = new Phalcon\Mvc\Dispatcher();
    $em->attach("dispatch:beforeDispatch", function($event, $dispatcher) {
        var_dump($_SERVER);
        echo($dispatcher->getControllerName());
        die($dispatcher->getActionName());
    });
    $dispatcher->setEventsManager($em);
    return $dispatcher;
});
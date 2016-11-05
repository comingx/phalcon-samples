<?php

/**
 * Phalcon - Cli Application Sample
 * @author: Jingle|ComingX
 */


class MainTask extends \Phalcon\Cli\Task
{
    // php cli.php
    public function mainAction()
    {
        $events = Event::find(array('order' => 'id DESC'));
        foreach ($events as $event) {
            echo $event->content . PHP_EOL;
        }
    }

    //php cli.php main cron someParam
    public function cronAction(array $params)
    {
        echo $params[0] . PHP_EOL;
        echo "清除过去的Token,删除无效的图片等等自动脚本";
    }

}


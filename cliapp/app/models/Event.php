<?php

/**
 * Phalcon - Cli Application Sample
 * @author: Jingle|ComingX
 */
use Phalcon\Mvc\Model;

class Event extends Model
{
    public $id;
    public $content;
    public $create_time;
    public $status;
}
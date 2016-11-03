<?php

/**
 * Phalcon Quick Start - ToDo Sample
 * @author: Jingle|ComingX
 */


use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->view->events = Event::find(array('order' => 'id DESC'));
    }

    public function saveAction()
    {
        $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
        $id = $this->request->getPost("id");
        $content = $this->request->getPost("content");
        if ($id == 0) {
            $event = new Event();
            $event->content = $content;
            $event->create_time = time();
            $event->status = 0;
            $result = $event->save();
        } else {
            $event = Event::findFirstById($id);
            $event->content = $content;
            $result = $event->save();
        }

        if ($result) {
            echo json_encode(array("success" => 1, 'id' => $event->id));
        } else {
            echo json_encode(array("errcode" => 500, 'message' => "未知错误"));
        }
    }

    public function statusAction()
    {
        $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
        $id = $this->request->getPost("id");
        $status = $this->request->getPost("status");
        $event = Event::findFirstById($id);
        $event->status = $status;
        if ($event->save()) {
            echo json_encode(array("success" => 1));
        } else {
            echo json_encode(array("errcode" => 500, 'message' => "状态更改失败"));
        }
    }

    public function deleteAction()
    {
        $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
        $id = $this->request->getPost("id");
        $event = Event::findFirstById($id);
        if ($event->delete()) {
            echo json_encode(array("success" => 1));
        } else {
            echo json_encode(array("errcode" => 500, 'message' => "删除失败"));
        }

    }

}


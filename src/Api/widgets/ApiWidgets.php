<?php

namespace itjack\apidoc\Api\widgets;

use yii\base\Widget;

class ApiWidgets extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = 'Hello World';
        }
    }

    public function run()
    {

        return $this->render('index',['message'=>$this->message]);
    }
}
<?php

namespace controllers;

use core\Controller;

class Error404 extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', 'main', null , ['Title' => '404']) ;
    }
}
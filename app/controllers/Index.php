<?php


namespace controllers;


use core\AbstractController;

class Index extends AbstractController
{
    public function index()
    {
        $this->view->render('index_index');
    }
}
<?php

class Login extends Controller{
    function __construct(){
        parent::__construct();
        
    }
    function index(){
        //Session::destroy();
        $this->view->data = $this->model->getAllUsers();
        //print_r($data[1][1]);
        $this->view->render('login/index');
        
    }
    function logout(){
        $this->model->logout();
        $this->index();
       
    }
    function run(){
        
        $data = $this->model->run();
        
        if (!$data['scs']){
            $this->index();
        } else {
            $this->view->data = $data;
            $this->view->render('dashboard/index');
        }
    }
}


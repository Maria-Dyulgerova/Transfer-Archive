<?php

class Dashboard extends Controller{
    function __construct(){
        parent::__construct();
        Session::init();
        $logged = Session::get('loggedIn');
        if ($logged == false){
            Session::destroy();
            $this->view->render('login/index');
            //header('location:../login');
            exit;
        }
        
    }
    function index(){
        $this->view->render('dashboard/index');
    }
    function logout(){
        Session::destroy();
        //$this->view->data = $this->model->getUsers();
        $this->view->render('login/index');
        //header('location:../login');
        exit;
    }
}


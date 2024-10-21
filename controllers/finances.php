<?php
//require_once 'models/login_model.php';
class Finances extends Controller{
    function __construct(){
        parent::__construct();
        Session::init();
        $logged = Session::get('loggedIn');
        //print_r($_SESSION);
        
        if ($logged == false){
            Session::destroy();
            $this->view->render('login/index');
            //header('location:../login');
            exit;
        }    
    }
    function index(){
        
        $this->view->data = $this->model->getAvailability();
        //print_r($this->view->files);
        $this->view->getExpences = $this->model->getExpences();
        $this->view->getEarnings = $this->model->getEarnings();
        $this->view->render('finances/index');
        
    }
    function expences(){
        $this->view->getExpences = $this->model->getExpences();
        $this->view->render('finances/expences');
    }
    function earnings(){
        $this->view->getEarnings = $this->model->getEarnings();
        $this->view->render('finances/earnings');
    }
    function addExpence(){
        $this->model->addExpence();
        $this->expences();
    }
    function addEarning(){
        $this->model->addEarning();
        $this->earnings();
    }
    function deleteExpence($id){
        $this->model->deleteExpence($id);
        $this->expences();
    }
    function deleteEarning($id){
        $this->model->deleteEarning($id);
        $this->earnings();
    }
}


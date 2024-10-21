<?php

class Admin extends Controller{
    function __construct(){
        parent::__construct();
        Session::init();
        $logged = Session::get('loggedIn');
        print_r($_SESSION);
        
        if ($logged == false){
            Session::destroy();
            $this->view->render('login/index');
            //header('location:../login');
            exit;
        }
        
    }
    
    function index(){
        
        $this->view->Files = $this->model->getUserFiles();
        $this->view->Users = $this->model->getUsers();
        $this->view->data['selUser'] = Session::get('u_id');
        $this->view->data['msg'] = '';
        $this->view->render('admin/manage_users');
    }
    function manageUsers(){
        $this->view->Users = $this->model->getUsers();
        $this->view->render('admin/manage_users');
    }
    function switchUserStatus($id, $state){
        echo 'STATE = '.  $state;
        echo '<br>ID = '.  $id;
        $this->model->switchUserStatus($id, $state);
        $this->manageUsers();
    }
    function addUser(){
        $this->view->data = $this->model->addUser();
        $this->manageUsers();
    }
    function deleteUserAndFiles($u_id){
        $this->view->data = $this->model->deleteUserAndFiles($u_id);
        //echo '<pre>'.print_r($this->view->data, true).'</pre>'; 
        $this->manageUsers();
    }
    function showUserUploads($u_id){
        $this->view->data = $this->model->getUserUploads($u_id);
        //echo '<pre>'.print_r($this->view->data, true).'</pre>'; 
        $this->manageUsers();
    }
    
}


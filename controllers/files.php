<?php
//require_once 'models/login_model.php';
class Files extends Controller{
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
        //$this->view->data['msg'] = '';
        $this->view->render('files/index');
        
    }
    function upload(){
        
        
        //print_r($_FILES);
        $upl_data = $this->model->upload();
        //print_r($upl_data['u_name']);
        
        $this->view->data = $upl_data;
        $this->index();
        
    }
    function deleteFile($id){
        $this->model->deleteFile($id);
        $this->index();
    }
    function showUserFiles() {
        $selUser = $_POST['users'];
        $this->view->Files = $this->model->getUserFiles($selUser);
        $this->view->Users = $this->model->getUsers();
        $this->view->data['selUser'] = $selUser;
        $this->view->render('files/index');   
    }
    
    
}


<?php

class News extends Controller{
    function __construct(){
        parent::__construct();
        Session::init();
        $logged = Session::get('loggedIn');
        
        if ($logged == false){
            Session::destroy();
            $this->view->render('news/index');
            
            exit;
        }
        
    }
    
    function index(){
        $this->view->CurPage = 1;
        $NewsNumber = $this->model->getNewsNumber();
        $this->view->NewsNumber = $NewsNumber;
        if ($NewsNumber > 0){
            $this->view->News = $this->model->getNews();
        }
        $this->view->render('news/index');
        }
        
    function upload(){
        $this->model->upload();
        $this->index();
    }
    function delete($id){
        $this->model->delete($id);
        $this->index();
    }
    function pagination($call_page){
        
        $rows_per_page = 10;
        $NewsNumber = $this->model->getNewsNumber();
        $this->view->NewsNumber = $NewsNumber;
        if ((intval($call_page) > ($NewsNumber / $rows_per_page)) || (intval($call_page < 1))){
            $call_page = 1;
        }
        if ($NewsNumber > 0){
            $this->view->News = $this->model->getNews($call_page, $rows_per_page);
            
            $this->view->CurPage = $call_page;
            
        }
        
        $this->view->render('news/index');
        
        
    }
    
    
    
}


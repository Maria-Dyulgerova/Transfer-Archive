<?php
class Login_Model extends Model{
    public function __construct() {
        parent::__construct();
    }
    public function getAllUsers(){
        
        $stmt='SELECT id, name FROM users';
        $result = $this->db->query($stmt);
        if ($result) {
            while ($row = $result->fetch_row()){
                $rows[] = $row;
            }
        $result->close();
        
        return $rows;
        }              
    }
    public function run(){
        $data = array();
        $u_id = $_POST['users'];
        $u_pass = $_POST['password'];
        $stmt='SELECT * FROM users WHERE id="'.$u_id.'"';
        $result = $this->db->query($stmt);
        
        if ($result) {
            $record = $result->fetch_row();
            
            if ($record[2] == hash('sha256',$u_pass, false)) {
                //$data['msg'] = 'Password is valid!!!<br>';
            //функциите на обекта Session (/libs)
            
                Session::init();
                Session::set('loggedIn', true);
                Session::set('u_id', $u_id);
                Session::set('u_name', $record[1]);
                Session::set('level', $record[3]);
                //аналогично на 
                /*
                session_start();
                $_SESSION['loggedIn'] = 'true';
                $_SESSION['u_id'] = $u_id;
                $_SESSION['u_name'] = $record[1];
                $_SESSION['level'] =  $record[3];
                */
                print_r($_SESSION);

                $data['scs'] = 1;
                
                
            } else {
                echo 'password is invalid!';
                //return false; 
                $data['scs'] = 0;
            }
            
        }
        return $data;
    }
    public function logout(){
        Session::destroy();
    }
}


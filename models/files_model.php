<?php
include_once 'login_model.php';
class Files_Model extends Model{
    public function __construct() {
        parent::__construct();
    }
    public function makeDir($dirName){
        return is_dir($dirName) || mkdir($dirName);
    }
    public function upload(){
    
    //echo '<pre>'.print_r($_FILES, true).'</pre>';
    
    
        
        $privateDir = 'uploads'.DIRECTORY_SEPARATOR.Session::get('u_name').DIRECTORY_SEPARATOR;
        if ($this->makeDir($privateDir)){
            if (count($_FILES)>0){ 
                print_r($_FILES['file']['size']);
                if ($_FILES['file']['size'] > 100000000) {
                    echo 'the file is too big! The maximum size acceptable is 100 MB';
                    $upload_scs = 0;
                } else {
                    
                    $upload_scs = move_uploaded_file($_FILES['file']['tmp_name'], $privateDir.$_FILES['file']['name']);
                    
                    if ($upload_scs){
                    $data['msg'] = 'файла е качен успешно';
                    $u_id = Session::get('u_id');
                    $stmt='INSERT INTO uploads VALUES ("",'.$u_id.', "'.$_FILES['file']['name'].'", NOW())';
                    $result = $this->db->query($stmt);
                        if (!$result) {
                            echo "Execute failed: (" . $result->errno . ") " . $result->error;
                            echo $stmt;
                            return false;
                        }
                    }else{
                        $data['msg'] = 'файла  не е качен успешно';
                    }   
                }
                //echo '<br>upl_scs = '.$upload_scs;
    
            } 
        return $data;  
        } else {
            echo 'cannot create folder or not found';
        }
    
    
    }
    public function getAllFiles(){
        echo 'here!!!';
        $stmt='SELECT * FROM uploads';
        $result = $this->db->query($stmt);
        if ($result) {
            while ($row = $result->fetch_row()){
                $rows[] = $row;
            }
        }
        else{
            echo 'no result';
        }
        //$result->close();
        //print_r($rows);
        return $rows;
        }
    public function getUsers() {
        $rows = array();
        
        $stmt='SELECT id, name FROM users WHERE previleges<>"admin"';
        $result = $this->db->query($stmt);
        if ($result) {
            while ($row = $result->fetch_row()){
                $rows[] = $row;
            }
            
        }else{
            echo '<br>no result for users';
        }
        return $rows;
    }
    
    public function getUserFiles($su_id=''){
        if ($su_id==''){
            $su_id=Session::get('u_id');
            
        }
        echo '<br>SELECTED USER: '.$su_id;
            
        if ($su_id == "0") {
            $stmt = $this->db->prepare('SELECT * FROM uploads ORDER BY date ASC');
        } else {
            $stmt = $this->db->prepare('SELECT * FROM uploads WHERE u_id=? ORDER BY date ASC');
            $stmt->bind_param("i", $su_id);
        }
        
        
        
        $result = $stmt->execute();
        $stmt->store_result();
        
        $stmt->bind_result($id, $u_id, $f_name, $date);
        $num_rows = $stmt->num_rows;
        $rec = array();
        $data = array();
        while ($stmt->fetch()) {
            $rec['id'] = $id;
            $rec['u_id'] = $u_id;
            $rec['f_name'] = $f_name;
            $rec['date'] = $date;
            
            $data[$id] = $rec;
            
        }
       //$data['msg'] = 'Selected User : '.$u_id;
       return $data;             
    }
    public function delete1($id){
        $stmt = $this->db->prepare('SELECT f_name FROM uploads WHERE id=?');
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($f_name);
        
        $u_name = Session::get('u_name');
        $file_path = URL.$u_name.'/';
        
        while ($stmt->fetch()){
            $file_name = URL.Session::get('u_name').'/';
            echo realpath($f_name);
            //$del_result = unlink(realpath($f_name));
        }
        
        //if ($del_result){
            $stmt = $this->db->prepare('DELETE FROM uploads WHERE id=?');
            $stmt->bind_param("i", $id);
            $stmt->execute();
        //}
        
    }
    public function deleteFile($id){
        $stmt = $this->db->prepare('SELECT f_name FROM uploads WHERE id=?');
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->store_result();
        
        $stmt->bind_result($f_name);
        
        //$rec = array();
        
        $stmt->fetch();
        
        
        $u_name = Session::get('u_name');
        $full_url = 'uploads/'.$u_name.'/'.$f_name;
        //echo '<br>URL:'.realpath($full_url);
        //print_r(realpath($full_url));
        if (!file_exists(realpath($full_url))){
            echo 'No such file!';
            $stmt = $this->db->prepare('DELETE FROM uploads WHERE id=?');
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }else {
            $del_result = unlink(realpath($full_url));
            if ($del_result){
                $stmt = $this->db->prepare('DELETE FROM uploads WHERE id=?');
                $stmt->bind_param("i", $id);
                $stmt->execute();
            }else{
                echo 'Deleting not Successful';
            }
        }
        
       //return $data;
        
    }
    
    
    public function deleteUserAndFiles($id){
        $stmt = $this->db->prepare('DELETE FROM users WHERE id=?');
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        if (!$result) {
            echo "Execute failed: (" . $result->errno . ") " . $result->error;
            return false;
        } 
    }

  
}


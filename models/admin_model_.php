<?php
include_once 'login_model.php';
class Admin_Model extends Model{
    public function __construct() {
        parent::__construct();
    }
    public function makeDir($dirName){
        return is_dir($dirName) || mkdir($dirName);
    }
    public function upload(){
    
    //echo '<pre>'.print_r($_FILES, true).'</pre>';
    
    
    $data['u_name'] = $_POST['u_name'];
    $u_id = Session::get('u_id');
    $privateDir = 'uploads'.DIRECTORY_SEPARATOR.$data['u_name'].DIRECTORY_SEPARATOR;
    if ($this->makeDir($privateDir)){
        if(count($_FILES)>0){ 
            if(move_uploaded_file($_FILES['file']['tmp_name'], $privateDir.$_FILES['file']['name'])){
                $data['msg'] = 'файла е качен успешно';
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
    return $data;  
    }
    else{
        echo 'cannot create dir or not found';
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
    
    public function getUserFiles($su_id){
        if ($su_id=='0'){
            $su_id=Session::get('u_id');
            echo 'current user';
        }
        
        
            echo '<br>SELECTED USER: '.$su_id;
            if ($su_id == "0") {
                $stmt = $this->db->prepare('SELECT * FROM uploads ORDER BY date ASC');
            } else {
                $stmt = $this->db->prepare('SELECT * FROM uploads WHERE u_id=? ORDER BY date ASC');
                $stmt->bind_param("i", $su_id);
            }
        
        //echo '<br>user ID:'.$u_id.'<br>';
        
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
        $del_result = unlink(realpath($full_url));
        if ($del_result){
            $stmt = $this->db->prepare('DELETE FROM uploads WHERE id=?');
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }else{
            echo 'Deleting not Successful';
        }
       
        
    }
    
    public function getUsers() {
       
        $stmt='SELECT id, name, state FROM users WHERE privileges<>"admin"';
        $result = $this->db->query($stmt);
        if ($result) {
            while ($row = $result->fetch_row()){
                $rows[] = $row;
            }
        $result->close();
        return $rows;
        }
        else{
            echo 'no result';
        }
        
    }
    public function deleteUserAndFiles($id){
        $stmt = $this->db->prepare('SELECT name FROM users WHERE id=?');
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($u_name);
        $stmt->fetch();
        
        $dir = 'uploads'.DIRECTORY_SEPARATOR.$u_name;
        $folders = array();
        $files = array();
        //$array = array();
        //$r_d_i = new RecursiveDirectoryIterator($dir);
        
        //interface for iterating recursively over filesystem directories.
        $r_d_i = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        //RecursiveIteratorIterator iterate through recursive iterators ($r_d_i).
        $iterator = new RecursiveIteratorIterator($r_d_i, RecursiveIteratorIterator::SELF_FIRST);
         
        foreach ($iterator as $item) {
            // Note SELF_FIRST, so array keys are in place before values are pushed.
                //$subPath = $r_d_i->getSubPathname();
                $subPath = $iterator->getSubPathName();
                    if($item->isDir()) {
                        // Create a new array key of the current directory name.
                        //$array[$subPath] = array();
                        $folders[] = $subPath;
                        /*echo '/';
                        print_r($subPath);
                        echo '<br>';*/
                    }
                    else {
                        // Add a new element to the array of the current file name.
                        /*$array[$subPath][] = $subPath;
                        print_r($subPath);
                        echo '<br>';*/
                        $files[] = $subPath;
                    }
        }
        echo '<pre>'.print_r($folders, true).'</pre>';
        echo '<pre>'.print_r($files, true).'</pre>';
        foreach ($files as $file){
            $path = 'uploads'.DIRECTORY_SEPARATOR.$u_name.DIRECTORY_SEPARATOR.$file;
            //unlink($path);
        }
        foreach (array_reverse($folders) as $folder){
            $path = 'uploads'.DIRECTORY_SEPARATOR.$u_name.DIRECTORY_SEPARATOR.$folder;
            //rmdir($path);
        }

        /*foreach ($content as $path => $dir) {
            if ($dir->isDir()) {
                $paths[] = $path;
            }
        }

        print_r($paths);
        /*
        $stmt = $this->db->prepare('DELETE FROM users WHERE id=?');
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        if (!$result) {
            echo "Execute failed: (" . $result->errno . ") " . $result->error;
            return false;
        }*/ 
    }
    public function switchUserStatus($id, $state){
        //$state = 'off';
        //$new_state = ($state == 'on'?'on':'off');
        echo $params =  
        
        $stmt = $this->db->prepare('UPDATE users SET state=? WHERE id=?');
        /*$stmt->bind_param("is", $id, $new_state);
        $result = $stmt->execute();
        if (!$result) {
            echo "Execute failed: (" . $result->errno . ") " . $result->error;
            return false;
        } */
    }
    public function addUser(){
        $u_name = $_POST['name'];
        $password = hash('sha256',$_POST['password'], false);
        $stmt = $this->db->prepare('INSERT INTO users VALUES ("",?, ?, "user", "on")');
        $stmt->bind_param("ss",$u_name, $password);
        $result = $stmt->execute();
        //$stmt='INSERT INTO users VALUES ("",'.$u_name.', '.$password.', "user")';
        //$result = $this->db->query($stmt);
        if (!$result) {
            echo "Execute failed: (" . $result->errno . ") " . $result->error;
            return false;
        } 
           
        
    }
  
}


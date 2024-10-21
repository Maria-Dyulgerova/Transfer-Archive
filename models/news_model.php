<?php
include_once 'login_model.php';
class News_Model extends Model{
    public function __construct() {
        parent::__construct();
    }
    public function getNewsNumber(){
        $stmt='SELECT COUNT(*) FROM news';
        $result = $this->db->query($stmt);
        if ($result) {
            $row = $result->fetch_row();
                $news_number = $row[0];
            
        }
        else{
            echo 'no news';
        }
        return $news_number;
    }
    public function getNews($cur_page = 1, $num_rows = 10){
        
        
        $offset = ($cur_page-1) * $num_rows;
        $stmt='SELECT * FROM news ORDER BY date DESC LIMIT '.$num_rows.' OFFSET '.$offset;
        $result = $this->db->query($stmt);
        if ($result) {
            while ($row = $result->fetch_row()){
                $rows[] = $row;
            }
        }
        else{
            echo 'no result';
        }
        return $rows;
    }
    public function upload(){
       
        $u_id = Session::get('u_id');
        $image = '';
            if(count($_FILES)>0){ 
                if(move_uploaded_file($_FILES['pic']['tmp_name'], 'uploads/'.$_FILES['pic']['name'])){
                    echo 'файла е качен успешно';
                    $image = $_FILES['pic']['name'];
                }else{
                    echo 'файла  не е качен успешно';
                    
                }
                
            }
            //if ($file <> '0'){
                    
                $stmt = $this->db->prepare('INSERT INTO news (date, content_bg, content_en, pic, u_id) VALUES (?,?,?,?,?)');
                //if ($file == ''){
                //    $file = $_POST['pic_name'];
                //}
                if ( !preg_match( "/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $_POST['date'] ) )
                { 
                    echo "invalid date format!<br>";
                    return false;
                }
                $image = ($image == '') ? $_POST['pic_name']:'';
                
                /*if ( !preg_match( "/^([a-zA-Z0-9].(jpg|png|gif|jpeg))$/", $image ) )
                { 
                    echo "invalid image type";
                    return false;
                }
                */
                //echo $_POST['date'].'<br>'. $_POST['text_bg'].'<br>'. $_POST['text_en'].'<br>'. $_FILES['pic']['name'].'<br>'. $u_id;
                if (!$stmt->bind_param("sssss", $_POST['date'], $_POST['text_bg'], $_POST['text_en'], $image, $u_id)) {
                    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
                    return false;
                }
                $result = $stmt->execute(); 
                if ($result){
                    echo 'новината е добавена!';
                } else {
                    echo 'новината не е добавена!';
                }
            
            //}
        }
        public function delete($id) {
            $stmt = $this->db->prepare('SELECT pic FROM news WHERE id=?');
            $stmt->bind_param("i", $id);
            $result = $stmt->execute();
            if ($result){
                $stmt->store_result();
                $stmt->bind_result($f_name);
                $stmt->fetch();
                $full_url = 'images/news/'.$f_name;
                echo '<br>URL:'.realpath($full_url);
                $del_pic_result = unlink(realpath($full_url));
                if ($del_pic_result){
                    
                } else {
                    echo 'Picture Deleting Not Successful';
                }
            } else {
                echo 'няма снимка за тази новина - '.$id.'<br>';
            }
            $stmt = $this->db->prepare('DELETE FROM news WHERE id=?');
            $stmt->bind_param("i", $id);
            $del_news_result = $stmt->execute();
            if ($del_news_result){
                echo 'News Deleting Successful';
            } else {
                echo 'News Deleting Not Successful';
            }
    
        }
        
        
        
    
    
  
}


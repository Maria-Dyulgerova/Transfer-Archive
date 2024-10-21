<?php

class Finances_Model extends Model{
    public function __construct() {
        parent::__construct();
        
    }
    public function getAvailability(){
        $stmt='SELECT SUM(amount) FROM earnings';
        $result = $this->db->query($stmt);
        if ($result) {
            while ($row = $result->fetch_row()){
                $earnings = $row[0];
            }
        }
        else{
            $earnings = 0.0;
        }
        $stmt='SELECT SUM(amount) FROM expences';
        $result = $this->db->query($stmt);
        if ($result) {
            while ($row = $result->fetch_row()){
                $expences = $row[0];
            }
        }
        else{
            $expences = 0.0;
        }
        //$result->close();
        //print_r($rows);
        $data['availability'] = (float)$earnings -(float)$expences;
        $data['earnings'] = $earnings;
        $data['expences'] = $expences;
        return $data;
    }
    public function getExpences(){
        $stmt='SELECT * FROM expences';
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
    public function addExpence(){
        $data['amount'] = $_POST['amount'];
        $data['reason'] = $_POST['reason'];
        $data['doc'] = $_POST['document'];
        $data['date'] = $_POST['date'];
        $sth = $this->db->prepare('INSERT INTO expences (user_id, amount, reason, document, date_made, date_rec) VALUES (?,?,?,?,?,?)');
        $u_id = Session::get('u_id');
        $cur_date = date('Y-m-d');
        if (!$sth->bind_param("ssssss", $u_id, $data['amount'], $data['reason'],$data['doc'],$data['date'], $cur_date )) {
            echo "Binding parameters failed: (" . $sth->errno . ") " . $sth->error;
            return false;
        }
        $sth->execute(); 
         
    }
    public function deleteExpence($id){
        $sth = $this->db->prepare('DELETE FROM expences WHERE id=?');
        $sth->bind_param("i", $id);
        $sth->execute();
        
    }
    public function getEarnings(){
        $stmt='SELECT * FROM earnings';
        $result = $this->db->query($stmt);
        if ($result) {
            while ($row = $result->fetch_row()){
                $rows [] = $row;
            }
        }
        else{
            echo 'no result';
        }
        $result->close();
        return $rows;   
    }
    public function addEarning(){
        $data['amount'] = $_POST['amount'];
        $data['sourse'] = $_POST['sourse'];
        $data['reason'] = $_POST['reason'];
        $data['doc'] = $_POST['document'];
        $data['date'] = $_POST['date'];
        $sth = $this->db->prepare('INSERT INTO earnings (user_id, amount, sourse, reason, document, date_made, date_rec) VALUES (?,?,?,?,?,?,?)');
        $u_id = Session::get('u_id');
        $cur_date = date('Y-m-d');
        print_r($data);
        if (!$sth->bind_param("sssssss", $u_id, $data['amount'], $data['sourse'], $data['reason'], $data['doc'],$data['date'], $cur_date )) {
            echo "Binding parameters failed: (" . $sth->errno . ") " . $sth->error;
            return false;
        }
        $sth->execute(); 
         
    }
    public function deleteEarning($id){
        $sth = $this->db->prepare('DELETE FROM earnings WHERE id=?');
        $sth->bind_param("i", $id);
        $sth->execute();
        
    }
}
    



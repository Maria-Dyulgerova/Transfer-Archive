<h1>Login</h1>
<?php 
//echo 'data[2][1] = ';
//print_r($this->data[2][1]);
//echo '"sha256" = ';
//print_r(hash('sha256','movingon', false));
//echo __FILE__;

?>

<form action="<? echo URL?>login/run" method="POST">
    <div>
    <select name="users">
        <option value="0">username</option>
<?php
    for ($i=0;$i<count($this->data);$i++){
    echo '<option value="'.$this->data[$i][0].'">'.$this->data[$i][1].'</option>';
    }   
?>
    </select></div>
    <div>
        <div>password:<input type="password" name="password"></div><input type="submit" value="Enter"></div>
</form>


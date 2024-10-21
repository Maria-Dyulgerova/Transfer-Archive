
<div>Hello 
<?php

echo Session::get('u_name');
?>
</div>
<div>
    Добавяне на потребители <br>
</div>
        <form action="<?=URL?>admin/addUser" method="POST">
            <div><input type="input" name="name"></div>
            <div><input type="password" name="password"></div>
            <div><input type="submit" value="Добави"></div>
        </form>
<br>
<div>
<?php
if (!empty($this->data)){
    
    extract($this->data);
    //echo '<pre>'.print_r($folders, true).'</pre>';
    //echo '<pre>'.print_r($files, true).'</pre>';
    echo '<pre>'.print_r($msg, true).'</pre>';    
}
        
?>
</div>
        
 <table class="table table-striped">
    <thead>
      <tr>
        <th>id</th>
        <th>name</th>
        <th>status</th>
        <th>actions</th>
        
        
      </tr>
    </thead>
    <tbody>
    
<?php
//print_r($this->Users);
if (!empty($this->Users)){
    foreach($this->Users as $key=>$value){
?>
        <tr>
            <td><?=$value[0]?></td>
            <td><?=$value[1]?></td>
            <td><?=$value[2]?></td>
            <td> 
                <a href="<?=URL?>admin/showUserUploads/<?=$value[0]?>">Show User Uploads</a>&nbsp; / &nbsp;
               <!-- <a href="<?=URL?>admin/switchUserStatus/<?=$value[0].'/'.$value[2]?>">Switch User Status</a>&nbsp; / &nbsp;//-->
                <a href="<?=URL?>admin/deleteUserAndFiles/<?=$value[0]?>">Delete User and Files</a>
            </td>
        </tr>
        
<?php
    }
}
?>
    </tbody>
  </table>
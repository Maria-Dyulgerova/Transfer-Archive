<?php
$u_name = Session::get('u_name');
echo $u_name;
//echo $this->data['selUser'];
?>

    <h3>Добавяне на файлове </h3> (размер не по-голям от 100 МБ)
    
        <form action="<? echo URL?>files/upload" method="POST" enctype="multipart/form-data" class="form-inline" role="form">
            <div class="form-group">
                <input type="file" name="file">
            </div>
            <input type="hidden" name="u_name" value="<?=$u_name?>">
            <input type="submit" value="Добави" class="btn btn-default btn-xs">
        </form>
    <hr>
<?php
//echo $this->data['msg'];
?>
<br>
        

   
  <div class="row">
  <div class="col-md-6"><h3>User Files</h3> </div>
  <div class="col-md-6"><span class="pull-right" style="vertical-align: bottom;">
      <form action="<? echo URL?>files/showUserFiles" method="POST" class="form-inline" role="form">
            
            <select name="users">
<?php
        
        $selUser = $this->data['selUser'];
        if ($selUser == '0'){
            echo '<option value="0" selected>all users</option>';    
        } else {
            echo '<option value="0">all users</option>'; 
        }
            for ($i=0; $i < count($this->Users); $i++){
                
                if ($this->Users[$i][0] == $this->data['selUser']){
                    echo '<option value="'.$this->Users[$i][0].'" selected>'.$this->Users[$i][1].'</option>';   
                } else {
                    echo '<option value="'.$this->Users[$i][0].'">'.$this->Users[$i][1].'</option>';
                }
            
            }   
?>
            </select>
            <input type="submit" value="Филтрирай" class="btn btn-default btn-xs">
        </form>
      </span>
  </div>
</div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>id</th>
        <th>user id</th>
        <th>file name</th>
        <th>date</th>
        
        <th>action</th>
      </tr>
    </thead>
    <tbody>
<?php
foreach($this->Files as $key=>$value){
?>
      <tr>
        <td><?=$value['id']?></td>
        <td><?=$value['u_id']?></td>
        <td><?=$value['f_name']?></td>
        <td><?=$value['date']?></td>
        
        <td><a href="<? echo URL?>files/deleteFile/<?=$value['id']?>">Delete</a></td>
      </tr>
<?php
}
?>
    </tbody>
  </table>

        

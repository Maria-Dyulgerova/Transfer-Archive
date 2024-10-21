
  
  <script>
    
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  
  </script>
ПРИХОДИ

        <form action="<?=URL?>/finances/addEarning" method="POST" class="form-horizontal" role="form">
            <div class="form-group">
                <label>сума:</label><input type="input" name="amount">
            </div>
            <div class="form-group">
                <label>източник:</label><input type="input" name="sourse">
            </div>
            <div class="form-group">
                <label>причина:</label><input type="input" name="reason">
            </div>
            <div class="form-group">
                <label>документ:</label><input type="input" name="document">
            </div>
            <div class="form-group">
                <label>дата:</label><input type="text" id="datepicker" name="date" data-format="YYYY-MM-DD">
                
            </div>
            <div class="form-group">
                <input type="submit" value="Добави" class="btn btn-default btn-xs">
            </div>
            
        </form>
<br>
<table class="table table-striped">
            <thead>
              <tr>
                <th>сума</th>
                <th>източник</th>
                <th>причина</th>
                <th>документ</th>
                <th>дата</th>
              </tr>
            </thead>
            <tbody>
                
<?php
    foreach($this->getEarnings as $key=>$value){
?>
        
    
    <tr>
    <td><?=$value[2]?></td>
    <td><?=$value[3]?></td>
    <td><?=$value[4]?></td>
    <td><?=$value[5]?></td>
    <td><?=$value[6]?></td>
    <td><a href="<?=URL.'finances/deleteEarning/'.$value[0]?>">Delete</a></td>
    </tr>
<?php     
    }
?>
            </tbody></table>
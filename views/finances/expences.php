<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="<?=URL?>/jquery/jquery-1.10.2.js"></script>
  <script src="<?=URL?>/jquery/jquery-ui.js"></script>
  
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  
  </script>
РАЗХОДИ

        <form action="<?=URL?>/finances/addExpence" method="POST" class="form-horizontal" role="form">
            
            <div class="form-group">
                <label>сума:</label><input type="input" name="amount">
            </div>
            <div class="form-group">
                <label>причина:</label><input type="input" name="reason">
            </div>
            <div class="form-group">
                <label>документ:</label><input type="input" name="document">
            </div>
            <div class="form-group">
                <label>дата:</label><input type="text" id="datepicker" name="date">
            </div> 
            <div class="form-group">
                <input type="submit" value="Добави" class="btn btn-default btn-xs">
            </div>
        </form>
<table class="table table-striped">
            <thead>
              <tr>
                <th>сума</th>
                <th>причина</th>
                <th>документ</th>
                <th>дата</th>
              </tr>
            </thead>
            <tbody>
<?php

    foreach($this->getExpences as $key=>$value){
?>
        
    
    <tr>
        <td><?=$value[2]?></td>
        <td><?=$value[3]?></td>
        <td><?=$value[4]?></td>
        <td><?=$value[5]?></td>
        <td><a href="<?=URL.'finances/deleteExpence/'.$value[0]?>">Delete</a></td>
    </tr>
<?php     
    }
?>
            </tbody>
</table>
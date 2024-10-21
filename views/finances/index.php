<?php

setlocale(LC_ALL, 'bg_BG.UTF-8');
?>
<br>
<div class="container">
    <a href="<? echo URL?>finances/earnings" class="btn">приходи</a>
    <a href="<? echo URL?>finances/expences" class="btn">разходи</a>
    <a href="<? echo URL?>finances/blowOutCash" class="btn">нулиране на касата</a><br><br>
    <h3>ПРИХОДИ</h3>
        <table class="table table-striped">
            <thead>
              <tr>
                <th>дата</th>
                <th>източник</th>
                <th>причина</th>
                <th>сума</th>
              </tr>
            </thead>
            <tbody>
<?php

foreach($this->getEarnings as $key=>$value){
?>
            <tr>
                <td><?=$value[6]?></td>
                <td><?=$value[3]?></td>
                <td><?=$value[4]?></td>
                <td><?=money_format("%i",$value[2])?></td>
            </tr> 
        
<?php
    }
?>    
        
            </tbody>
        </table>
            <h3>РАЗХОДИ</h3>
            <table class="table table-striped">
            <thead>
              <tr>
                <th>дата</th>
                <th>причина</th>
                <th>сума</th>
              </tr>
            </thead>
            <tbody>
            
<?php

foreach($this->getExpences as $key=>$value){
    ?>
                <tr>
            <td><?=$value[5]?></td>
            <td><?=$value[3]?></td>
            <td><?=money_format("%i",$value[2])?></td>
                </tr>
        
<?php
    }
?>
            </tbody></table>
    <?php
echo 'НАЛИЧНОСТ В КАСАТА : ';

echo money_format("%i", $this->data['availability']);
echo '<br>';
echo 'приходи : ';
echo money_format("%i", $this->data['earnings']);

echo '<br>';
echo 'разходи : ';
echo money_format("%i", $this->data['expences']);

echo '<br>';
?>
</div>

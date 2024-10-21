<?php
$u_name = Session::get('u_name');
$total_pages = ceil($this->NewsNumber / 10);
echo '<br>'.$this->CurPage;
?>

    <h3>Добавяне на новини </h3>
    
        <form action="<? echo URL?>news/upload" method="POST" enctype="multipart/form-data" class="form-horizontal">
            
            <div class="form-group">
                <label for="date" class="col-sm-1 control-label">дата</label>
                <div class="col-sm-3" id="date_container">
                    
                    <input id="date" name="date" type="text" data-format="YYYY-MM-DD" data-years="2000-2020" data-lang="en" value="">
                    <div id="ic__datepicker-1" class="ic__datepicker">
                    </div>
                    <script>

                    $(function(){
                        $("#demo1").ionCalendar({
                            lang: "en",
                            years: "1999-2045",
                            onClick: function(date){
                                $("#result-1").html("onClick:<br/>" + date);
                            }
                        });


                           $("#date").ionDatePicker();
                    });
                    </script>

                    
                </div>
                <div class="col-sm-8">
                    <input type="text" name="pic_name"> или 
                    <input type="file" name="pic">
                </div>
            </div>
            <div class="form-group">
                <label for="text_bg" class="col-sm-1 control-label">текст</label>
                <div class="col-sm-11">
                    <textarea cols="80" id="text_bg" name="text_bg" rows="4"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="text_en" class="col-sm-1 control-label">text</label>
                <div class="col-sm-11">
                    <textarea cols="80" id="text_en" name="text_en" rows="4"></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-12" align="right">
                    <input type="submit" value="Добави" class="btn btn-default btn-xs">
                </div>
            </div>
        </form>


    <hr>
<?php
//echo $this->data['msg'];
?>
<br>
        

   
  <div class="row">
  <div class="col-md-6"><h3>News</h3> </div>
  <div class="col-md-6"><span class="pull-right" style="vertical-align: bottom;">
      
      </span>
  </div>
</div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>id</th>
        <th>дата</th>
        <th>съдържание</th>
        <th>content</th>
        <th>action</th>
        <th>image</th>
      </tr>
    </thead>
    <tbody>
<?php
foreach($this->News as $key=>$value){
?>
      <tr>
        <td><?=$value[0]?></td>
        <td><?=$value[1]?></td>
        <td><?=$value[2]?></td>
        <td><?=$value[3]?></td>
        <td><img src="<? echo URL?>images/news/<?=$value[4]?>"></td>
        <td><a href="<? echo URL?>news/delete/<?=$value[0]?>">Delete</a></td>
      </tr>
<?php
}
?>
    </tbody>
  </table>
<?php
if ($total_pages > 1){
?>
<ul class="pagination">
    
<?php

    if ($this->CurPage > 1){
?>
    <li><a href="<?echo URL?>news/pagination/<?=$this->CurPage - 1?>"><<-</a></li>
<?php
    }
    for ($i = 1; $i <= $total_pages; $i++){
?>
    <li><a href="<? echo URL?>news/pagination/<?=$i?>"><?=$i?></a></li>

<?php
    }
    if ($this->CurPage < $total_pages){
?>
    <li><a href="<? echo URL?>news/pagination/<?=$this->CurPage + 1?>">->></a></li>   
<?php          
    }
?>
</ul>
<?php
}
?>
        
<script>
$('#pagination-demo').twbsPagination({
        totalPages: 10,
        visiblePages: 3,
        onPageClick: function (event, page) {
            $('#page-content').text('Page ' + page);
        }
    });
</script>
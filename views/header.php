<?php
$u_name = Session::get('u_name');
//echo Session::get('level');
?>
<html>
<head>   
    <title>Transfer Archive</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<? echo URL?>public/css/default.css">
    <!-- Latest compiled CSS -->
    <link rel="stylesheet" href="<? echo URL?>public/css/bootstrap.css">
    
     
    <link rel="stylesheet" href="<? echo URL?>public/css/ion.calendar.css" type="text/css">
    <link rel="stylesheet" href="<? echo URL?>public/css/jquery-ui.css">
<!--Optional theme //-->
    <link rel="stylesheet" href="<? echo URL?>public/css/bootstrap-theme.css">
    
    <script type="text/javascript" src="<? echo URL;?>public/js/jquery.js"></script>
    
</head>
<body>
    <div class="container">
    <div id="header">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="main_nav_bar">

      <ul class="nav navbar-nav">

          
<?php 
/*echo 'SESSION = ';
        print_r($_SESSION);
        
        echo'(';
        print_r(__FILE__);
        echo')<br>';

 */
    if (Session::get('loggedIn')==true){
    
          if (Session::get('level')=='admin')
          {
              
?>
          <li><a href="<?php echo URL;?>admin/manageUsers">Manage Users</a></li> 
          <li><a href="<?php echo URL;?>login/logout">Logout  <?php echo Session::get('u_name');?></a></li> 
<?php
          }else{
?>
<li><a href="<?php echo URL;?>news/index">News</a></li>
<li><a href="<?php echo URL;?>files/index">File Transfer</a></li>
<li><a href="<?php echo URL;?>finances/index">Finances</a></li>
<li><a href="<?php echo URL;?>login/logout">Logout  <?php echo Session::get('u_name');?></a></li>          
<?php
          }
} else {?>
<li><a href="http://www.siluetrock.com">go to Web Page</a></li>
<?php }?>
        
        
      </ul>
            </div>
        </div>
    </nav>
    
   
        
    </div>  
    <div id="content">



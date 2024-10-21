<html>
<head>
<meta charset="utf-8">
<title>jQuery Ion.Calendar Examples</title>
<link type="text/css" rel="stylesheet" href="http://www.jqueryscript.net/css/jquerysctipttop.css">
<link type="text/css" rel="stylesheet" href="http://www.jqueryscript.net/css/jquerysctipttop.css">
<link rel="stylesheet" href="<?=URL?>public/css/ion.calendar.css" type="text/css">
</head>
<body>
<h2>Datepicker Example:</h2>
<input id="mydate" type="text" data-format="YYYY-MM-DD" data-years="2015-2035" data-lang="en" value="">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
<script src="<?=URL?>public/js/moment.js"></script> 
<script src="<?=URL?>public/js/ion.calendar.js"></script> 
<script>

$(function(){
    $("#demo1").ionCalendar({
        lang: "en",
        years: "1915-1995",
        onClick: function(date){
            $("#result-1").html("onClick:<br/>" + date);
        }
    });


       $("#mydate").ionDatePicker();
});
</script>
<script type="text/javascript">


  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<div id="ic__datepicker-1" class="ic__datepicker" style="left: -9999px; top: -9999px;">

</body>
</html>
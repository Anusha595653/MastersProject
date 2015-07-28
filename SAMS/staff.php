<?php
include("headers.php");
include("container.php");
getheader();
error_reporting(0);
//echo $_SESSION['u_type'];
?>
 <script src="assets/js/script1.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui-1.8.2.custom.min.js"></script> 
<link href="assets/css/css.css" rel="stylesheet" type="text/css" />

 <div class="panel panel-primary" style="margin-top:-20px; border-radius:0px;">

      <div class="panel-body" >
	  <br><br><br>
  <div style="height:301px" >
 <body  onload="func()">
 
 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/jquery-ui.js" type="text/javascript"></script>
<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/start/jquery-ui.css"
    rel="stylesheet" type="text/css" />
<div id="dialog" style="display: none">
   Student Created Successfully
</div>

 <script>
 function func()
 {
	$(document).ready(function(){
    $('#myBtn').click(function(){
        $('#myModal').show();
    });
});
	}
 </script>
 
 <div class="modal fade" id="overlay">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>Context here</p>
      </div>
    </div>
  </div>
</div>

 <?php
 if($_GET["msg"]=="1"){
	 echo "
	 <script type='text/javascript'>
    $(function () {
        $('#dialog').dialog({
            title: 'Success',
            buttons: {
                Close: function () {
                    $(this).dialog('close');
                }
            }
        });
    });
</script>
";
 echo "<font color=green>Student Created Successfully</font>";}
  if($_GET["msg"]=="11")
	  {
	 echo "<script>alert('Faculty/Staff Created Successfully')</script>";
	  echo "<font color=green>Faculty/Staff Created Successfully</font>";}
  if($_GET["msg"]=="2")
	 echo "<font color=green>Appointment  Created Successfully<br>Appintment ID is:</font>".$_GET["appid"]. " <Br><a href=addnote.php?aptid=".$_GET["appid"]."&sid=".$_GET["sid"].">Add Note or View Appointment</a>";
if($_GET["update"]=="1")
	 echo "<script>alert('Student Information Updateds Successfully')</script>";
if($_GET["update"]=="success")
	 echo "<script>alert('Profile Updated Successfully')</script>";

 ?>

  <form class="form-horizontal" method="post" action="index1.php">
  
    <div class="form-group" style="text-align:left">
	
      <label class="control-label col-sm-5" for="email"></label>
	  <h2 width="20%">&nbsp;&nbsp;&nbsp;Student Search<!-- :	<label class="glyphicon glyphicon-search"></label>-->
    </h2>
      <div class="col-sm-5" align="center" style="text-align:center">
	   <input type="text"  style="display:none" id="srch" value="0">
	   <input type="text" class="form-control"  id="dd_user_input" placeholder="Type User ID or Name Here" id="dd_user_input" type="text" onkeyup="search()" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue)this.value='';" >	
		</div>
	  
	  
	  
	  
	  
    </div>
	
  </form>
  </div>
    </div>

</div>
<!--
  <div class="table-responsive" style=" border: 1px solid black;">          
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Firstname</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>       <div class="col-sm-5">
        <input type="email" class="form-control" id="email" placeholder="Enter email">
      </div>

</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Debbie</td>
      </tr>
      <tr>
        <td>3</td>
        <td>John</td>
      </tr>
    </tbody>
  </table>
  </div>
-->
 <div class="panel panel-primary" style="margin-top:-20px;border-radius:0px;background-color:#00A4D3">
      <div class="panel-heading" style="border-radius:0px;background-color:#00A4D3"><div class="col span_16" style="text-align:center;border-radius:0px">
			5500 North St.Louis Ave, Chicago , IL , 60625
			</div></div>
</div>

</body>
</html>
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>
  <style>
  .modal-header, h4, .close {
      background-color: #5cb85c;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
      background-color: #f9f9f9;
  }
  </style>
 <script type="text/javascript"> 
 function getvalue()
 {
 document.getElementById("srch").value=document.getElementById("srchbase").value;
 }
function search()
{
$(function() {
var srchbase=document.getElementById("srch").value;
$("#dd_user_input").autocomplete({
source: "global_search.php?srchbase="+srchbase,
minLength: 2,
select: function(event, ui) {
var getUrl = ui.item.id;
if(getUrl != '#') {
location.href = getUrl;
}
},
html: true, 
open: function(event, ui) {
 		$(".ui-autocomplete").css("z-index", 1000);
}
});
});
}
</script>

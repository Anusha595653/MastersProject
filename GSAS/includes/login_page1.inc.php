 <!doctype html>
 
<head>
	<meta charset="utf-8">
	<meta charset=utf-8>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>SAMS</title>
	<meta name="description" content="">
	<meta name="author" content="">
 
	
	
	
	
	<link rel="stylesheet" href="assets/css/whhg.css" />
	<link rel="stylesheet" href="assets/css/grid.css">
	<link rel="stylesheet" href="assets/css/styles.css">
	<link rel="icon" type="image/png" href="assets/images/clogo.gif">
	<link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="assets/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="assets/images/apple-touch-icon-114x114.png">
	 <script type="text/javascript">
            var image1=new Image();
image1.src="images/6.jpg";
var image2=new Image();
image2.src="images/2.jpg";
var image3=new Image();
image3.src="images/3.jpg";
var image4=new Image();
image4.src="images/4.jpg";
var image5=new Image();
image5.src="images/5.jpg";
var image6=new Image();
image6.src="images/6.jpg";


            </script>

</head>
<body style="background-color:#D8DDD8;font-family:Times New Roman;font-size:18px">
<br>	
 
 
	<div id="Stats" class="container">
		<div class="row">
			<div class="col span_4"><b class="value"><img src="assets/images/clogo.gif" style="width:200%"></b></div>
	 	<div class="col span_4"></div>
		<div class="col span_4" style="width:60%"><table width="100%"><tr><td><br>	<h2 style="color:#FFA834;font-family:bold">&nbsp;&nbsp;&nbsp;DEPARTMENT OF COMPUTER SCIENCE</b></h2></td></tr>
		<tr><td><br><h2 style="color:#00A4D3;font-family:bold">&nbsp;GRADUATE STUDENT ADVISING SYSTEM</b></h2></td></tr>
		</table></div>

		</div>
	</div>
<div id="Stats1" class="container"><br> <!--	
 			<table width="100%"><tr><td width="25%"><h3><a href="#" style="color:#FFC581;font-family:bold;hover:red;font-size:18px">Home</a></b></h3></td>
			<td width="25%"><h3><a href="#" style="color:#FFC581;font-family:bold;font-size:18px">Add Student</a></b>
			</h3></td><td width="25%"><h3><a href="#" style="color:#FFC581;font-family:bold;hover:red;font-size:18px">Add Faculty/Staff</a></b></h3></td>
			<td width="25%"><h3><a href="#" style="color:#FFC581;font-family:bold;font-size:18px">Chart Builder</a></b></h3></td>
			</tr>
		</table>	-->
	</div>

	<div id="Stats1" class="container">
	       <div id="imageslide">
                    <div id="imagesliding">
                        <img src="images/6.jpg" name="slide" id="s" width="100%" height="100%" />
<script>

var step=2;
function slideit(){

if (!document.images)
return
document.images.slide.src=eval("image"+step+".src");
if (step<5)
step++;
else
step=1;

setTimeout("slideit()",700);
}
slideit();
</script>
                    </div>
                </div>
	</div>


<?php
 
include("container.php");

?>
  <style type="text/css">
 
 #abcd{ height:55px;}
label{font-size:18px;font-color:#00A4D3}
 .ontop {
				z-index: 999;
				width: 100%;
				height: 100%;
				top: 0;
				left: 0;
				display: none;
				position: absolute;				
				 
				color: #aaaaaa;
				opacity: .9;
				filter: alpha(opacity = 50);
			}
			#popup {
				width: 500px;
				height: 400px;
				position: absolute;
				color: #000000;
				background-color: lightgray;
				/* To align popup window at the center of screen*/
				top: 70%;
				left: 40%;
				margin-top: -100px;
				margin-left: -150px;
			}
			#popup p
			{

text-align:center;

font-size:20px;
color:blue;
height:38px;
float:right;

margin:0px 10px 0px 10px;
			}
			#popup ul li
			{
			list-style-type:none;
			}

                        #popup h2 
			{
                            text-align: center;
                            color: orange;
                            font-weight: bolder;
                        }
                        #txt
                        {
                            border:1px solid black;
                            width: 52%;
                            height: 35px;
                            margin: 0px 0px 0px 20px;
                        }
                        #label
                        {
                            margin: 60px 0px 0px 80px;
                        }
                        #popup ul li
                        {
                            
                            font-size: 15px;
                            font-weight: bolder;
                        }
                        #sbt
                        {
                            margin: 30px 0px 0px 200px;
                            width: 25%;
                            height: 35px;
                            border: 0px;
                            background-color: deepskyblue;
                            color: red;
                            font-weight: bolder;
                            border-radius: 5px;
                            font-size: 18px
                            
                        }
                        
		</style>
		<script type="text/javascript">
		function addnote(str1,str2)
		{
			document.getElementById(str1).style.display = 'block';
		}
			function pop(div) {
				document.getElementById(div).style.display = 'block';
			}
			function pop1(div) {
			pop(div);
			}
			function hide(div) {
				document.getElementById(div).style.display = 'none';
			}
			//To detect escape button
			document.onkeydown = function(evt) {
				evt = evt || window.event;
				if (evt.keyCode == 27) {
					hide('popDiv');
				}
			};
			
		</script>
 <style>
input[type="text"].focus {
border: 2px solid red;}
 #abcd{ height:55px;}
label{font-size:18px;font-color:#00A4D3}
 </style>
 
 	<div id="Statsfrm" class="container"> 
 
	<div class="container" style="margin:2px 200px 10px 200px;height:50%;">
 
  
 <h2><b style="color:#00A4D3"> <img src="images/signin.jpg" width="50px" height="50px"> </b></h2><br>

<form   method="post"  action="index.php">
  <p align="center">
  <?php
  
         
  		    echo $errors[0];
?>
<table width="100%"> 
	<tr id="abcd">  
		<td><label>User Name: </label></td>
		<td align="left"><input type="text" name="uid" style="border:solid 1px #e3e3e3;"/></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	</tr>    

	<tr id="abcd">
		<td><label>Password: </label></td>
		<td align="left"><input type="password" name="pass" /></td>
	</tr>
 <input type="hidden" name="submitted"
value="TRUE" />
<tr id="abcd">
<td></td>
 <td><button class="btn btn-large" name="submit" type="submit">SignIn</button>
				</td></tr>
  <tr><td></td><td><a href=# onClick="pop('popDiv')"> <img src="images/forgot.jpg" width="150px" height="50px"></a> 
 </td></tr> </table>
  </form> 

 
 
<form id="newappt" name="newappt" method="post"  action="forgotprocess.php">
<input type="hidden" name="studentid" id="studentid" value="<?php echo $_GET['sid']; ?>"/>
<input type="hidden" name="time" id="time" value=""/>
  </div> <br><br>
<div id="popDiv" class="ontop">
			<div id="popup">
				<p id="bar" onclick="hide('popDiv')"><a href="" style="text-decoration:none;color:blue;">X</a></p>
                                <h2><b style="color:orange;">Forgot Password</b></h2>
				<ul> <li id="label">Enter Email<input type="text" name="email" id="txt" /></li>
					<ul>  
				<li><input type="submit" value="Submit" id="sbt"/></li>
				</ul>
			</div>
		</div>

		</form>
<?php
include('footer.php');
?> 
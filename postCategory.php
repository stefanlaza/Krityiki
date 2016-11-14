<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<?php 
	require_once("GUI.php");
	require_once('Login.php');
	require_once('PostsHandler.php');
?>
<html>
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="ie.css" />
<![endif]-->
	<head>
		<meta http-equiv="Content-Type" content="text/html">
		<meta charset="utf-8">
		<script language="javascript" src="javascript_functions/impressions.js"></script>
                <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
                <link type="text/css" rel="stylesheet" href="jQuery/jquery.dropdown.css" />
                <script type="text/javascript" src="jQuery/jquery.dropdown.js"></script>
                <script language="javascript" src="script.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.js"></script>
                <script src="hoverfade.jquery.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                      $('.reviewImage').hoverfade();
                    });
                </script>
                <script>
                  $(document).ready(function(){
                    /*dropdown start*/
                    $('#menubutton1').click(function () {
                      if ($("#dropdown-1:first").is(":hidden")) {
                        $("#dropdown-1").slideDown("fast");
                      } else {
                        $('#dropdown-1').hide();
                      }
                    }
                    );
                    $('#menubutton2').click(function () {
                      if ($("#dropdown-2:first").is(":hidden")) {
                        $("#dropdown-2").slideDown("fast");
                      } else {
                        $('#dropdown-2').hide();
                      }
                    }
                    );	
                    $('#menubutton3').click(function () {
                      if ($("#dropdown-3:first").is(":hidden")) {
                        $("#dropdown-3").slideDown("fast");
                      } else {
                        $('#dropdown-3').hide();
                      }
                    }
                    );
                    $('#menubutton3').click(function () {
                      if ($("#dropdown-3:first").is(":hidden")) {
                        $("#dropdown-3").slideDown("fast");
                      } else {
                        $('#dropdown-3').hide();
                      }
                    }
                    );
                    $('#menusearch').click(function () {
                      if ($("#dropdown-s:first").is(":hidden")) {
                        $("#dropdown-s").slideDown("fast");
                      } else {
                        $('#dropdown-s').hide();
                      }
                    }
                    );

                  });
                </script>
		<title>Kritikyi</title>

	<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
	   <div id="header"></div> 
	   <div id="title">
			<img src='images/gui/title.png' alt="title" />
	   </div>
	   <div id="wrapper">
		<?php
			PrintLogoAndMenu();
		?>
		<div id="mainpart">
			<?php 
				$con = connect();
				PrintFirstColumn($con); 
				printSecondColumnPostCategory($con);
				PrintThirdColumn($con);
				$con = null;
			?>
			
			
		</div>
		</div>
		</body>
</html>



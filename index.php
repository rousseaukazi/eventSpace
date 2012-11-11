<!DOCTYPE html> 
<html> 
<head> 
	<title>Event Space Test Site</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
	<script type="text/javascript">
		
		// begin dashboard
			$setTargetWidth = 500;
		<?php 		
			$setPageTitle = "Event Space Testing, Day 3"; 
			
		?>	
		// end dashboard

		$(document).ready(function() {
			
    		$width = $('#content').width();
			
			//check variables
    		console.log($setTargetWidth);
    		console.log($width);

			if ($width > $setTargetWidth)
				{
					$('#content img').css({
						'max-width' : $setTargetWidth , 'height' : 'auto' , 'border-radius' : '25px' 
						});

			} else {

	    			$('#content img').css({
						'max-width' : $width , 'height' : 'auto' , 'border-radius' : '25px'
	        			});
	    	};
	    });
	</script>

</head>



<body> 


<div data-role="page" data-theme="a" data-content-theme="a">

		<div data-role="header">
			<h1>
				<?php
	            echo $setPageTitle
	            ?>
			</h1>
		</div>

		


	<?php
		include "connection.php";

		$data = mysql_query("SELECT * FROM Entries");
	
		while($info = mysql_fetch_array($data )) 
		{
			
			echo '<div data-role="header" data-theme="d" data-content-theme="d"><h1> Album: '. $info['Album'] . '</h1></div>';
			echo '<div data-role="content" align="center">';
			echo '<div id="wrapper"><div id="content"><img src="' . $info['Picture'] . '"</div></div></div><br><br>';
		} 

	?>


</div><!-- /page -->

</body>

</html>
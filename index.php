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
			$setTxtFile = "day_three_test.txt";
			$setPageTitle = "Event Space Testing, Day 3"; 
			$album_name_array = array(
				"bond",
				"sadface", 
				"picture"
			);
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

		#counts the number of lines in the file
		$file=$setTxtFile;
		$linecount = 0;
		$handle = fopen($file, "r");
		while(!feof($handle)){
  			$line = fgets($handle);
  			$linecount++;
		}

		fclose($handle);

		#looks for all lines beginning w "h" and w "1"
		#and appends them to the end of the arrays 
		#$picture_array and $number_array, 
		$myFile = $setTxtFile;
		$fh = fopen($myFile, 'r');
		$picture_array = array();
		$number_array = array();
		$keyword_array = array();
		for ($i = 1; $i <= $linecount; $i++) {
			$dataLine = fgets($fh);
			if ($dataLine[0] == "h") {
				array_push($picture_array, $dataLine);
			} else if ($dataLine[0] == '1'){
				array_push($number_array, $dataLine);
			} else {
				array_push($keyword_array, strtolower(trim(preg_replace( '/[^[:print:]]/', '',$dataLine))));
			}
		}

		#array that makes a dictionary where the keys
		#== the values from $number_array and give 
		#names associated w the numbers as values
		$number_to_name = array(
		    16508420492 => "Rousseau Kazi",
		    18042294822 => "Channing Allen",
		    18477226071 => "Suman Venkataswamy",
		    14086246110 => "Ashley Malone",
		    19518928892 => "Ashley Bennett",
		  	16505213837 => "Alexa Krakaris",
		  	18472716925 => "Jonathon Paul",
		  	19519929201 => "Jelani Hayes",
		  	14157866212 => "Sumaya Kazi",
		  	12532283438 => "Joshua Evenson",
		  	19413024516 => "Rob Balian",
		  	17143920591 => "Evan Kawahara",
		  	19145847487 => "Maddie Boyd",
		  	13046155153 => "Addison Litton",
		  	15514047775 => "Christopher Lo"
		);

		for ($l = 0; $l < count($album_name_array); $l++) {
				echo '<div data-role="header" data-theme="d" data-content-theme="d"><h1> Album: '. $album_name_array[$l] . '</h1></div>';
				echo '<div data-role="content" align="center">';
				for ($j = count($picture_array); $j >= 0; $j--) {
					if ($keyword_array[$j] == $album_name_array[$l]) {
						echo '<div>' . $number_to_name[intval($number_array[$j])] . '</div><div id="wrapper"><div id="content"><img src="' . $picture_array[$j] . '"</div></div></div><br><br>';
					} 
				}
				echo '</div>';
			}

			fclose($fh);
		?>


</div><!-- /page -->

</body>

</html>
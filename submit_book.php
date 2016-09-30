<?php

if (isset($_GET['lang']))
	$locale = substr($_GET['lang'], 0, 2);

else
	$locale = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

if(!in_array($locale, array('en', 'it')))
	$locale = 'en';

include_once 'languages/' . $locale . '.php';
?>

<html>
	<head>
		<title>Libre-book</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="icon" type="image/png" href="favicon.png">
		<meta charset="UTF-8"> 
	</head>
	<body>
		<div class="center title" id="title">
			libr<font color="CadetBlue">e-book</font>
		</div>

		<div class="center">
			<?php echo $lang['subtitle'];?>
			<br><br><br>
			<div class="right inputs">
				<form action="sub.php" method="post" enctype="multipart/form-data">
					<?php
					echo '<input name="isbn" placeholder="ISBN" class="tbox">
						<input name="title" placeholder="' . $lang['title'] . '" class="tbox">
						<input name="subj" placeholder="' . $lang['subject'] . '" class="tbox">';
					?>
					<select style="font-size: 15px" class="tbox" name="class">
	                    <?php

	                    foreach ($lang['classes'] as $key => $value)
	                    	echo '<option value="' . $key . '" style="font-size: 15px">' . $value;

	                    ?>
	                </select>
	                <input type="file" name="file_loc" id="file_loc" class="tbox">
	                <?php echo '<input type="submit" value="' . $lang['send'] . '" name="submit">';?>
				</form>
			</div>
		</div>

		<span class="bt-r footnote" id="foot">
			DP Development 2016<br>GNU GPL3
		</span>

		<span class="bt-l footnote">
			<a href="faq.php">
				<?php echo $lang['cont_faq'];?>
			</a>
		</span>

		<script src="main.js"></script>
	</body>
</html>
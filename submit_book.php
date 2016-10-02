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
			<a href="index.php" class="no-dec">
				libr<font color="CadetBlue">e-book</font>
			</a>
		</div>

		<div class="center">
			<?php echo $lang['subtitle'];?>
			<br><br><br>
			<div class="right inputs">
				<form action="sub.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<?php
					echo '<label for="class">' . $lang['class'] . '</label>';
					echo '<input name="isbn" placeholder="ISBN" class="tbox">
						<input name="title" placeholder="' . $lang['title'] . '" class="tbox">
						<input name="subj" placeholder="' . $lang['subject'] . '" class="tbox">';
					?>
					<select style="font-size: 15px" class="tbox" name="class">
	                    <?php

	                    echo '<option value="" disabled selected>' . $lang["grade"];

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
			<a href="https://github.com/deeepaaa/librebook">
				DP Development 2016<br>GNU GPL3
			</a>
		</span>

		<span class="bt-l footnote">
			<a href="faq.php">
				<?php echo $lang['cont_faq'];?>
			</a>
		</span>
	</body>
</html>
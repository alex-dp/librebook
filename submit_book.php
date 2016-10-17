<?php
include_once 'tools.php';
$lang = get_lang($_GET['lang'], $_SERVER['HTTP_ACCEPT_LANGUAGE']);
?>

<html>
	<head>
		<title>Libre-book</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="icon" type="image/png" href="favicon.png">
		<meta charset="UTF-8"> 
	</head>
	<body>
		<script src="sanitize.js"></script>
		<div class="center title" id="title">
			<a href="index.php" class="no-dec">
				libr<font color="#01a5ca">e-book</font>
			</a>
		</div>

		<div class="center">
			<?php echo $lang['subtitle'];?>
			<br><br><br>
			<div class="right inputs">
				<form action="sub.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<?php
					echo '<input name="isbn" placeholder="ISBN" class="tbox" oninput="checkisbn()" id="isbn">
						<input name="title" placeholder="' . $lang['title'] . '" class="tbox">
						<input name="subj" placeholder="' . $lang['subject'] . '" class="tbox">';
					?>
					<select style="font-size: 15px" class="tbox" name="class">
	                    <?php

	                    echo '<option value="" disabled selected>' . $lang["grade"];

	                    foreach ($lang['classes'] as $key => $value)
	                    	echo '<option value="' . $key . '">' . $value;

	                    ?>
	                </select>
	                <input type="file" name="file_loc" id="file_loc" class="tbox">
	                <input name="filter" style="display: none">
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
			<?php
				echo '<a href="res.php?lang=' . $lang['code'] . '">' . $lang['index'] . '</a><br>';
				echo '<a href="faq.php?lang=' . $lang['code'] . '">' . $lang['cont_faq'] . '</a><br>';
			?>
		</span>
	</body>
</html>
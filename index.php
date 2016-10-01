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
			<?php echo $lang['subtitle']; ?> <br>
			<font size="2"><?php echo $lang['sub_spec']; ?> </font> <br><br>
			<div class="inputs">
				<form action="res.php">
					<?php
						echo '<input type="text" class="tbox" placeholder="' . $lang["isbn_search"] . '" name="isbn"/>';
					?>
				</form>
			</div>
		</div>

		<div class="sides">
			<?php
				echo '<input type="button" value="' . $lang['donate'] . '" id="donate" onclick="location.href = \'https://www.paypal.me/makeitrainonme\'">
			<input type="button" value="' . $lang["add_book"] . '" id="submit_book" onclick="location.href = \'submit_book.php\'">';
			?>
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
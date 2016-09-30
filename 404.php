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

		<div class="center big">
			<?php echo $lang['page_not_exists'];?>
			<br>:(
		</div>

		<span class="bt-r footnote" id="foot">
			DP Development 2016<br>GNU GPL3
		</span>

		<script src="main.js"></script>
	</body>
</html>
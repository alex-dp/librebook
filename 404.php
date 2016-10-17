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
		<div class="center title" id="title">
			<a href="index.php" class="no-dec">
				libr<font color="#01a5ca">e-book</font>
			</a>
		</div>

		<div class="center big">
			<?php echo $lang['page_not_exists'];?>
			<br>:(
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
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
		<?php echo
			'<meta name="description" content="' . $lang['description'] . '">';
			echo '<meta name="keywords" content="';
			foreach ($lang['keywords'] as $word)
				echo $word . ', ';
			echo '">';
		?>
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
			<form action="res.php" autocomplete="off">
				<?php
					echo '<input type="text" class="tbox" placeholder="' . $lang["search"] . '" name="search"/>';
				?>
			</form>
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
			<?php
				echo '<a href="res.php?lang=' . $lang['code'] . '">' . $lang['index'] . '</a><br>';
				echo '<a href="faq.php?lang=' . $lang['code'] . '">' . $lang['cont_faq'] . '</a><br>';
			?>
		</span>
	</body>
</html>
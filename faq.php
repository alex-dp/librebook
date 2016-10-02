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

		<div class="center very-big">
			<font color="powderblue">
				<?php echo $lang['faq']; ?>
			</font>
		</div>

		<?php
			$addrs = array('1JRwqG9Lz9aeWcspHjxKJtSQ8mm3NTGVKa',
					'12L1d8iJ41rJA9cw2uPgwYmL7Kot3xnSmk',
					'1KZVbWygkxbnYCd2dmwuDSuGnnD1MUEc4k',
					'1NRhS9YmLAQGm7uBkDuEec2i11V8KYRKZa',
					'1BZzQNun8wDhSct2rmjBoiyY8PQG5XPsWf',
					'15EeGc6NqFBEfqfnAdxKjxAaAMCWBzSMPj');

			end($lang['questions']);
			$lang['questions'][key($lang['questions'])] .= 
				(" <code>" . $addrs[rand(0, count($addrs) - 1)] . "</code>");

			foreach ($lang['questions'] as $q => $a) {
				echo '<h3 class="q">' . $q . '</h3>';
				echo '<blockquote>' . $a . '</blockquote>';
			}
		?>

		<span class="bt-r footnote" id="foot">
			<a href="https://github.com/deeepaaa/librebook">
				DP Development 2016<br>GNU GPL3
			</a>
		</span>
	</body>
</html>
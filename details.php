<?php
include_once 'tools.php';
$lang = get_lang($_GET['lang'], $_SERVER['HTTP_ACCEPT_LANGUAGE']);

$un_id = $_GET['un_id'];
$title = "";
$subj = "";
$class = "";
$isbn = "";
$dl = "";

$pw_loc = "/home/dpdep/private/pw.txt";
$password = trim(fread(fopen($pw_loc, "r"), filesize($pw_loc)));

$dbh = mysqli_connect('localhost', 'dpdep', $password);

if (!$dbh)
    die("Connection failed: " . mysqli_connect_error());

$res = $dbh -> query("use book_entries");
$sql = "SELECT * FROM books WHERE un_id=$un_id;";

$res = $dbh -> query($sql);

foreach ($res as $row) {
	if(isset($_GET['isbn']) && $_GET['isbn'] != '')
		$isbn = $_GET['isbn'];
	$title = $row['title'];
	$subj = $row['subj'];
	$class = $row['class'];
	$isbn = $row['isbn'];
	$dl = $row['file_loc'];
}
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

		<div class="container">
			<h2 class="q">
				<?php echo $title; ?>
			</h2>
			<p class="note">
				<?php echo $subj . ' - ' . ($lang['classes'][$class] ?: end($lang['classes'])); ?>
			</p>
			<?php echo $isbn != '' ? "ISBN: " . $isbn . '<br>' : '' ?>
			<?php echo $lang['dl'] . ': <a href = "https://uploads.librebook.xyz/' . $dl . "\">({$lang['here']})</a></td>\n"; ?>
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
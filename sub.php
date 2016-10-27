<?php
setcookie("upload", 1, time() + 60);
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

<?php

$file_name = basename($_FILES["file_loc"]["name"]);
$target_file = "/home/dpdep/uploads/" . $file_name;
$go = 1;
$ft = pathinfo($target_file, PATHINFO_EXTENSION);

$isbn = str_replace(array('-', ' '), '', $_POST['isbn']);
$title = substr($_POST['title'], 0, 255);
$subj = substr($_POST['subj'], 0, 255);

end($lang['classes']);
$class = $_POST['class'] ?: key($lang['classes']);

if(!in_array($ft, $val_ext)) {
	echo "{$lang['not_ebook']}<br>";
	$go = 0;
}

if (!is_numeric($isbn) || !in_array(strlen($isbn), array(10,13))) {
	echo "{$lang['wrong_isbn']}<br>";
	$isbn = '';
}

if (strlen($target_file) >= 200)
	$target_file = substr(str_replace($ft, "", $target_file), 0, 180) . ".$ft";

while (file_exists($target_file))
    $target_file = str_replace($ft, "", $target_file) . rand() . ".$ft";

if ($_FILES["file_loc"]["size"] > 50000000) {
    echo $lang['too big'] . "<br>";
    $go = 0;
} elseif ($_FILES["file_loc"]["size"] < 500) {
    echo '<font color="red">' . $lang['spam'] . '</font><br>';
    $go = 0;
}

if (startsWith($isbn, '1111') || startsWith($isbn, '0000') ||
		startsWith($isbn, '1234') || strtoupper($title) == $title ||
		startsWith(strtolower($_FILES["file_loc"]["name"]), 'ebook') ||
		isset($_GET['filter'])) {

	echo '<font color="red">' . $lang['spam'] . '</font><br>';
	$go = 0;
}

if (isset($_COOKIE['upload']) && $_COOKIE['upload'] == 1) {
	echo '<font color="red">' . $lang['wait'] . '</font><br>';
	$go = 0;
}

if ($go == 0)
    echo $lang['not_uploaded'] . "<br>";
else {
    if (move_uploaded_file($_FILES["file_loc"]["tmp_name"], $target_file)) {
        echo "{$lang['your_file']} ". $file_name . " {$lang['was_uploaded']}.<br>";

        $servername = "localhost";
		$username = "dpdep";
		$pw_loc = "/home/dpdep/private/pw.txt";
		$password = trim(fread(fopen($pw_loc, "r"), filesize($pw_loc)));

		$dbh = mysqli_connect($servername, $username, $password);

		$title = $dbh -> real_escape_string($title);
		$subj = $dbh -> real_escape_string($subj);
		$class = $dbh -> real_escape_string($class);
		$file_name = $dbh -> real_escape_string($file_name);

		if (!$dbh)
		    die("Connection failed: " . mysqli_connect_error() . "<br>");
		
		mysqli_query($dbh, "USE book_entries;");

		$sql = "INSERT INTO books (isbn, title, subj, class, file_loc)
		VALUES ('$isbn', '$title', '$subj', '$class', '$file_name');";

		if ($dbh->query($sql) !== TRUE)
		    echo "{$lang['ins_error']}<br>
				{$lang['already_there']}<br><br>
				{$lang['send_details']}<br>
				<b>SQL: </b>" . $sql . "<br>
				<b>E: </b>" . $dbh->error;

		$dbh->close();
    } else echo "{$lang['load_error']}<br>";
}

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
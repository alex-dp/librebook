<html>
<head>
	<title>Libre-book</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="UTF-8">
</head>
<body>

<div class="center title" id="title">
    libr<font color="CadetBlue">e-book</font>
</div>

<div class="center big">

<?php

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file_loc"]["name"]);
$uploadOk = 1;
$ft = pathinfo($target_file, PATHINFO_EXTENSION);
$val_ext = array("zip", "epub", "pbd", "fb2", "pdf");

$isbn = substr($_POST['isbn'], 0, 13);
$title = substr($_POST['title'], 0, 30);
$subj = substr($_POST['subj'], 0, 30);
$class = $_POST['class'];

$strip = array("'", "(", ")", ";");

$title = str_replace($strip, "", $title);
$subj = str_replace($strip, "", $subj);

if(isset($_POST["submit"]) && !in_array($ft, $val_ext)) {
	echo "Il file che stai cercando di caricare non sembra essere un ebook.<br>";
	$uploadOk = 0;
}

if (!is_numeric($isbn) || strlen($isbn) != 13) {
	echo "L'ISBN che hai fornito non è corretto.<br>";
	$uploadOk = 0;
}

while (file_exists($target_file))
    $target_file = str_replace($ft, "", $target_file) . rand() . ".{$ft}";

if ($_FILES["file_loc"]["size"] > 500000000) {
    echo "Carica un file più piccolo di 500MB.<br>";
    $uploadOk = 0;
}

if ($uploadOk == 0)
    echo "Il tuo file non è stato caricato.<br>";
else {
    if (move_uploaded_file($_FILES["file_loc"]["tmp_name"], $target_file)) {
        echo "Il file ". basename($_FILES["file_loc"]["name"]). " è stato caricato.<br>";

        $servername = "localhost";
		$username = "dpdep";
		$password = fread(fopen("pw.txt", "r"), filesize("pw.txt"));
		$password = substr($password, 0, 11);

		$conn = mysqli_connect($servername, $username, $password);

		if (!$conn)
		    die("Connection failed: " . mysqli_connect_error() . "<br>");

		$sql = "USE book_entries;";
		mysqli_query($conn, $sql);

		$sql = "CREATE TABLE books (
			isbn VARCHAR(13) NOT NULL PRIMARY KEY,
			title VARCHAR(30) NOT NULL,
			subj VARCHAR(30) NOT NULL,
			class VARCHAR(2),
			file_loc VARCHAR(200),
			pic_loc VARCHAR(200),
			up_time TIMESTAMP
		)";

		if (!mysqli_query($conn, $sql)); #table exists

		$sql = "INSERT INTO books (isbn, title, subj, class, file_loc)
		VALUES ('{$isbn}', '{$title}', '{$subj}', '{$class}', '{$target_file}');";

		if ($conn->query($sql) !== TRUE)
		    echo "Error: " . $sql . "<br>" . $conn->error;

		$conn->close();
    } else echo "C'è stato un errore nel caricamento.<br>";
}

?>

</div>

<span class="bt-r footnote" id="foot">
	DP Development 2016<br>GNU GPL3
</span>

<script src="submit_book.js"></script>

</body>
</html>
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

<?php

$go = 1;

$servername = "localhost";
$username = "dpdep";
$password = fread(fopen("pw.txt", "r"), filesize("pw.txt"));
$password = substr($password, 0, 11);

$isbn = $_GET['isbn'];

if ((!is_numeric($isbn) || strlen($isbn) != 13) && $isbn != "all") {
    echo "<div class=\"big\">L'ISBN che hai fornito non è corretto.<br></div>";
    $go = 0;
}

$conn = mysqli_connect($servername, $username, $password);

if (!$conn)
    die("Connection failed: " . mysqli_connect_error());

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

if ($isbn === 'all')
    $sql = "SELECT * FROM books";
else
    $sql = "SELECT * FROM books WHERE isbn='" . $isbn . "';";

$result = NULL;
if($go == 1)
    $result = $conn->query($sql);

if (!is_null($result) && $result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

        echo "<table>";
        echo "<tr><th>ISBN:</th><td>" . $row["isbn"] . "</td>";
        echo "<tr><th>Titolo:</th><td>" . $row["title"] . "</td>";
        echo "<tr><th>Materia:</th><td>" . $row["subj"] . "</td>";
        echo "<tr><th>Classe:</th><td>" . $row["class"] . "</td>";
        echo "<tr><th>Download:</th><td>" . "<a href = \"http://librebook.xyz/{$row["file_loc"]}\">(qui)</a></td>";
        echo "<tr><th>Data:</th><td>" . $row["up_time"] . "</td>";

        echo "</table><br>";
    }
} else echo "<div class=\"big\">Nessun risultato.</div>";

$conn->close();

?>

<span class="bt-r footnote" id="foot">
    DP Development 2016<br>GNU GPL3
</span>

<script src="submit_book.js"></script>

</body>
</html>
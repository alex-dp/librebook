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

<?php

$go = 1;

$servername = "localhost";
$username = "dpdep";
$pw_loc = "/home/dpdep/private/pw.txt";
$password = fread(fopen($pw_loc, "r"), filesize($pw_loc));
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
    $sql = "SELECT * FROM books WHERE isbn='{$isbn}';";

$result = NULL;
if($go == 1)
    $result = $conn->query($sql);

if (!is_null($result) && $result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

        echo "<table class=\"fixed-width\">";
        echo "<tr><th>ISBN:</th><td>" . $row["isbn"] . "</td>";
        echo "<tr><th>Titolo:</th><td>" . $row["title"] . "</td>";
        echo "<tr><th>Materia:</th><td>" . $row["subj"] . "</td>";
        echo "<tr><th>Classe:</th><td>" . $row["class"] . "</td>";
        echo "<tr><th>Download:</th><td>" . "<a href = \"http://librebook.xyz/{$row["file_loc"]}\">(qui)</a></td>";

        echo "</table><br>";
    }
} else echo "<div class=\"big\">Nessun risultato.</div>";

if (isset($_GET['rm']))
    $rm = $_GET['rm'];
if (isset($_GET['pw']))
    $pw = $_GET['pw'];

if (isset($rm) && is_numeric($rm) && isset($pw) && $pw == $password) {
    $sql = "SELECT * FROM books WHERE isbn='{$rm}';";

    $result = $conn->query($sql);

    if (!is_null($result) && $result->num_rows > 0)
        while($row = $result->fetch_assoc())
            unlink(dirname(__FILE__) . "/" . $row["file_loc"]);

    $sql = "DELETE FROM books WHERE isbn={$rm};";

    if($conn->query($sql))
        echo "La richiesta di rimozione del libro {$rm} è stata eseguita.";

} else if (isset($rm) && !isset($pw))
    echo "Serve una password per rimuovere un libro!";

else if (isset($pw) && $pw != $password)
    echo "La password è errata!";

$conn->close();

?>

<span class="bt-r footnote" id="foot">
    DP Development 2016<br>GNU GPL3
</span>

<span class="bt-l footnote">
    <a href="faq.html">FAQ</a><br>
    <a href="contatti.html">Contatti</a>
</span>

<script src="main.js"></script>

</body>
</html>
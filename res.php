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

<?php

$go = 1;

$servername = "localhost";
$username = "dpdep";
$pw_loc = "/home/dpdep/private/pw.txt";
$password = fread(fopen($pw_loc, "r"), filesize($pw_loc));
$password = trim($password);

$search = str_replace('-', '', $_GET['search']);

$conn = mysqli_connect($servername, $username, $password);

if (!$conn)
    die("Connection failed: " . mysqli_connect_error());

$sql = "USE book_entries;";
mysqli_query($conn, $sql);

if ($search === 'all')
    $sql = "SELECT * FROM books";
else
    $sql = "SELECT * FROM books WHERE isbn='$search' OR title LIKE '%$search%' OR subj LIKE '%$search%';";

$result = NULL;
if($go == 1)
    $result = $conn->query($sql);

echo '<div class="center">';
echo ($result->num_rows ?: 0) . ' ' . $lang['results'];
echo '</div><br>';

if (!is_null($result) && $result->num_rows > 0)

    while($row = $result->fetch_assoc()) {

        echo "<table class=\"fixed-width\">";
        echo "<tr><th>ISBN:</th><td>" . $row["isbn"] . "</td>";
        echo "<tr><th>{$lang['title']}:</th><td><p class=\"fix-td\">" . $row["title"] . "</p></td>";
        echo "<tr><th>{$lang['subject']}:</th><td>" . $row["subj"] . "</td>";
        echo "<tr><th>{$lang['grade']}:</th><td>" . ($lang['classes'][$row['class']] ?: end($lang['classes'])) . "</td>";
        echo "<tr><th>{$lang['dl']}:</th><td>" . "<a href = \"{$row['file_loc']}\">({$lang['here']})</a></td>";

        echo "</table><br>";
    }

if (isset($_GET['rm']) && isset($_GET['pw'])) {
    $rm = $_GET['rm'];
    $pw = $_GET['pw'];

    if (is_numeric($rm) && $pw == $password) {
        $sql = "SELECT file_loc FROM books WHERE isbn='$rm';";

        $result = $conn->query($sql);

        if (!is_null($result) && $result->num_rows > 0)
            while($row = $result->fetch_assoc())
                unlink(dirname(__FILE__) . "/" . $row["file_loc"]);

        $sql = "DELETE FROM books WHERE isbn=$rm;";

        if($conn->query($sql))
            echo "{$lang['rem_req']} $rm {$lang['was_exec']}.";

    }
}

if (isset($rm) && !isset($pw))
    echo $lang['need_pass'];

if (isset($pw) && $pw != $password)
    echo $lang['wrong_pass'];

$conn->close();

?>

<span class="bt-r footnote" id="foot">
    <a href="https://github.com/deeepaaa/librebook">
        DP Development 2016<br>GNU GPL3
    </a>
</span>

<span class="bt-l footnote">
    <?php
        echo '<a href="res.php?lang=' . $locale . '">' . $lang['index'] . '</a><br>';
        echo '<a href="faq.php?lang=' . $locale . '">' . $lang['cont_faq'] . '</a><br>';
    ?>
</span>
</body>
</html>
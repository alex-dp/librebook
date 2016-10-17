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

<div class="center">
    <form action="res.php" autocomplete="off">
        <?php
            echo '<input type="text" class="tbox" placeholder="' . $lang["search"] . '" name="search"/>';
        ?>
    </form>
</div>

<?php

$pw_loc = "/home/dpdep/private/pw.txt";
$password = trim(fread(fopen($pw_loc, "r"), filesize($pw_loc)));

$dbh = mysqli_connect('localhost', 'dpdep', $password);

if (!$dbh)
    die("Connection failed: " . mysqli_connect_error());

$dbh -> query('USE book_entries;');
$search = $dbh -> real_escape_string($_GET['search']);

$sql = "SELECT * FROM books WHERE isbn = '$search' OR title LIKE '%$search%' OR subj LIKE '%$search%';";

$res = $dbh -> query($sql);

echo '<div class="center">';
echo $res -> num_rows . ' ' . ($res -> num_rows == 1 ? $lang['result'] : $lang['results']);
echo '</div><br>';

foreach ($res as $row) {
    echo "<table class=\"fixed-width\">\n";
    if(isset($row['isbn']) && $row['isbn'] != '')
        echo '<tr><th>ISBN:</th><td>' . $row['isbn'] . "</td>\n";
    echo "<tr><th>{$lang['title']}:</th><td><p class=\"fix-td\">" . htmlspecialchars($row['title']) . "</p></td>\n";
    echo "<tr><th>{$lang['subject']}:</th><td>" . htmlspecialchars($row["subj"]) . "</td>\n";
    echo "<tr><th>{$lang['grade']}:</th><td>" . ($lang['classes'][$row['class']] ?: end($lang['classes'])) . "</td>\n";
    echo "<tr><th onclick=\"alert({$row['un_id']})\">{$lang['dl']}:</th><td>" . '<a href = "https://uploads.librebook.xyz/' . $row['file_loc'] . "\">({$lang['here']})</a></td>\n";

    echo "</table><br>\n\n";
}

if (isset($_GET['rm']) && isset($_GET['pw'])) {
    $rm = $_GET['rm'];
    $pw = $_GET['pw'];

    if (is_numeric($rm) && $pw == $password) {
        $sql = "SELECT file_loc FROM books WHERE un_id=$rm;";

        $res = $dbh->query($sql);

        foreach ($res as $row)
            rename('/home/dpdep/uploads/' . $row['file_loc'], '/home/dpdep/uploads/del/' . $row['file_loc']);

        $sql = "DELETE FROM books WHERE un_id = $rm;";

        if($dbh -> query($sql))
            echo "{$lang['rem_req']} $rm {$lang['was_exec']}.";

    }
}

if (isset($rm) && !isset($pw))
    echo $lang['need_pass'];

if (isset($pw) && $pw != $password)
    echo $lang['wrong_pass'];

$dbh->close();

?>

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
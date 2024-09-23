<?php
    $cwd = getcwd();

    if (isset($_GET["cwd"])) {
        $cwd = $_GET["cwd"];
    }

    $all = scandir($cwd);
    $all = array_slice($all, 2);

    foreach ($all as $a) {
        $new_cwd = $cwd . DIRECTORY_SEPARATOR . $a;
        if (is_dir($new_cwd)) {
            echo '[D] <a href="index.php?cwd=' . $new_cwd . '">' . $a . "</a><br>";
        } else {
            echo '[F] <a href="index.php?file=' . $a . '">' . $a . "</a><br>";
        }
    }
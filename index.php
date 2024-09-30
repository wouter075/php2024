<?php
function human_filesize($bytes, $decimals = 2) {
    $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

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
        $new_cwd = dirname($new_cwd);
        echo '[F] <a href="index.php?file=' . $a . '&cwd=' . $new_cwd . '">' . $a . "</a><br>";
    }
}

if (isset($_GET["file"])) {
    $file = $_GET["file"];
//    echo "Hoera! Dit werkt, ik ben goeeeeeed!";

    $location = $cwd . DIRECTORY_SEPARATOR . $file;
    $bytes = filesize($location);
    $modified = filemtime($location);
    $mime = explode("/", mime_content_type($location))[0];



    echo "File: " . $file . "<br>";
    echo "Size: " . human_filesize($bytes) . "<br>";

    if (is_writeable($location)) {
        echo "Writable: Yes<br>";
    } else {
        echo "Writable: No<br>";
    }

    echo "Modified: " . date("j-m-Y @ H:i:s", $modified) . "<br>";

//    echo "Mime:" . explode("/", $mime)[0] . "<br>";
    if ($mime == "text") {
        echo '<textarea>' . htmlentities(file_get_contents($location)) . '</textarea>';
    }

}   







<?php
include_once("init.php");
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT supplier_name FROM supplier_details WHERE supplier_name LIKE '%$q%'");
while ($line = $db->fetchNextObject()) {

    if (strpos(strtolower($line->supplier_name), $q) !== false) {
        echo "$line->supplier_name\n";

    }
}

?>
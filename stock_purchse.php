<?php
include_once("init.php");
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT stock_name FROM stock_details WHERE stock_name LIKE '%$q%'");
while ($line = $db->fetchNextObject()) {
        echo "$line->stock_name\n";
}
?>
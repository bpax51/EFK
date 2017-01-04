<?php
include_once("init.php");
$q = strtolower($_GET["q"]);
if (!$q) return;
$db->query("SELECT distinct name FROM stock_avail where name like '%$q%' AND quantity > 0");
while ($line = $db->fetchNextObject()) {
        echo "$line->name\n";
}
?>
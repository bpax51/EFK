<?php
include_once("init.php");

$line = $db->queryUniqueObject("SELECT stock_id FROM stock_details  WHERE stock_name ='" . $_POST['stock_name1'] . "'");
$stock_id = $line->stock_id;
//$line = $db->queryUniqueObject("SELECT sum(quantity) as quantity FROM stock_avail  WHERE name ='" . $_POST['stock_name1'] . "' GROUP BY name");
//$stock = $line->quantity;
$query = "SELECT sum(quantity) as quantity FROM stock_avail  WHERE name ='" . $_POST['stock_name1'] . "' GROUP BY name";
$stock = mysqli_fetch_array(mysqli_query($db->connection, $query));
$stock = $stock['quantity'];
if ($stock=="") {
    $stock = "N/A";
}
if ($line != NULL) {

    $arr = array("stock" => "$stock", "guid" => $stock_id);
    echo json_encode($arr);

} else {
    $arr1 = array("no" => "no");
    echo json_encode($arr1);
}
?>
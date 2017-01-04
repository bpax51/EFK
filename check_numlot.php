<?php
include_once("init.php");

$line = $db->queryUniqueObject("SELECT count(*) as nTot FROM stock_entries  WHERE stock_name ='" . $_POST['item'] . "' AND numLot ='" . $_POST['numlot'] . "' and type='entry'");
$count = $line->nTot;

if ($line != NULL) {
    if ($count > 0) {
        $arr = array("exists" => true);
    }else{
        $arr = array("exists" => false);
    }
    echo json_encode($arr);
} else {
    $arr1 = array("no" => "no");
    echo json_encode($arr1);
}
?>
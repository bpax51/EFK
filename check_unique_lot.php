<?php
include_once("init.php");

$line = $db->queryUniqueObject("SELECT count(*) as nTot FROM stock_entries  WHERE numLot ='" . $_POST['numLot'] . "' and type='entry'");
$nTot = $line->nTot;
/*$line = $db->queryUniqueObject("SELECT * FROM stock_avail  WHERE name ='" . $_POST['stock_name1'] . "'");
$stock = $line->quantity;*/

if ($line != NULL) {
    if ($nTot > 0) {
        $arr = array("nTot" => "$nTot", "unik" => false);
    }else{
        $arr = array("nTot" => "$nTot", "unik" => true);
    }
    echo json_encode($arr);
} else {
    $arr1 = array("no" => "no");
    echo json_encode($arr1);
}
?>
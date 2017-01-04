<?php
include_once("init.php");// Use session variable on this page. This function must put on the top of page.
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') { // if session variable "username" does not exist.
    header("location: index.php?msg=Merci%20de%20vous%20identifier%20pour%20accéder%20à%20cette%20interface!"); // Re-direct to index.php
} else {
    if (isset($_GET['from_sales_date']) && isset($_GET['to_sales_date']) && $_GET['from_sales_date'] != '' && $_GET['to_sales_date'] != '') {
        $selected_date = $_GET['from_sales_date'];
        $selected_date = strtotime($selected_date);
        $mysqldate = date('Y-m-d H:i:s', $selected_date);
        $fromdate = $mysqldate;
        $selected_date = $_GET['to_sales_date'];
        $selected_date = strtotime($selected_date);
        $mysqldate = date('Y-m-d H:i:s', $selected_date);
        $todate = $mysqldate;
        ?>
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">
        <html>
        <head>
            <title>Rapport Des Sorties</title>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        </head>
        <style type="text/css" media="print">
            .hide {
                display: none
            }
        </style>
        <script type="text/javascript">
            function printpage() {
                document.getElementById('printButton').style.visibility = "hidden";
                window.print();
                document.getElementById('printButton').style.visibility = "visible";
            }
        </script>
        <body>
        <input name="print" type="button" value="Print" id="printButton" onClick="printpage()">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center">
                    <div align="right">
                        <?php $line4 = $db->queryUniqueObject("SELECT * FROM store_details ");
                        ?>
                        <strong><?php echo $line4->name; ?></strong><br/>
                        <?php echo $line4->address; ?>,<?php echo $line4->place; ?>, <br/>
                        <?php echo $line4->city; ?>,<?php echo $line4->pin; ?><br/>
                        Website<strong>:<?php echo $line4->web; ?></strong><br>Email<strong>:<?php echo $line4->email; ?></strong><br/>Phone
                        <strong>:<?php echo $line4->phone; ?></strong>
                        <br/>
                        <?php ?>
                    </div>
                    <table width="595" border="0" cellspacing="0" cellpadding="0">

                        <tr>
                            <td height="30" align="center" style="font-size:20px;"><strong>Rapport des Sorties </strong></td>
                        </tr>
                        <tr>
                            <td height="30" align="center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="300" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="300"><strong>Nombre Total De Sorties Uniques : <?php echo $age = $db->queryUniqueValue("SELECT count(*) FROM sorties where date BETWEEN '$fromdate' AND '$todate' "); ?></strong></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td width="45">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td height="20">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="45"><strong>De</strong></td>
                                        <td width="393">&nbsp;<?php echo $_GET['from_sales_date']; ?></td>
                                        <td width="41"><strong>à</strong></td>
                                        <td width="116">&nbsp;<?php echo $_GET['to_sales_date']; ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td width="45">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><strong>Date</strong></td>
                                        <td><strong>Sortie </strong></td>
                                        <td><strong>Commercial</strong></td>
                                        <td><strong>Article</strong></td>
                                        <td><strong>n° LOT</strong></td>
                                        <td><strong>Quantité</strong></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php
                                    $result = $db->query("SELECT e.id_sortie as sortie, e.date as date,e.commercial as commercial,s.stock_name as name, s.quantity as quantity,s.numLot as numLot FROM sorties e INNER JOIN stock_sales s ON e.id_sortie=s.transactionid where e.date BETWEEN '$fromdate' AND '$todate' ORDER BY e.date ASC, e.id_sortie ASC");
                                    while ($line = $db->fetchNextObject($result)) {
                                        ?>

                                        <tr>
                                            <td><?php $mysqldate = $line->date;
                                                $phpdate = strtotime($mysqldate);
                                                $phpdate = date("d/m/Y", $phpdate);
                                                echo $phpdate; ?></td>
                                            <td><?php echo $line->sortie; ?></td>
                                            <td><?php echo $line->commercial; ?></td>
                                            <td><?php echo $line->name; ?></td>
                                            <td><?php echo $line->numLot; ?></td>
                                            <td><?php echo $line->quantity; ?></td>
                                        </tr>


                                        <?php
                                    }
                                    ?>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        </body>
        </html>
        <?php
    } else
        echo "Veuillez choisir d'abord une periode !";
}
?>
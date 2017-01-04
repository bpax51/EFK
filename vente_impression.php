<?php
include_once("init.php");  // Use session variable on this page. This function must put on the top of page.
if(!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin'){ // if session variable "username" does not exist.
    header("location: index.php?msg=Merci%20de%20vous%20identifier%20pour%20accéder%20à%20cette%20interface!"); // Re-direct to index.php
}
else
{
if(isset($_GET['sid']))
{
//echo $_GET['sid'];
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>Impression des Ventes</title>
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
    <style type="text/css">
        <!--
        .style1 {
            font-size: 10px
        }

        -->
    </style>
     <?php include_once("tpl/common_js.php"); ?>
    <script>
        $(document).ready(function(){
           jQuery(document).bind('keydown', 'return',function() {
              window.close();
        });
        });
     </script>
</head>

    <body>
    <input name="print" type="button" class="hide" value="Print" id="printButton" onClick="printpage()">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center" valign="top">

            <table width="595" cellspacing="0" cellpadding="0" id="bordertable" border="1">
                <tr>
                    <td align="center"><strong>Reçu de Ventes <br/>
                        </strong>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="67%" align="left" valign="top">&nbsp;&nbsp;&nbsp;Date: <?php
                                    $sid = $_GET['sid'];
                                    $line = $db->queryUniqueObject("SELECT * FROM stock_sales WHERE transactionid='$sid' ");

                                    $mysqldate = $line->date;

                                    $phpdate = strtotime($mysqldate);

                                    $phpdate = date("d/m/Y", $phpdate);
                                    echo $phpdate;
                                    ?> <br/>
                                    <br/>
                                    <strong><br/>
                                        &nbsp;&nbsp;&nbsp;n° de Sortie: <?php echo $sid;

                                        ?> </strong><br/></td>
                                <td width="33%">
                                    <div align="center">
                                        <?php $line4 = $db->queryUniqueObject("SELECT * FROM store_details ");
                                        ?>
                                        <strong><?php echo $line4->name; ?></strong><br/>
                                        <?php echo $line4->address; ?>,<?php echo $line4->place; ?>, <br/>
                                        <?php echo $line4->city; ?>,<?php echo $line4->pin; ?><br>Email<strong>:<?php echo $line4->email; ?></strong><br/>TEL
                                        <strong>:<?php echo $line4->phone; ?></strong>
                                        <br/>
                                        <?php ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="90" align="left" valign="top"><br/>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="5%" align="left" valign="top"><strong>&nbsp;&nbsp;Commercial:</strong></td>
                                <td width="95%" align="left" valign="top"><br/>
                                    <?php
                                    $line9 = $db->queryUniqueObject("SELECT * FROM sales WHERE id_sortie='$sid'");
                                    $cname = $line9->commercial;
                                    echo $cname;
                                    $line2 = $db->queryUniqueObject("SELECT * FROM customer_details WHERE customer_name='$cname' ");
                                    echo $line2->customer_address;
                                    ?>
                                    <br/>
                                    <?php
                                    echo "Contact1: " . $line2->customer_contact1 . "<br>";
                                    ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="12%" align="center" bgcolor="#CCCCCC"><strong>No.</strong></td>
                                <td width="22%" bgcolor="#CCCCCC"><strong>Article</strong></td>
                                <td width="22%" bgcolor="#CCCCCC"><strong>n° de Lot</strong></td>
                                <td width="11%" bgcolor="#CCCCCC">&nbsp;</td>
                                <td width="18%" bgcolor="#CCCCCC"><strong>Quantité Vendue</strong></td>
                            </tr>

                            <tr>
                                <td align="center">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <?php
                            $i = 1;
                            $db->query("SELECT * FROM sales_details where id_sortie='$sid'");
                            while ($line3 = $db->fetchNextObject()) {
                                ?>
                                <tr>
                                    <td align="center"><?php echo $i . "."; ?></td>
                                    <td><?php echo $line3->stock_name; ?></td>
                                    <td><?php echo $line3->numLot; ?></td>
                                    <td>&nbsp;</td>
                                    <td><?php echo $line3->quantity; ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="82%" align="right" bgcolor="#CCCCCC"><strong>&nbsp;&nbsp;</strong>
                                </td>
                                <td width="18%" bgcolor="#CCCCCC">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="82%" align="right" bgcolor="#CCCCCC"><strong>&nbsp;&nbsp;</strong>
                                </td>
                                <td width="18%" bgcolor="#CCCCCC">&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="82%" align="right" bgcolor="#CCCCCC"><strong>&nbsp;&nbsp;</strong>
                                </td>
                                <td width="18%" bgcolor="#CCCCCC">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="33%" align="left" valign="top"><br/>
                                    </td>
                                <td width="67%" align="right">
                                    Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <br/>
                                    <br/>
                                    <br/>
                                    </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" bgcolor="#CCCCCC">Merci : <?php date_default_timezone_set("Africa/Casablanca"); echo date('Y/m/d H:i:s'); ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>


</body>
</html>
<?php
}
else "Error in processing printing the sales receipt";
}
?>
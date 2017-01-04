<?php
include_once("init.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Azul - Ajout Sortie</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="js/date_pic/date_input.css">
    <link rel="stylesheet" href="lib/auto/css/jquery.autocomplete.css">
    <!-- Optimize for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- jQuery & JS files -->
    <?php include_once("tpl/common_js.php"); ?>
    <script src="js/script.js"></script>
    <script src="js/date_pic/jquery.date_input.js"></script>
    <script src="lib/auto/js/jquery.autocomplete.js "></script>
    <script src="js/add_sales.js"></script>
</head>
<body>
<!-- TOP BAR -->
<?php include_once("tpl/top_bar.php"); ?>
<!-- end top-bar -->
<!-- HEADER -->
<div id="header-with-tabs">
    <div class="page-full-width cf">
        <ul id="tabs" class="fl">
            <li><a href="dashboard.php" class="dashboard-tab">Dashboard</a></li>
            <li><a href="view_purchase.php" class="purchase-tab">Entrées</a></li>
            <li><a href="view_sales.php" class="active-tab  sales-tab">Sorties</a></li>
            <li><a href="add_retour.php" class="retours-tab">Retours</a></li>
            <li><a href="view_customers.php" class=" customers-tab">Commerciaux</a></li>
            <li><a href="view_supplier.php" class=" supplier-tab">Fournisseurs</a></li>
            <li><a href="view_product.php" class="stock-tab">Stocks / Articles</a></li>
            <li><a href="view_report.php" class="report-tab">Rapports</a></li>
        </ul>
        <!-- end tabs -->
        <!-- Change this image to your own company's logo -->
        <!-- The logo will automatically be resized to 30px height. -->
        <a href="#" id="company-branding-small" class="fr"><img src="<?php if (isset($_SESSION['logo'])) {
                echo "upload/" . $_SESSION['logo'];
            } else {
                echo "upload/posnic.png";
            } ?>" alt="Azul Fish"/></a>

    </div>
    <!-- end full-width -->
</div>
<!-- end header -->
<!-- MAIN CONTENT -->
<div id="content">

    <div class="page-full-width cf">

        <div class="side-menu fl">

            <h3>Gestion De Sorties</h3>
            <ul>
                <li><a href="add_sales.php">Ajout Sortie</a></li>
                <li><a href="view_sales.php">Voir Sorties</a></li>
            </ul>
        </div>
        <!-- end side-menu -->


        <div class="side-content fr">

            <div class="content-module">

                <div class="content-module-heading cf">

                    <h3 class="fl">Ajout Sortie</h3>
                    <span class="fr expand-collapse-text">Cliquez pour réduire</span>
                    <span class="fr expand-collapse-text initial-expand">Cliquez pour agrandir</span>

                </div>
                <!-- end content-module-heading -->

                <div class="content-module-main cf">
                    <?php
                    //Gump is libarary for Validatoin
                    /*if (isset($_GET['msg'])) {
                        echo $_GET['msg'];
                    }*/

                    if (isset($_POST['supplier'])) {
                        $validated_data = $gump->run($_POST);
                        $stock_name     = "";
                        $stockid        = "";
                        $numLot         = "";
                        $quty           = "";
                        if ($validated_data === false) {
                            echo $gump->get_readable_errors(true);
                        } else {
                            $username = $_SESSION['username'];
                            $stockid = mysqli_real_escape_string($db->connection, $_POST['stockid']);
                            $customer = mysqli_real_escape_string($db->connection, $_POST['supplier']);
                            $stock_name = $_POST['stock_name'];
                            $quty = $_POST['quty'];
                            $numLot =$_POST['numLot'];
                            $date = mysqli_real_escape_string($db->connection, $_POST['date']);
                            $description = mysqli_real_escape_string($db->connection, $_POST['description']);
                            $addReturn = false;
                            if (strtolower($customer)=="transfert de depot" OR strtolower($customer)=="ventes depot" OR strtolower($customer)=="dons") {
                                $addReturn = true;
                            }
                            $selected_date = $_POST['date'];
                            $selected_date = strtotime($selected_date);
                            $mysqldate = date('Y-m-d H:i:s', $selected_date);
                            $db->connection->autocommit(FALSE);
                            $db->connection->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
                            $db->query("INSERT INTO sorties (id_sortie,commercial,date,date_added,description,username) VALUES ('".$_POST['stockid']."','$customer','$mysqldate',NOW(), '$description', '$username')");
                            for ($i = 0; $i < count($stock_name); $i++) {
                                $name1 = "";
                                $quantity = "";
                                $count = "";
                                $stock_name[$i] = mysqli_real_escape_string($db->connection, $stock_name[$i]);
                                $numLot[$i] = mysqli_real_escape_string($db->connection, $numLot[$i]);
                                $quty[$i] = mysqli_real_escape_string($db->connection, $quty[$i]);
                                $name1 = $stock_name[$i];
                                $quantity = $_POST['quty'][$i];
                                $count = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name1' AND numLot = '$numLot[$i]'");
                                //a essayer darooori
                                if ((float)$count >= (float)$quantity) {
                                    $db->query("INSERT INTO stock_sales (transactionid,stock_name,numLot,quantity,date,count1) VALUES ('".$_POST['stockid']."','$name1','".$numLot[$i]."','$quantity','$mysqldate',$i+1)");
                                    $amount = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name1' AND numLot='$numLot[$i]'");
                                    $amount1 = $amount - $quantity;
                                    $db->execute("UPDATE stock_avail SET quantity='$amount1' WHERE name='$name1' AND numLot='$numLot[$i]'");
                                    if ($addReturn) {
                                        if (!$db->query("INSERT INTO sales_details(id_sortie,stock_name,numLot, quantity) VALUES ( '".$_POST['stockid']."','$name1', '$numLot[$i]' ,$quantity)")){
                                                $db->connection->rollback();
                                                echo "<div class='error-box round'>Erreur Ref : 50</div>";
                                                exit();
                                                }
                                    }
                                } else {
                                    $db->connection->rollback();
                                    echo "<div class='error-box round'>Le stock de $name1 est insuffisant !</div>";
                                    exit();
                                }
                            }
                            if ($addReturn) {
                                        if (!$db->query("INSERT INTO sales(id_sortie,commercial,date,date_retour,date_added,username,auto) VALUES ( '".$_POST['stockid']."','$customer', '$mysqldate','$mysqldate' ,NOW(),'$username',1)")){
                                            $db->connection->rollback();
                                            echo "<div class='error-box round'>Erreur Ref : 40</div>";
                                            exit();
                                                }
                                    }
                            $db->connection->commit();
                            $db->connection->autocommit(true);
                            echo "<div class='confirmation-box round'>Sortie ajouté avec succès Ref: <span style='cursor:pointer;font-weight:bold;color:black;text-decoration: underline;' onclick=\"window.open('add_sales_print.php?sid=".$_POST['stockid']."','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');\">[" . $_POST['stockid'] . "]</span> !</div>";

                            echo "<script>window.open('add_sales_print.php?sid=".$_POST['stockid']."','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');</script>";
                            }
                        }
                    ?>

                    <form name="form1" method="post" id="form1" action="">
                        <input type="hidden" id="posnic_total">

                        <p><strong>Ajout Sortie/Article </strong> - Nouveau ( Controle +2)</p>
                        <table class="form" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <?php //SELECT SUBSTRING(id_sortie, 3) FROM `sorties` WHERE 1
                                $str = $db->query("SELECT id_sortie FROM sorties WHERE substring(id_sortie,3)=(SELECT MAX(CAST(SUBSTRING(id_sortie,3) AS SIGNED)) FROM sorties)");
                                $str = mysqli_fetch_array($str);
                                $str = $str[0];
                                //exit();
                                //substring(test,2)=(SELECT MAX(CAST(SUBSTRING(test,2) AS SIGNED)) FROM testtable);
                            if($str == ''){
                                  $autoid = "SL1";
                                }else{
                                    $lastId = substr($str, 2);
                                    $autoid = "SL".++$lastId;
                                }
                                  ?>
                                <td>No Sortie:</td>
                                <td><input name="stockid" type="text" id="stockid" readonly="readonly" maxlength="200"
                                           class="round default-width-input" style="width:130px "
                                           value="<?php echo $autoid ?>"/></td>
                                <td>Date:</td>
                                <td><input name="date" id="test1" placeholder="" value="<?php echo date('Y/m/d'); ?>" style="margin-left: 15px;width: 100px;"type="text" maxlength="200" class="round default-width-input"/>
                                </td>
                                <td>Commercial:</td>
                                <td><input name="supplier" placeholder="" type="text" id="supplier" value="" maxlength="200" class="round default-width-input" style="width:130px "/>
                                </td>
                            </tr>
                        </table>
                        <input type="hidden" id="guid">
                        <input type="hidden" id="edit_guid">
                        <table class="form">
                            <tr>
                                <td>Article</td>
                                <td>n° Lot</td>
                                <td>Quantité</td>
                                <td>Stock Disponible</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input name="" type="text" id="item" maxlength="200" class="round default-width-input " style="width: 150px"/></td>
                                <td><input name="" type="text" id="numLot" maxlength="200" class="round default-width-input my_with"/></td>
                                <td><input name="" type="text" id="quty" maxlength="200" class="round default-width-input my_with"
                                           onKeyPress="quantity_chnage(event);return numbersonly(event)" onkeyup="unique_check();stock_size();"/></td>
                                <td><input name="" type="text" id="stock" readonly="readonly" maxlength="200" class="round  my_with"/></td>
                                <td> <input type="button" style="width:30px;border:none;height:30px;background:url(images/add_new.png);cursor:pointer" class="round" onclick="addValues2(event);"></td>
                                <td></td>
                            </tr>
                        </table>
                        <div style="overflow:auto ;max-height:300px;  ">
                            <table class="form" id="item_copy_final">

                            </table>
                        </div>
                            <table class="form">
                            <tr>
                                <td>Déscription</td>
                                <td><textarea name="description"></textarea></td>
                                <td> &nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td> &nbsp;</td>
                                <td> &nbsp;</td>
                                <td> &nbsp;</td>
                            </tr>
                        </table>
                        <table class="form">
                            <tr>
                                <td>
                                    <input class="button round blue image-right ic-add text-upper" type="submit"
                                           name="Submit" value="Ajouter" onclick="return checkValid(this);" <?php echo ($_SESSION['username'] != 'nabila')? "disabled":""; ?>>
                                </td>
                                <td> (Controle + S)
                                    </td>
                                <td> &nbsp;</td>
                                <td> <input class="button round red   text-upper" type="reset" id="Reset" name="Reset"
                                           value="Réinitialiser"></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <!-- end content-module-main -->
            </div>
            <!-- end content-module -->
        </div>
    </div>
    <!-- end full-width -->
</div>
<!-- end content -->


<!-- FOOTER -->
<div id="footer">
    <p>
    </p>

</div>
<!-- end footer -->

</body>
</html>
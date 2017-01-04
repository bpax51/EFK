<?php
include_once("init.php");
//date_default_timezone_set("Africa/Casablanca");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Azul - Ajout Entrée</title>
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
        <script type="text/javascript" src="js/add_puchase.js"></script>
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
                    <li><a href="view_purchase.php" class="active-tab purchase-tab">Entrées</a></li>
                    <li><a href="view_sales.php" class="sales-tab">Sorties</a></li>
                    <li><a href="add_retour.php" class="retours-tab">Retours</a></li>
                    <li><a href="view_customers.php" class=" customers-tab">Commerciaux</a></li>
                    <li><a href="view_supplier.php" class=" supplier-tab">Fournisseurs</a></li>
                    <li><a href="view_product.php" class="stock-tab">Stocks / Articles</a></li>
                    <li><a href="view_report.php" class="report-tab">Rapports</a></li>
                </ul>
                <!-- end tabs -->
                <!-- Change this image to your own company's logo -->
                <!-- The logo will automatically be resized to 30px height. -->
                <a href="#" id="company-branding-small" class="fr"><img src="<?php
        if (isset($_SESSION['logo'])) {
            echo "upload/" . $_SESSION['logo'];
        } else {
            echo "upload/posnic.png";
        }
        ?>" alt="Azul Fish"/></a>

            </div>
            <!-- end full-width -->

        </div>
        <!-- end header -->


        <!-- MAIN CONTENT -->
        <div id="content">

            <div class="page-full-width cf">

                <div class="side-menu fl">

                    <h3>Gestion d'Entrées</h3>
                    <ul>
                        <li><a href="add_purchase.php">Ajout Entrée</a></li>
                        <li><a href="view_purchase.php">Voir Entrées </a></li>
                    </ul>

                </div>
                <!-- end side-menu -->

                <div class="side-content fr">
                    <div class="content-module">
                        <div class="content-module-heading cf">
                            <h3 class="fl">Ajout Entrée</h3>
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
                            if (isset($_POST['supplier']) and isset($_POST['stock_name'])) {
                                $_POST = $gump->sanitize($_POST);
                                $gump->validation_rules(array(
                                    'supplier' => 'required|max_len,100|min_len,3'
                                ));
                                $gump->filter_rules(array(
                                    'supplier' => 'trim|sanitize_string|mysqli_escape'
                                ));

                                $validated_data = $gump->run($_POST);
                                $supplier     = "";
                                $purchaseid   = "";
                                $stock_name   = "";
                                $numLot       = "";
                                $dateEcheance = "";
                                $quty        = "";
                                //$bill_no = "";
                                if ($validated_data === false) {
                                    echo $gump->get_readable_errors(true);
                                } else {
                                    $username = $_SESSION['username'];
                                    $purchaseid = mysqli_real_escape_string($db->connection, $_POST['purchaseid']);
                                    //$bill_no = mysqli_real_escape_string($db->connection, $_POST['bill_no']);
                                    $supplier = mysqli_real_escape_string($db->connection, $_POST['supplier']);
                                    //$address = mysqli_real_escape_string($db->connection, $_POST['address']);
                                    //$contact = mysqli_real_escape_string($db->connection, $_POST['contact']);
                                    $stock_name = $_POST['stock_name'];
                                    $numLot =$_POST['numLot'];
                                    $dateEcheance = $_POST['dateEcheance'];
                                    $date = mysqli_real_escape_string($db->connection, $_POST['date']);
                                    $quty = $_POST['quty'];
                                    //$date = date("d M Y h:i A");
                                    $description = mysqli_real_escape_string($db->connection, $_POST['description']);
                                    $autoid1 = $_POST['purchaseid'];
                                    $selected_date = $_POST['date'];
                                    $test=null;
                                    $selected_date = strtotime($selected_date);
                                    /*echo $selected_date;
                                    exit();*/
                                    $date = date('Y-m-d H:i:s', $selected_date);
                                    $db->connection->autocommit(FALSE);
                                    $db->connection->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
                                    $db->query("INSERT INTO entries (id_entrie,supplier_name,date,description, username,date_added) VALUES ('$autoid1','$supplier','$date','$description','$username',NOW())");
                                    for ($i = 0; $i < count($stock_name); $i++) {
                                    $stock_name[$i] = mysqli_real_escape_string($db->connection, $stock_name[$i]);
                                    $numLot[$i] = mysqli_real_escape_string($db->connection, $numLot[$i]);
                                    $quty[$i] = mysqli_real_escape_string($db->connection, $quty[$i]);
                                    $dateEcheance[$i] = strtotime($dateEcheance[$i]);
                                    $dateEcheance[$i] = date('Y-m-d H:i:s', $dateEcheance[$i]);
                                    $count = $db->countOf("stock_avail", "name='$stock_name[$i]' AND numLot='$numLot[$i]'");
                                        if ($count == 0) {
                                            //$db->query("");
                                            if (!$db->query("INSERT INTO stock_avail(name,numLot,date_premption,quantity) VALUES ('$stock_name[$i]', '$numLot[$i]', '$dateEcheance[$i]', '$quty[$i]')")){
                                            $db->connection->rollback();
                                            echo "<div class='error-box round'>Erreur Ref : 40</div>";
                                            exit();
                                                }
                                            //echo "<font color=green size=+1 >New Stock Entry Inserted !</font><br><br>";
                                            if (!$db->query("INSERT INTO stock_entries(stock_id,stock_name,numLot, quantity, date, type,count1) VALUES ( '$autoid1','$stock_name[$i]', '$numLot[$i]' ,'$quty[$i]','$date','entry','$i'+1)")){
                                            $db->connection->rollback();
                                            echo "<div class='error-box round'>Erreur Ref : 10</div>";
                                            exit();
                                                }
                                        } else if ($count == 1) {
                                            $amount = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$stock_name[$i]' AND numLot='$numLot[$i]'");
                                            $amount1 = $amount + $quty[$i];
                                            if (!$db->query("UPDATE stock_avail SET quantity='$amount1' WHERE name='$stock_name[$i]' AND numLot='$numLot[$i]'")){
                                            $db->connection->rollback();
                                            echo "<div class='error-box round'>Erreur Ref : 20</div>";
                                            exit();
                                                }
                                            if (!$db->query("INSERT INTO stock_entries(stock_id,stock_name,numLot, quantity, date, type,count1) VALUES ( '$autoid1','$stock_name[$i]', '$numLot[$i]' ,'$quty[$i]','$date','entry','$i'+1)")){
                                            $db->connection->rollback();
                                            echo "<div class='error-box round'>Erreur Ref : 30</div>";
                                            exit();
                                                }
                                        }
                                    }
                                    $db->connection->commit();
                                    $db->connection->autocommit(true);
                                    echo "<div class='confirmation-box round'>Commande Ajoutée avec succès Ref: [" . $_POST['purchaseid'] . "]!</div>";
                                    //$msg = "<font color=green size='4px' >Commande ajouté avec succès Ref: [" . $_POST['purchaseid'] . "] !</font><br><br>";
                                    //echo "<script>window.location = 'add_purchase.php?msg=$msg';</script>";
                                }
                            }
                            ?>
                            <form name="form1" method="post" id="form1" action="">
                                <p><strong>Ajout Article</strong> - Nouveau ( Controle +2)</p>
                                <table class="form" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                            <?php
                            $str = $db->query("SELECT id_entrie FROM entries WHERE substring(id_entrie,3)=(SELECT MAX(CAST(SUBSTRING(id_entrie,3) AS SIGNED)) FROM entries)");
                                $str = mysqli_fetch_array($str);
                                $str = $str[0];
                                //$str = $db->maxOf("stock_id", "stock_entries", "type='entry'");
                                //$array = explode(' ', $str);
                                if($str == ''){
                                  $autoid = "PR".++$str;
                                }else{
                                    $lastId = substr($str, 2);
                                    $autoid = "PR".++$lastId;
                                }
                                  ?>
                                        <td>ID:</td>
                                        <td><input name="purchaseid" type="text" id="purchaseid" readonly="readonly" maxlength="200"
                                                   class="round default-width-input" style="width:130px "
                                                   value="<?php echo $autoid ?>"/></td>
                                        <td>Date:</td>
                                        <td><input name="date" id="date1" placeholder=""  style="margin-left: 15px;width: 100px" value="<?php echo date('Y/m/d'); ?>" type="text" maxlength="200" class="round default-width-input"/>
                                        </td>
                                        <td><span class="man">*</span>Fournisseur:</td>
                                        <td><input name="supplier" placeholder="ENTRER FOURNISSEUR" type="text" id="supplier"
                                                   maxlength="200" class="round default-width-input" style="width:130px "/></td>
                                    </tr>
                                    <!-- <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>

                                    </tr> -->
                                </table>
                                <input type="hidden" id="guid">
                                <input type="hidden" id="edit_guid">
                                <table class="form">
                                    <tr>
                                        <td>Article</td>
                                        <td>n° Lot</td>
                                        <td>Date de péremption</td>
                                        <td>Quantité</td>
                                        <td>Stock Dispo</td>
                                    </tr>
                                    <tr>
                                        <td><input name="" type="text" id="item" maxlength="200" class="round default-width-input " style="width: 150px"/></td>
                                        <td><input name="" type="text" id="numLot" maxlength="200" class="round default-width-input my_with"/></td>
                                        <td><input name="" type="text" id="dateEcheance" maxlength="200" class="round default-width-input" style="width: 100px"/></td>
                                        <td><input name="" type="text" id="quty" maxlength="200" class="round default-width-input my_with" onKeyPress="quantity_chnage(event);return numbersonly(event);"/></td>
                                        <td><input name="" type="text" id="stock" readonly="readonly" maxlength="200" class="round  my_with"/></td>
                                        <td> <input type="button" style="width:30px;border:none;height:30px;background:url(images/add_new.png);cursor:pointer" class="round" onclick="addValues2(event);"></td>
                                    </tr>
                                </table>
                                <div style="overflow:auto ;max-height:300px;">
                                    <table class="form" id="item_copy_final">

                                    </table>
                                </div>

                                <table class="form">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Déscription</td>
                                        <td><textarea name="description"></textarea></td>
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
                                                   name="Submit" value="Ajouter" onclick="return checkValid(this);" <?php echo ($_SESSION['username'] != 'mustapha')? "disabled":""; ?>>
                                        </td>
                                        <td> (Controle + S)
                                           </td>
                                        <td> &nbsp;</td>
                                        <td> <input class="button round red   text-upper" type="reset" id="Reset" name="Reset"
                                                   value="Réinitialiser"> </td>
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
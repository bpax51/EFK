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
    <script src="js/add_retour.js"></script>
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
            <li><a href="view_sales.php" class="sales-tab">Sorties</a></li>
            <li><a href="add_retour.php" class="active-tab retours-tab">Retours</a></li>
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
                <li><a href="add_retour.php">Ajout Retour</a></li>
                <li><a href="view_retour.php">Voir Retour</a></li>
            </ul>
        </div>
        <!-- end side-menu -->


        <div class="side-content fr">

            <div class="content-module">

                <div class="content-module-heading cf">

                    <h3 class="fl">Ajout Retour</h3>
                    <span class="fr expand-collapse-text">Cliquez pour réduire</span>
                    <span class="fr expand-collapse-text initial-expand">Cliquez pour agrandir</span>

                </div>
                <!-- end content-module-heading -->

                <div class="content-module-main cf">
                    <?php
                    $search=false;
                    $username = $_SESSION['username'];
                    if (isset($_POST['searchtxt']) AND trim($_POST['searchtxt']) != "") {
                        $validated_data = $gump->run($_POST);
                        if ($validated_data === false) {
                            echo $gump->get_readable_errors(true);
                        } else {
                            $searchtxt = mysqli_real_escape_string($db->connection, $_POST['searchtxt']);
                            $query = "SELECT COUNT(id) as num FROM stock_sales WHERE transactionid = '$searchtxt'";
                            $total_entries = mysqli_fetch_array(mysqli_query($db->connection, $query));
                            $total_entries = $total_entries['num'];
                            if ($total_entries == 0) {
                                echo "<div class='error-box round'>Aucune sortie n'a été ajouté avec le numéro ". $searchtxt ."!</div>";
                            }else{
                                $query1 = "SELECT COUNT(id) as num FROM sales WHERE id_sortie = '$searchtxt'";
                                $totalSales = mysqli_fetch_array(mysqli_query($db->connection, $query1));
                                $totalSales = $totalSales['num'];
                                if ($totalSales > 0) {
                                   echo "<div class='error-box round'>Vous avez déja ajouté un retour pour cette sortie: ". $searchtxt ."!</div>";
                                }else{
                                    $search=true;
                                    $sql = "SELECT * FROM stock_sales WHERE transactionid = '$searchtxt'";
                                    $result = mysqli_query($db->connection, $sql);
                                    $sql1 = "SELECT * FROM stock_sales WHERE transactionid = '$searchtxt' LIMIT 1";
                                    $result1 = mysqli_query($db->connection, $sql1);
                                    $result1 = mysqli_fetch_array($result1);
                                    $sql2 = "SELECT * FROM sorties WHERE id_sortie = '$searchtxt' LIMIT 1";
                                    $result2 = mysqli_query($db->connection, $sql2);
                                    $result2 = mysqli_fetch_array($result2);
                                }
                            }
                        }
                    }
                    if (isset($_POST['Submit'])) {
                        $date        = "";
                        $sortieId    = "";
                        $commercial  = "";
                        $stock_name  = "";
                        $numLot      = "";
                        $quantity    = "";
                        $numArticles = "";
                        $date_retour = "";
                        $validated_data = $gump->run($_POST);
                        if ($validated_data === false) {
                            echo $gump->get_readable_errors(true);
                        } else {
                            $date        = mysqli_real_escape_string($db->connection, $_POST['date']);
                            $date_retour = mysqli_real_escape_string($db->connection, $_POST['dateRetour']);
                            $sortieId    = mysqli_real_escape_string($db->connection, $_POST['sortieId']);
                            $commercial  = mysqli_real_escape_string($db->connection, $_POST['commercial']);
                            $numArticles = mysqli_real_escape_string($db->connection, $_POST['numArticles']);
                            $description = mysqli_real_escape_string($db->connection, $_POST['description']);
                            $stock_name  = $_POST['stock_name'];
                            $quantity    = $_POST['quantity'];
                            $numLot      = $_POST['numLot'];
                            $date_retour = strtotime($date_retour);
                            $date_retour = date('Y-m-d H:i:s', $date_retour);
                            //$db->query("COMMIT;");
                            //$db->query("START TRANSACTION;");
                            $db->connection->autocommit(FALSE);
                            $db->connection->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
                                /*echo "1";
                            }else{
                                echo "000000";
                            }
                            exit();*/
                            //$db->debugQuery("START TRANSACTION;");
                            //$count = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='erttt' AND numLot = 'uyyytyu'");
                            //$db->execute("UPDATE stock_avail SET quantity='55000' WHERE name='pota' AND numLot='00987'");
                                            //exit();
                            for ($i = 0; $i < count($stock_name); $i++) {
                                $oldQuantity    = 0;
                                $diff           = 0;
                                $sold           = 0;
                                $stock_name[$i] = mysqli_real_escape_string($db->connection, $stock_name[$i]);
                                $numLot[$i]     = mysqli_real_escape_string($db->connection, $numLot[$i]);
                                $quantity[$i]   = mysqli_real_escape_string($db->connection, $quantity[$i]);
                                $oldQuantity = $db->queryUniqueValue("SELECT quantity FROM stock_sales WHERE transactionid = '$sortieId' AND stock_name='".$stock_name[$i]."' AND numLot='".$numLot[$i]."'");
                                if (isset($oldQuantity) && is_numeric($oldQuantity) && is_numeric($quantity[$i])) {
                                    if ((float)$quantity[$i] <= (float)$oldQuantity) {
                                        if ((float)$quantity[$i] >0) {
                                            if (!$db->query("UPDATE stock_avail SET quantity=quantity+'$quantity[$i]' WHERE name='$stock_name[$i]' AND numLot='$numLot[$i]'")){
                                            $db->connection->rollback();
                                            echo "<div class='error-box round'>Erreur Ref : 10</div>";
                                            exit();
                                        }
                                        if (!$db->query("INSERT INTO stock_entries(stock_id,stock_name,numLot, quantity, type,count1,date) VALUES ( '$sortieId','$stock_name[$i]', '$numLot[$i]' ,'$quantity[$i]','return','$i'+1,'$date_retour')")){
                                            $db->connection->rollback();
                                            echo "<div class='error-box round'>Erreur Ref : 20</div>";
                                            exit();
                                        }
                                        }
                                        $sold = (float)$oldQuantity - (float)$quantity[$i];
                                        if (!$db->query("INSERT INTO sales_details(id_sortie,stock_name,numLot, quantity) VALUES ( '$sortieId','$stock_name[$i]', '$numLot[$i]' ,'$sold')")){
                                                $db->connection->rollback();
                                                echo "<div class='error-box round'>Erreur Ref : 50</div>";
                                                exit();
                                                }
                                    }else{
                                        $db->connection->rollback();
                                        echo "<div class='error-box round'>retour [".$stock_name[$i]."-".$numLot[$i]."] plus grand que la sortie !</div>";
                                        exit();
                                    }
                                }else{
                                    $db->connection->rollback();
                                        echo "<div class='error-box round'>Erreur Ref : 30</div>";
                                        exit();
                                }
                                //echo $quantity [$i]."-".$oldQuantity."<br>";
                            }
                            if (!$db->query("INSERT INTO sales(id_sortie,commercial,date,date_retour,date_added,username,description) VALUES ( '$sortieId','$commercial', '$date','$date_retour' ,NOW(),'$username','$description')")){
                                        $db->connection->rollback();
                                            echo "<div class='error-box round'>Erreur Ref : 40</div>";
                                            exit();
                                                }
                            //$db->query("COMMIT;");
                            $db->connection->commit();
                            $db->connection->autocommit(true);
                            echo "<div class='confirmation-box round'>Retour Ajoutée avec succès Ref: <span style='cursor:pointer;font-weight:bold;color:black;text-decoration: underline;' onclick=\"window.open('vente_impression.php?sid=".$sortieId."','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');\">[" . $sortieId . "]</span>!</div>";
                            echo "<script>window.open('vente_impression.php?sid=".$sortieId."','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');</script>";
                    }
                }
                    ?>
                    <table>
                    <form action="" method="post" name="search" id="search">
                            <label for="searchtxt">Entrer le n° de sortie</label>&nbsp;&nbsp;<input name="searchtxt" id="searchtxt" type="text" class="round my_text_box" placeholder="n° de sortie">
                            &nbsp;&nbsp;<input name="Search" type="submit" class="my_button round blue text-upper" value="Rechercher">
                        </form>
                    </table>
                    <form name="form1" method="post" id="form1" action="">
                       <table class="form" border="0" cellspacing="0" cellpadding="0">
                    <?php if($search) : ?>
                        <tr>
                                <td><strong>No Sortie:</strong></td>
                                <td><input name="sortieId" type="text" id="sortieId" readonly="readonly" maxlength="200"
                                           class="round default-width-input" style="width:130px "
                                           value="<?php echo $result1['transactionid'] ?>"/></td>
                                <td><strong>Commercial:</strong></td>
                                <td><input name="commercial" placeholder="" type="text" id="commercial" readonly="readonly" value="<?php echo $result2['commercial'] ?>" maxlength="200" class="round default-width-input" style="width:130px "/>
                                </td>
                                <td><strong>Date:</strong></td>
                                <td><input name="date" id="date1" readonly="readonly" value="<?php echo $result1['date'] ?>"
                                style="margin-left: 15px;width: 100px;"type="text" id="name" maxlength="200" class="round default-width-input"/>
                                </td>
                                <td><strong>Date Retour:</strong></td>
                                        <td><input name="dateRetour" id="dateRetour" placeholder=""  style="margin-left: 15px;width: 100px" value="<?php echo date('Y/m/d'); ?>" type="text" id="name" maxlength="200" class="round default-width-input"/>
                                        </td>
                            </tr>
                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($result)) {
                                    ?>
                            <tr>
                                <td>Article:</td>
                                <td><input name="stock_name[]" type="text" id="stock_name" maxlength="200" class="round default-width-input" readonly="readonly" style="width: 150px" value="<?php echo $row['stock_name'];?>"/></td>
                                <td>n° de Lot:</td>
                                <td><input name="numLot[]" type="text" id="numLot" maxlength="200" class="round default-width-input my_with" value="<?php echo $row['numLot'];?>" readonly="readonly"/></td>
                                <td>Quantité:</td>
                                <td><input name="quantity[]" type="text" id="quantity" maxlength="200" class="round default-width-input my_with" value=""/></td>
                                <td><?php echo $row['quantity'];?></td>
                            </tr>
                            <?php $i++;
                                } ?>
                                <input type="hidden" name="numArticles" value="<?php echo $i ?>"/>
                                <tr>
                                <td>Déscription</td>
                                <td colspan="2"><textarea name="description"></textarea></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                                <tr>
                                <td>
                                    <input class="button round blue image-right ic-add text-upper" type="submit" name="Submit" value="Ajouter" <?php echo ($_SESSION['username'] != 'nabila')? "disabled":""; ?>>
                                </td>
                                <td> &nbsp;</td>
                                <td> <input class="button round red text-upper" type="reset" id="Reset" name="Reset" value="Réinitialiser"></td>
                            </tr>
                                <?php endif; ?>
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
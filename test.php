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
    <script src="js/ventes_per_date.js"></script>
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
            <li><a href="add_retour.php" class="retours-tab">Retours</a></li>
            <li><a href="view_customers.php" class=" customers-tab">Commerciaux</a></li>
            <li><a href="view_supplier.php" class=" supplier-tab">Fournisseurs</a></li>
            <li><a href="view_product.php" class="stock-tab">Stocks / Articles</a></li>
            <li><a href="view_report.php" class="active-tab report-tab">Rapports</a></li>
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

            <h3>Rapports</h3>
            <ul>
                <li><a href="view_stock_availability.php">Voir Stock Disponible</a></li>
                <li><a href="stock_per_date.php">Stock Par Date</a></li>
                <li><a href="ventes_per_date.php">Vente Par Date</a></li>
            </ul>
        </div>
        <!-- end side-menu -->


        <div class="side-content fr">

            <div class="content-module">

                <div class="content-module-heading cf">

                    <h3 class="fl">Ventes Par Date / Commercial</h3>
                    <span class="fr expand-collapse-text">Cliquez pour réduire</span>
                    <span class="fr expand-collapse-text initial-expand">Cliquez pour agrandir</span>
                </div>
                <!-- end content-module-heading -->
                <div class="content-module-main cf">
                    <?php
                    $search=false;
                    $username = $_SESSION['username'];
                    if (isset($_POST['Search'])) {
                        $_POST = $gump->sanitize($_POST);
                        $gump->validation_rules(array(
                                    'date1' => 'required|exact_len,10',
                                ));
                        $validated_data = $gump->run($_POST);
                        if ($validated_data === false) {
                            echo $gump->get_readable_errors(true);
                        } else {
                            $commercial = mysqli_real_escape_string($db->connection, $_POST['commercial']);
                            $selected_date1 = $_POST['date1'];
                            $selected_date1 = strtotime($selected_date1);
                            $selected_date1 = date('Y-m-d', $selected_date1);
                            $selected_date1 = mysqli_real_escape_string($db->connection, $selected_date1);
                            if (isset($_POST['date2']) && trim($_POST['date2']) != '') {
                            $selected_date2 = $_POST['date2'];
                            $selected_date2 = strtotime($selected_date2);
                            $selected_date2 = date('Y-m-d', $selected_date2);
                            $selected_date2 = mysqli_real_escape_string($db->connection, $selected_date2);
                            }
                            $fields = array('commercial', 'date1', 'date2');
                            $conditions = array();
                            if (isset($selected_date2) && trim($selected_date2) != '') {
                                $conditions[] = "s.date BETWEEN '$selected_date1' AND '$selected_date2'";
                            }else{
                                $conditions[] = "s.date = ".$selected_date1;
                            }
                            if (isset($commercial) && trim($commercial) != '') {
                                $conditions[] = "s.commercial = '$commercial'";
                            }
                            $query = "SELECT s.commercial as commercial,s.date as date,s.id_sortie as id_sortie,d.stock_name as name, d.numLot as numLot, d.quantity as quantity FROM sales s inner join sales_details d on s.id_sortie=d.id_sortie ";
                            $query2 = "SELECT d.stock_name as name, sum(d.quantity) as quantity FROM sales s inner join sales_details d on s.id_sortie=d.id_sortie ";
                            if(count($conditions) > 0) {
                                // append the conditions
                                $query .= "WHERE " . implode (' AND ', $conditions)."ORDER BY commercial asc, date asc, id_sortie asc, name asc, numLot asc"; // you can change to 'OR', but I suggest to apply the filters cumulative
                                $query2 .= "WHERE " . implode (' AND ', $conditions)."group by name ORDER BY name asc";
                            }
                            //echo "$query";
                            //exit();

                                    $search=true;
                                    $result = mysqli_query($db->connection, $query);
                                    $resul2 = mysqli_query($db->connection, $query2);
                        }
                    }
                    ?>
                    <form name="form1" method="post" id="form1" action="">
                                <table class="form" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>Commercial:</td>
                                        <td><input name="commercial" type="text" id="commercial" maxlength="200" class="round default-width-input" style="width:130px " value=""/></td>
                                        <td>Date1:</td>
                                        <td><input name="date1" id="date1" placeholder=""  style="margin-left: 15px;width: 100px" value="" type="text" maxlength="200" class="round default-width-input"/>
                                        </td>
                                        <td>Date2:</td>
                                        <td><input name="date2" id="date2" placeholder=""  style="margin-left: 15px;width: 100px" value="" type="text" maxlength="200" class="round default-width-input"/>
                                        </td>
                                        <td><input style='margin-left:20px; text-align:center;' name="Search" type="submit" class="round blue" value="Rechercher"></td>
                                    </tr>
                                </table>
                                </form>
                    <table class="tableDetails" style="width:50% !important;">
                    <tr>
                        <th>Commercial</th>
                        <th>Date</th>
                        <th>Sortie</th>
                        <th>Article</th>
                        <th>N° Lot</th>
                        <th>Quantité</th>
                    </tr>

                    <?php
                        $rows = [];
                        while($row = mysqli_fetch_array($result))
                        {
                            $rows[] = $row;
                        }
                        $filteredCommercials = array();
                        foreach ($rows as $value) {
                            $filteredCommercials[$value['commercial']][$value['date']][$value['id_sortie']][$value['name']][] = $value;
                        }
                        echo "<pre>";
                        print_r($filteredCommercials);

                        foreach ($filteredCommercials as $agent => $agentData) {
                            echo "Agent : $agent";
                            foreach ($agentData as $date => $dateData) {
                                echo "<br>";
                                echo "\tDate : $date";
                                foreach ($dateData as $id_sortie => $operationData) {
                                    echo "<br>";
                                    echo "\t\tOperation : $id_sortie";
                                    foreach ($operationData as $name => $articleData) {
                                        echo "<br>";
                                        echo "\t\t\tarticle : $name";
                                        foreach ($articleData as $finalData) {
                                            echo "<br>";
                                            echo "\t\t\t\tnum : " . $finalData['numLot'] . " | Quantity :" . $finalData['quantity'];
                                        }
                                    }
                                }
                            }
                        }
                        ?>
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
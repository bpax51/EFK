<?php
include_once("init.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Azul - Stock Per Date</title>

        <!-- Stylesheets -->
        <!---->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="js/date_pic/date_input.css">
        <!-- Optimize for mobile devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!-- jQuery & JS files -->
        <?php include_once("tpl/common_js.php"); ?>
        <script src="js/script.js"></script>
        <script src="js/date_pic/jquery.date_input.js"></script>
        <script src="js/stock_per_date.js"></script>
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

                    <h3>Rapports</h3>
                    <ul>
                        <li><a href="view_report.php">Les Mouvement</a></li>
                        <li><a href="view_stock_availability.php">Voir Stock Disponible</a></li>
                        <li><a href="stock_per_date.php">Stock Par Date</a></li>
                        <li><a href="ventes_per_date.php">Vente Par Date</a></li>
                    </ul>
                </div>
                <!-- end side-menu -->

                <div class="side-content fr">

                    <div class="content-module">

                        <div class="content-module-heading cf">

                            <h3 class="fl">Stock Disponible</h3>
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
                            $selected_date1 = $_POST['date1'];
                            $selected_date1 = strtotime($selected_date1);
                            $selected_date1 = date('Y-m-d', $selected_date1);
                            $selected_date1 = mysqli_real_escape_string($db->connection, $selected_date1);
                            $query = "SELECT y.stock_name as article,y.numlot as numLot, y.s1 - IFNULL(z.s2,0) as avail FROM (SELECT stock_name, numlot, sum(quantity) as s1 FROM stock_entries WHERE date <= '".$selected_date1."' GROUP BY stock_name,numLot) y LEFT JOIN ( SELECT stock_name, numLot, sum(quantity) as s2 FROM stock_sales   WHERE date <= '".$selected_date1."' GROUP BY stock_name,numLot) z ON z.stock_name=y.stock_name and z.numLot=y.numLot ORDER BY y.stock_name ASC";
                            //echo $query;
                            $search=true;
                            $result = mysqli_query($db->connection, $query);
                            }
                        }
                        ?>
                        <form name="form1" method="post" id="form1" action="">
                                    <table class="form" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td>Date1:</td>
                                            <td><input name="date1" id="date1" placeholder=""  style="margin-left: 15px;width: 100px" value="" type="text" maxlength="200" class="round default-width-input"/>
                                            </td>
                                            <td><input style='margin-left:20px; text-align:center;' name="Search" type="submit" class="round blue" value="Rechercher"></td>
                                        </tr>
                                    </table>
                        </form>

                            <table>
                                <form method="post">
                                    <table style="width:25% !important; text-align:center;">
                                        <?php
                                            if ($search) {
                                                echo "<tr><td colspan='3' class='tableHeadAlert'>Stock Disponible Le ".$selected_date1."</td><tr>";
                                            }
                                        ?>
                                        <tr>
                                            <th style="border-bottom: none;">No</th>
                                            <th>Num Lot</th>
                                            <th>Stock (KG)</th>
                                        </tr>
                                        <?php
                                        if ($search) {
                                            $i=1;
                                            $prevArticle = "";
                                            while ($row = mysqli_fetch_array($result)) {
                                                if($prevArticle != $row['article']){
                                                    echo "<tr class='infotr'><td colspan='3' class='infotd textLeft'> &nbsp;&nbsp;".$row['article']."</td></tr>";
                                                }
                                                echo "<tr><td>".$i."</td><td><strong>".$row['numLot']."</strong></td><td><strong>".$row['avail']."</strong><td>";
                                                $i++;
                                                $prevArticle = $row['article'];
                                            }
                                        }
                                        ?>
                                    </table>
                                </form>
                        </div>
                    </div>
                    <div id="footer">
                        <p>
                        </p>
                    </div>
                    <!-- end footer -->
                    </body>
                    </html>
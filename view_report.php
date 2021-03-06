<?php
include_once("init.php");

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Azul - Rapport</title>

    <!-- Stylesheets -->

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="js/date_pic/date_input.css">

    <!-- Optimize for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- jQuery & JS files -->
    <?php include_once("tpl/common_js.php"); ?>
    <script src="js/date_pic/jquery.date_input.js"></script>
    <script src="js/script.js"></script>
    <script src="js/view_report.js"></script>
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

                    <h3 class="fl">Rapport</h3>
                    <span class="fr expand-collapse-text">Cliquez pour réduire</span>
                    <span class="fr expand-collapse-text initial-expand">Cliquez pour agrandir</span>

                </div>
                <!-- end content-module-heading -->

                <div class="content-module-main cf">
                    <form action="">

                        <table class="form" border="0" cellspacing="0" cellpadding="0">
                            <form action="sales_report.php" method="post" name="form1" id="form1" name="sales_report"
                                  id="sales_report" target="myNewWinsr">
                                <tr>

                                    <td style="width:200px !important;"><strong>Rapport Des Sorties</strong></td>
                                    <td>De</td>
                                    <td><input name="from_sales_date" type="text" id="from_sales_date"
                                               style="width:80px;"></td>
                                    <td>à</td>
                                    <td><input name="to_sales_date" type="text" id="to_sales_date" style="width:80px;">
                                    </td>
                                    <td><div style="padding-left: 15px;"><input class="button round blue image" name="submit" type="button" value="Générer" onClick='sales_report_fn();'>
                                    </div></td>

                                </tr>
                            </form>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                            <form action="purchase_report.php" method="post" name="purchase_report" target="_blank">
                                <tr>
                                    <td ><strong>Rapport Des Entrées</strong></td>
                                    <td>De</td>
                                    <td><input name="from_purchase_date" type="text" id="from_purchase_date"
                                               style="width:80px;"></td>
                                    <td>à</td>
                                    <td><input name="to_purchase_date" type="text" id="to_purchase_date"
                                               style="width:80px;"></td>
                                    <td><div style="padding-left: 15px;"><input class="button round blue image" name="submit" type="button" value="Générer" onClick='purchase_report_fn();'>
                                        </div></td>
                                </tr>
                            </form>

                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>

                        </table>
                </div>
                <!-- end content-module-main -->
            </div>
            <!-- end content-module -->
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
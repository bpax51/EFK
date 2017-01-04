<?php
include_once("init.php");

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Azul - Dashboard</title>

    <!-- Stylesheets -->

    <link rel="stylesheet" href="css/style.css">

    <!-- Optimize for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- jQuery & JS files -->
    <?php include_once("tpl/common_js.php"); ?>
    <script src="js/script.js"></script>
</head>
<body>

<!-- TOP BAR -->
<?php include_once("tpl/top_bar.php"); ?>
<!-- end top-bar -->


<!-- HEADER -->
<div id="header-with-tabs">

    <div class="page-full-width cf">

        <ul id="tabs" class="fl">
            <li><a href="dashboard.php" class="active-tab dashboard-tab">Dashboard</a></li>
            <li><a href="view_purchase.php" class="purchase-tab">Entrées</a></li>
            <li><a href="view_sales.php" class="sales-tab">Sorties</a></li>
            <li><a href="add_retour.php" class="retours-tab">Retours</a></li>
            <li><a href="view_customers.php" class=" customers-tab">Commerciaux</a></li>
            <li><a href="view_supplier.php" class=" supplier-tab">Fournisseurs</a></li>
            <li><a href="view_product.php" class=" stock-tab">Stocks / Articles</a></li>
            <li><a href="view_report.php" class="report-tab">Rapports</a></li>
        </ul>
        <!-- end tabs -->

        <!-- Change this image to your own company's logo -->
        <!-- The logo will automatically be resized to 30px height. -->
        <?php $line = $db->queryUniqueObject("SELECT * FROM store_details ");
        $_SESSION['logo'] = $line->log;
        ?>
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

            <h3>Liens Rapides</h3>
            <ul>
                <li><a href="add_sales.php">Ajout Sorties</a></li>
                <li><a href="add_purchase.php">Ajout Entrée</a></li>
                <li><a href="add_supplier.php">Ajout Fournisseur</a></li>
                <li><a href="add_customer.php">Ajout Commerciaux</a></li>
                <li><a href="view_report.php">Rapport</a></li>
            </ul>

        </div>
        <!-- end side-menu -->

        <div class="side-content fr">

            <div class="content-module">

                <div class="content-module-heading cf">

                    <h3 class="fl">Statistique</h3>
                    <span class="fr expand-collapse-text">Cliquez pour réduire</span>
                    <span class="fr expand-collapse-text initial-expand">Cliquez pour agrandir</span>

                </div>
                <!-- end content-module-heading -->

                <div class="content-module-main cf">


                    <table style="width:350px; float:left;" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left">Nombre Total D'articles</td>
                            <td align="left"><?php echo $count = $db->countOfAll("stock_details"); ?>&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="left">Nombre Total Des Sorties</td>
                            <td align="left"><?php echo $count = $db->countOfAll("sorties"); ?></td>
                        </tr>
                        <tr>
                            <td align="left">Nombre Total Des Fournisseurs</td>
                            <td align="left"><?php echo $count = $db->countOfAll("supplier_details"); ?></td>
                        </tr>
                        <tr>
                            <td align="left">Nombre Total Des Commerciaux</td>
                            <td align="left"><?php echo $count = $db->countOfAll("customer_details"); ?></td>
                        </tr>
                        <tr>
                            <td align="left">&nbsp;</td>
                            <td align="left">&nbsp;</td>
                        </tr>
                    </table>

                    <table style="width:600px; margin-left:50px; float:left; text-align:left;" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>&nbsp;</td>
                            <td style="width:200px;"  align="left">Dashboard (Ctrl+0)</td>
                            <td style="width:200px;"  align="left">Ajout Entrée(Ctrl+1)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td align="left">Ajout Article(Ctrl+2)</td>
                            <td align="left">Ajout Sortie(Ctrl+)</td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td align="left">Ajout Categorie (Ctrl+4 )</td>
                            <td align="left">Ajout Fournisseur (Ctrl+5 )</td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td align="left">Ajout Commerciaux (Ctrl+6)</td>
                            <td align="left">Voir Articles (Ctrl+7)</td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td align="left">Voir Sorties(Ctrl+8)</td>
                            <td align="left">Voir Entrées (Ctrl+9)</td>

                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td align="left">Ajout Nouveau (Ctrl+a)</td>
                            <td align="left">Enregistrer ( Ctrl+s )</td>

                        </tr>

                    </table>
                    <!--<ul class="temporary-button-showcase">
                        <li><a href="#" class="button round blue image-right ic-add text-upper">Add</a></li>
                        <li><a href="#" class="button round blue image-right ic-edit text-upper">Edit</a></li>
                        <li><a href="#" class="button round blue image-right ic-delete text-upper">Delete</a></li>
                        <li><a href="#" class="button round blue image-right ic-download text-upper">Download</a></li>
                        <li><a href="#" class="button round blue image-right ic-upload text-upper">Upload</a></li>
                        <li><a href="#" class="button round blue image-right ic-favorite text-upper">Favorite</a></li>
                        <li><a href="#" class="button round blue image-right ic-print text-upper">Print</a></li>
                        <li><a href="#" class="button round blue image-right ic-refresh text-upper">Refresh</a></li>
                        <li><a href="#" class="button round blue image-right ic-search text-upper">Search</a></li>
                    </ul>-->

                </div>
                <!-- end content-module-main -->


            </div>
            <!-- end content-module -->


        </div>
        <!-- end full-width -->

    </div>
</div>


<!-- FOOTER -->
<div id="footer">
    <p>
    </p>

</div>
<!-- end footer -->

</body>
</html>
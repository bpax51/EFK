<?php
include_once("init.php");

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Azul - Modification Article</title>

    <!-- Stylesheets -->

    <link rel="stylesheet" href="css/style.css">

    <!-- Optimize for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- jQuery & JS files -->
    <?php include_once("tpl/common_js.php"); ?>
    <script src="js/script.js"></script>
    <script src="js/update_stock.js"></script>
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
            <li><a href="view_product.php" class="active-tab stock-tab">Stocks / Articles</a></li>
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

            <h3>Gestion De Stock</h3>
            <ul>
                <li><a href="add_stock.php">Ajout Article</a></li>
                <li><a href="view_product.php">Voir Articles</a></li>
                <li><a href="add_category.php">Ajout Catégorie</a></li>
                <li><a href="view_category.php">Voir Catégories</a></li>
            </ul>

        </div>
        <!-- end side-menu -->

        <div class="side-content fr">

            <div class="content-module">

                <div class="content-module-heading cf">

                    <h3 class="fl">Modification d'Article</h3>
                    <span class="fr expand-collapse-text">Cliquez pour réduire</span>
<span class="fr expand-collapse-text initial-expand">Cliquez pour agrandir</span>

                </div>
                <!-- end content-module-heading -->

                <div class="content-module-main cf">
                    <form name="form1" method="post" id="form1" action="">
                        <table class="form" border="0" cellspacing="0" cellpadding="0">
                            <?php
                            if (isset($_POST['id'])) {

                                $id = mysqli_real_escape_string($db->connection, $_POST['id']);
                                $name = trim(mysqli_real_escape_string($db->connection, $_POST['name']));
                                $Category = trim(mysqli_real_escape_string($db->connection, $_POST['Category']));

                                if ($db->query("UPDATE stock_details  SET stock_name ='$name',category='$Category' where id=$id"))
                                    echo "<div class='confirmation-box round'>[ $name ] Article mis à jour!</div>";
                                else
                                    echo "<div class='error-box round'>Une erreur est survenue lors de la mise à jour!</div>";


                            }

                            ?>
                            <?php
                            if (isset($_GET['sid']))
                                $id = $_GET['sid'];

                            $line = $db->queryUniqueObject("SELECT * FROM stock_details WHERE id=$id");
                            ?>
                            <form name="form1" method="post" id="form1" action="">

                                <input name="id" type="hidden" value="<?php echo $_GET['sid']; ?>">
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Stock ID</td>
                                    <td><input name="stock_id" type="text" readonly="readonly" id="stock_id" maxlength="200"  class="round default-width-input" value="<?php echo $line->stock_id;?>" readonly/>
                                    </td>
                                    <td>Nom</td>
                                    <td>&nbsp;</td>
                                    <td><input name="name" type="text" id="name" maxlength="200" class="round default-width-input" value="<?php echo $line->stock_name;?>" /></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Catégorie</td>
                                    <td><input name="Category" type="text" id="category" maxlength="20" class="round default-width-input" value="<?php echo $line->category;?>" readonly="readonly"/></td>
                                    <td></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <input class="button round blue image-right ic-add text-upper" type="submit"
                                               name="Submit" value="Enregistrer">
                                        (Controle + S)
                                    </td>
                                    <td align="right"></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                        </table>
                    </form>
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
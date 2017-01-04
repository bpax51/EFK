<?php
include_once("init.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Azul - Ajout Article</title>

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
    <script src="js/add_stock.js"></script>
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

            <h3>Gestion de Stock</h3>
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

                    <h3 class="fl">Ajout Article</h3>
                    <span class="fr expand-collapse-text">Cliquez pour réduire</span>
                    <span class="fr expand-collapse-text initial-expand">Cliquez pour agrandir</span>
                </div>
                <!-- end content-module-heading -->
                <div class="content-module-main cf">
                    <?php
                    //Gump is libarary for Validatoin
                    if (isset($_POST['name'])) {
                        $_POST = $gump->sanitize($_POST);
                        $gump->validation_rules(array(
                            'name' => 'required|max_len,100|min_len,3',
                            'stockid' => 'required|max_len,200',
                            'category' => 'max_len,200'
                        ));

                        $gump->filter_rules(array(
                            'name' => 'trim|sanitize_string|mysqli_escape',
                            'stockid' => 'trim|sanitize_string|mysqli_escape',
                            'category' => 'trim|sanitize_string|mysqli_escape',
                        ));
                        $validated_data = $gump->run($_POST);
                        $name = "";
                        $stockid = "";
                        $category = "";
                        if ($validated_data === false) {
                            echo $gump->get_readable_errors(true);
                        } else {
                            $name = mysqli_real_escape_string($db->connection, $_POST['name']);
                            $stockid = mysqli_real_escape_string($db->connection, $_POST['stockid']);
                            $category = mysqli_real_escape_string($db->connection, $_POST['category']);
                            $count = $db->countOf("stock_details", "stock_name ='$name'");
                            if ($count >= 1) {
                                echo "<div class='error-box round'>Double entrée. Merci de vérifier !</div>";
                            } else {
                                if ($db->query("insert into stock_details(stock_id,stock_name,stock_quatity,category) values('$stockid','$name',0,'$category')")) {
                                    echo "<div class='confirmation-box round'> [ $name ] Article Ajouté!</div>";
                                } else
                                    echo "<div class='error-box round'>Une erreur est survenue !</div>";
                            }
                        }
                    }
                    ?>
                    <form name="form1" method="post" id="form1" action="">
                        <table class="form" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <?php
                                $max = $db->maxOfAll("id", "stock_details");
                                $max = $max + 1;
                                $autoid = "ST" . $max . "";
                                ?>
                                <td><span class="man">*</span>&nbsp;ID:</td>
                                <td><input name="stockid" type="text" id="stockid" readonly="readonly" maxlength="200"
                                           class="round default-width-input"
                                           value="<?php echo isset($autoid) ? $autoid : ''; ?>"/></td>
                                <td><span class="man">*</span>Nom:</td>
                                <td><input name="name" placeholder="ENTRER LE NOM D'ARTICLE" type="text" id="name"
                                           maxlength="200" class="round default-width-input" value=""/></td>
                            </tr>
                            <tr>
                                <td>Catégorie:</td>
                                <td><input name="category" placeholder="ENTRER LA CATEGORIE" type="text" id="category" maxlength="200" class="round default-width-input" value=""/></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <input class="button round blue image-right ic-add text-upper" type="submit" name="Submit" value="Ajouter">
                                    (Controle + S)

                                <td align="right"><input class="button round red   text-upper" type="reset" name="Reset" value="réinitialiser"></td>
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
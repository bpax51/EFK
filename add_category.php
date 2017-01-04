<?php
include_once("init.php");

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Azul - Ajout Catégorie</title>

    <!-- Stylesheets -->

    <link rel="stylesheet" href="css/style.css">

    <!-- Optimize for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- jQuery & JS files -->
    <?php include_once("tpl/common_js.php"); ?>
    <script src="js/script.js"></script>
    <script src="js/add_category.js"></script>
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

                    <h3 class="fl">Ajout Catégorie</h3>
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
                            'description' => 'max_len,200',

                        ));

                        $gump->filter_rules(array(
                            'name' => 'trim|sanitize_string|mysqli_escape',
                            'description' => 'trim|sanitize_string|mysqli_escape',

                        ));

                        $validated_data = $gump->run($_POST);
                        $name = "";
                        $description = "";

                        if ($validated_data === false) {
                            echo $gump->get_readable_errors(true);
                        } else {
                            $name = mysqli_real_escape_string($db->connection, $_POST['name']);
                            $description = mysqli_real_escape_string($db->connection, $_POST['description']);
                            $count = $db->countOf("category_details", "category_name='$name'");
                            if ($count == 1) {
                                echo "<div class='error-box round'>Double entrée. Merci de vérifier</div>";
                            } else {

                                if ($db->query("insert into category_details values(NULL,'$name','$description')"))
                                    echo "<div class='confirmation-box round'> [ $name ] Catégorie Ajoutée !</div>";
                                else
                                    echo "<div class='error-box round'>Une erreur est survenue !</div>";
                            }
                        }
                    }
                    ?>
                    <form name="form1" method="post" id="form1" action="">

                        <p><strong>Ajout Catégorie </strong> - Nouveau ( Controle +A)</p>
                        <table class="form" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><span class="man">*</span>Nom:</td>
                                <td><input name="name" placeholder="ENTRER LE NOM" type="text" id="name"
                                           maxlength="200" class="round default-width-input"
                                           value="<?php echo isset($name) ? $name : ''; ?>"/></td>

                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Déscription</td>
                                <td><textarea name="description" placeholder="ENTRER LA DESCRIPTION" cols="8"
                                              class="round full-width-textarea"><?php echo isset($description) ? $description : ''; ?></textarea>
                                </td>

                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>


                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    <input class="button round blue image-right ic-add text-upper" type="submit"
                                           name="Submit" value="Ajouter" <?php echo ($_SESSION['username'] != 'nabila')? "disabled":""; ?>>
                                    (Controle + S)

                                <td align="right"><input class="button round red   text-upper" type="reset" name="Reset"
                                                         value="réinitialiser"></td>
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
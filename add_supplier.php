<?php
include_once("init.php");
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Azul - Ajout Fournisseur</title>

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
    <script src="js/add_supplier.js"></script>
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
            <li><a href="view_sales.php" class=" sales-tab">Sorties</a></li>
            <li><a href="add_retour.php" class="retours-tab">Retours</a></li>
            <li><a href="view_customers.php" class="customers-tab">Commerciaux</a></li>
            <li><a href="view_supplier.php" class="active-tab   supplier-tab">Fournisseurs</a></li>
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

            <h3>Gestion Fournisseurs</h3>
            <ul>
                <li><a href="add_supplier.php">Ajout Fournisseur</a></li>
                <li><a href="view_supplier.php">Voir Fournisseurs</a></li>
            </ul>
        </div>
        <!-- end side-menu -->

        <div class="side-content fr">

            <div class="content-module">

                <div class="content-module-heading cf">

                    <h3 class="fl">Ajout Fournisseur</h3>
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
                            'address' => 'max_len,200',
                            'contact1' => 'alpha_numeric|max_len,20',
                            'contact2' => 'alpha_numeric|max_len,20'
                        ));

                        $gump->filter_rules(array(
                            'name' => 'trim|sanitize_string|mysqli_escape',
                            'address' => 'trim|sanitize_string|mysqli_escape',
                            'contact1' => 'trim|sanitize_string|mysqli_escape',
                            'contact2' => 'trim|sanitize_string|mysqli_escape'
                        ));

                        $validated_data = $gump->run($_POST);
                        $name = "";
                        $address = "";
                        $contact1 = "";
                        $contact2 = "";

                        if ($validated_data === false) {
                            echo $gump->get_readable_errors(true);
                        } else {
                            $name = mysqli_real_escape_string($db->connection, $_POST['name']);
                            $address = mysqli_real_escape_string($db->connection, $_POST['address']);
                            $contact1 = mysqli_real_escape_string($db->connection, $_POST['contact1']);
                            $contact2 = mysqli_real_escape_string($db->connection, $_POST['contact2']);
                            $count = $db->countOf("supplier_details", "supplier_name='$name'");
                            if ($count == 1) {
                                echo "<div class='error-box round'>Double entrée. Merci de vérifier</div>";
                            } else {
                                if ($db->query("insert into supplier_details values(NULL,'$name','$address','$contact1','$contact2')"))
                                    echo "<div class='confirmation-box round'>[ $name ] Fournisseur Ajouté !</div>";
                                else
                                    echo "<div class='error-box round'>Une erreur est survenue !</div>";
                            }
                        }
                    }
                    ?>

                    <form name="form1" method="post" id="form1" action="">

                        <p><strong>Ajout Détails Fournisseur</strong> - Nouveau ( Controle + u)</p>
                        <table class="form" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><span class="man">*</span>nom:</td>
                                <td><input name="name" placeholder="Nom Complet" type="text" id="name"
                                           maxlength="200" class="round default-width-input" value=""/></td>
                                <td><span class="man">*</span><b>Contact</b><b>-1</b></td>
                                <td><input name="contact1" placeholder="Détails Contact 1" type="text"
                                           id="buyingrate" maxlength="20" class="round default-width-input"onkeypress="return numbersonly(event)"
                                           value=""/></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Adresse:</td>
                                <td><textarea name="address" placeholder="ENTRER L'ADRESSE" cols="8"
                                              class="round full-width-textarea"></textarea>
                                </td>
                                <td><b>Contact</b><b>-2</b></td>
                                <td><input name="contact2" placeholder="Détails Contact 2" type="text"
                                           id="sellingrate" maxlength="20" class="round default-width-input"onkeypress="return numbersonly(event)"
                                           value=""/></td>
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
                                           name="Submit" value="Ajouter" <?php echo ($_SESSION['username'] != 'mustapha')? "disabled":""; ?>>
                                    <b>(Controle + S)</b>

                                <td align="right"><input class="button round red   text-upper" type="reset" name="Reset"
                                                         value="Réinitialiser"></td>
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
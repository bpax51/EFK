<?php
include_once("init.php");

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Azul - Mise à Jour Fournisseur</title>

    <!-- Stylesheets -->

    <link rel="stylesheet" href="css/style.css">

    <!-- Optimize for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- jQuery & JS files -->
    <?php include_once("tpl/common_js.php"); ?>
    <script src="js/script.js"></script>
    <script src="js/update_supplier.js"></script>
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
            <li><a href="view_customers.php" class=" customers-tab">Commerciaux</a></li>
            <li><a href="view_supplier.php" class=" active-tab supplier-tab">Fournisseurs</a></li>
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

            <h3>Gestion De Fournisseurs</h3>
            <ul>
                <li><a href="add_supplier.php">Ajout Fournisseur</a></li>
                <li><a href="view_supplier.php">Voir Fournisseurs</a></li>
            </ul>
        </div>
        <!-- end side-menu -->
        <div class="side-content fr">

            <div class="content-module">

                <div class="content-module-heading cf">

                    <h3 class="fl">Mise à Jour Fournisseur</h3>
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
                                $address = trim(mysqli_real_escape_string($db->connection, $_POST['address']));
                                $contact1 = trim(mysqli_real_escape_string($db->connection, $_POST['contact1']));
                                $contact2 = trim(mysqli_real_escape_string($db->connection, $_POST['contact2']));
                                if ($db->query("UPDATE supplier_details  SET supplier_name ='$name',supplier_address='$address',supplier_contact1='$contact1',supplier_contact2='$contact2' where id='$id'"))
                                    echo "<div class='confirmation-box round'>[ $name ] Fournisseur mis à jour</div>";
                                else
                                    echo "<div class='error-box round'>Une erreur est survenue lors de la mise à jour !</div>";
                            }

                            ?>
                            <?php
                            if (isset($_GET['sid']))
                                $id = $_GET['sid'];

                            $line = $db->queryUniqueObject("SELECT * FROM supplier_details WHERE id=$id");
                            ?>
                            <form name="form1" method="post" id="form1" action="">
                                <input name="id" type="hidden" value="<?php echo $_GET['sid']; ?>">
                                <tr>
                                    <td>Nom:</td>
                                    <td><input name="name" type="text" id="name" maxlength="200"
                                               class="round default-width-input"onKeyPress="return ValidateAlpha(event)"
                                               value="<?php echo $line->supplier_name;?>" readonly="readonly"/></td>
                                    <td><b>Contact-1</b></td>
                                    <td><input name="contact1" type="text" id="buyingrate" maxlength="20"
                                               class="round default-width-input"onkeypress="return numbersonly(event)"
                                               value="<?php echo $line->supplier_contact1; ?>"/></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Adresse:</td>
                                    <td><textarea name="address" cols="15"
                                                  class="round full-width-textarea"><?php echo $line->supplier_address; ?></textarea>
                                    </td>
                                    <td><b>Contact-2</b></td>
                                    <td><input name="contact2" type="text" id="sellingrate" maxlength="20"
                                               class="round default-width-input"onkeypress="return numbersonly(event)"
                                               value="<?php echo $line->supplier_contact2; ?>"/></td>
                                </tr>
                                <tr>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        <input class="button round blue image-right ic-add text-upper" type="submit"
                                               name="Submit" value="Enregistrer" <?php echo ($_SESSION['username'] != 'mustapha')? "disabled":""; ?>>
                                        <b>(Controle + S)</b>
                                    </td>
                                    <td align="right"><input class="button round red   text-upper" type="reset"
                                                             name="Reset" value="réinitialiser"></td>

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
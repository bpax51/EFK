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

            <h3>Gestion Du Compte</h3>

        </div>
        <!-- end side-menu -->

        <div class="side-content fr">

            <div class="content-module">

                <div class="content-module-heading cf">

                    <h3 class="fl">Modification Mot De Passe</h3>
                    <span class="fr expand-collapse-text">Cliquez pour réduire</span>
<span class="fr expand-collapse-text initial-expand">Cliquez pour agrandir</span>

                </div>
                <!-- end content-module-heading -->

                <div class="content-module-main cf">

                    <?php
                    if (isset($_POST['old_pass']) and isset($_POST['new_pass']) and isset($_POST['confirm_pass'])) {
                        $username = $_SESSION['username'];
                        $old_pass = $_POST['old_pass'];
                        $count = $db->countOf("stock_user", "username='$username' and password='".md5($old_pass)."'");
                        if ($count == 0) {
                            echo "<div class='error-box round'>Ancien mot de passe érroné !</div>";
                        } else {
                            if (trim($_POST['new_pass']) == trim($_POST['confirm_pass'])) {
                                $con = $_POST['confirm_pass'];
                                $db->query("update stock_user  SET password='".md5($con)."' where username='$username'");
                                echo "<div class='confirmation-box round'>Mise à jour du mdp réussite !</div>";
                            } else {
                                echo "<div class='error-box round'>Erreur Ref : 20</div>";
                            }
                        }
                    }
                    ?>
                    <form action="" method="post">
                        <table style="width:600px; margin-left:50px; float:left;" border="0" cellspacing="0"
                               cellpadding="0">

                            <tr>
                                <td>Ancien Mot de Passe</td>
                                <td><input type="password" name="old_pass"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Nouveau Mot de Passe</td>
                                <td><input type="password" name="new_pass"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Confirmer Mot De Passe</td>
                                <td><input type="password" name="confirm_pass"></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td>
                                    <input class="button round blue image-right ic-add text-upper" type="submit"
                                           name="Submit" name="change_pass" value="Save">
                                </td>
                                <td>
                                    <input class="button round red   text-upper" type="reset" name="Reset"
                                           value="Reset"></td>
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
</div>


<!-- FOOTER -->
<div id="footer">
</div>
<!-- end footer -->

</body>
</html>
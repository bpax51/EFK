<?php
include_once("init.php");
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Azul - Stock Disponible</title>

        <!-- Stylesheets -->
        <!---->
        <link rel="stylesheet" href="css/style.css">

        <!-- Optimize for mobile devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <!-- jQuery & JS files -->
        <?php include_once("tpl/common_js.php"); ?>
        <script src="js/script.js"></script>
        <script src="js/view_stock_availability.js"></script>


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


                            <table>
                                <form action="" method="post" name="search">
                                    <input name="searchtxt" type="text" class="round my_text_box" placeholder="Recherche" style="margin-left: 30px">
                                    &nbsp;&nbsp;<input name="Search" type="submit" class="my_button round blue   text-upper"
                                                       value="Rechercher">
                                </form>
                                <form action="" method="get" name="limit_go">
                                    Lignes Par Page<input name="limit" type="text" class="round my_text_box" id="search_limit" style="margin-left:5px;"
                                                          value="<?php if (isset($_GET['limit'])) echo $_GET['limit']; else echo "1000"; ?>" size="3" maxlength="3">
                                    <input name="go" type="button" value="Go" class=" round blue my_button  text-upper"
                                           onclick="return confirmLimitSubmit()">
                                </form>
                                    <table style="width:50% !important;margin:auto;">
                                        <?php
                                        /*$SQL = "SELECT * FROM  stock_avail ORDER BY id DESC";
                                        if (isset($_POST['Search']) AND trim($_POST['searchtxt']) != "") {
                                            $SQL = "SELECT * FROM  stock_avail WHERE name LIKE '%" . $_POST['searchtxt'] . "%' ORDER BY id DESC";
                                        }*/
                                        $tbl_name = "stock_avail";        //your table name
                                        // How many adjacent pages should be shown on each side?
                                        $adjacents = 3;
                                        /*
                                          First get total number of rows in data table.
                                          If you have a WHERE clause in your query, make sure you mirror it here.
                                         */
                                        if (isset($_POST['searchtxt'])) {
                                            $_POST['searchtxt'] = mysqli_real_escape_string($db->connection, $_POST['searchtxt']);
                                        }
                                        $SearchText="";
                                        $query = "SELECT COUNT(*) as num FROM $tbl_name WHERE quantity > 0";
                                        if (isset($_POST['Search']) AND trim($_POST['searchtxt']) != "") {

                                            $query = "SELECT COUNT(*) as num FROM  stock_avail WHERE (name LIKE '%" . $_POST['searchtxt'] . "%' OR numLot LIKE '%" . $_POST['searchtxt'] . "%') AND quantity > 0";
                                            $SearchText = "&searchtxt=".$_POST['searchtxt'];
                                        }
                                        if(isset($_GET['searchtxt']) AND trim($_GET['searchtxt']) != "" ){
                                            $SearchText = "&searchtxt=".$_GET['searchtxt'];
                                            $query = "SELECT COUNT(*) as num FROM  stock_avail WHERE (name LIKE '%" . $_POST['searchtxt'] . "%' OR numLot LIKE '%" . $_POST['searchtxt'] . "%') AND quantity > 0";
                                        }
                                        $total_pages = mysqli_fetch_array(mysqli_query($db->connection, $query));
                                        $total_pages = $total_pages['num'];
                                        /* Setup vars for query. */
                                        $targetpage = "view_product.php";    //your file name  (the name of this file)
                                        $limit = 1000;                                //how many items to show per page
                                        if (isset($_GET['limit']) && is_numeric($_GET['limit'])) {
                                            $limit = $_GET['limit'];
                                            $_GET['limit'] = 1000;
                                        }

                                        $page = isset($_GET['page']) ? $_GET['page'] : 0;


                                        if ($page)
                                            $start = ($page - 1) * $limit;            //first item to display on this page
                                        else
                                            $start = 0;                                //if no page var is given, set start to 0


                                            /* Get data. */

                                        $sql = "SELECT * FROM stock_avail ORDER BY name asc, date_premption ASC LIMIT $start, $limit ";
                                        if (isset($_POST['Search']) AND trim($_POST['searchtxt']) != "") {

                                            $sql = "SELECT * FROM  stock_avail WHERE (name LIKE '%" . $_POST['searchtxt'] . "%' OR numLot LIKE '%" . $_POST['searchtxt'] . "%') AND quantity > 0 ORDER BY name asc, date_premption ASC LIMIT $start, $limit";
                                        }
                                        if(isset($_GET['searchtxt']) AND trim($_GET['searchtxt']) != "" ){
                                            $sql = "SELECT * FROM  stock_avail WHERE (name LIKE '%" . $_POST['searchtxt'] . "%' OR numLot LIKE '%" . $_POST['searchtxt'] . "%') AND quantity > 0 ORDER BY name asc, date_premption ASC LIMIT $start, $limit";
                                        }
                                        $result = mysqli_query($db->connection, $sql);
                                        /* Setup page vars for display. */

                                        if ($page == 0)
                                            $page = 1;                    //if no page var is given, default to 1.

                                        $prev = $page - 1;                            //previous page is page - 1

                                        $next = $page + 1;                            //next page is page + 1

                                        $lastpage = ceil($total_pages / $limit);        //lastpage is = total pages / items per page, rounded up.

                                        $lpm1 = $lastpage - 1;                        //last page minus 1
                                        /*
                                          Now we apply our rules and draw the pagination object.

                                          We're actually saving the code to a variable in case we want to draw it more than once.
                                         */

                                        $pagination = "";

                                        if ($lastpage > 1) {

                                            $pagination .= "<div >";

                                            //previous button

                                            if ($page > 1)
                                                $pagination .= "<a href=\"view_product.php?page=$prev&limit=$limit$SearchText\" class=my_pagination >Previous</a>";
                                            else
                                                $pagination .= "<span class=my_pagination>Previous</span>";


                                            //pages

                                            if ($lastpage < 7 + ($adjacents * 2)) {    //not enough pages to bother breaking it up
                                                for ($counter = 1; $counter <= $lastpage; $counter++) {

                                                    if ($counter == $page)
                                                        $pagination .= "<span class=my_pagination>$counter</span>";
                                                    else
                                                        $pagination .= "<a href=\"view_product.php?page=$counter&limit=$limit$SearchText\" class=my_pagination>$counter</a>";
                                                }
                                            } elseif ($lastpage > 5 + ($adjacents * 2)) {    //enough pages to hide some
                                                //close to beginning; only hide later pages
                                                if ($page < 1 + ($adjacents * 2)) {

                                                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {

                                                        if ($counter == $page)
                                                            $pagination .= "<span class=my_pagination>$counter</span>";
                                                        else
                                                            $pagination .= "<a href=\"view_product.php?page=$counter&limit=$limit$SearchText\" class=my_pagination>$counter</a>";
                                                    }

                                                    $pagination .= "...";

                                                    $pagination .= "<a href=\"view_product.php?page=$lpm1&limit=$limit$SearchText\" class=my_pagination>$lpm1</a>";

                                                    $pagination .= "<a href=\"view_product.php?page=$lastpage&limit=$limit$SearchText\" class=my_pagination>$lastpage</a>";
                                                } //in middle; hide some front and some back

                                                elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                                                    $pagination .= "<a href=\"view_product.php?page=1&limit=$limit$SearchText\" class=my_pagination>1</a>";

                                                    $pagination .= "<a href=\"view_product.php?page=2&limit=$limit$SearchText\" class=my_pagination>2</a>";

                                                    $pagination .= "...";

                                                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {

                                                        if ($counter == $page)
                                                            $pagination .= "<span  class=my_pagination>$counter</span>";
                                                        else
                                                            $pagination .= "<a href=\"view_product.php?page=$counter&limit=$limit$SearchText\" class=my_pagination>$counter</a>";
                                                    }
                                                    $pagination .= "...";
                                                    $pagination .= "<a href=\"view_product.php?page=$lpm1&limit=$limit$SearchText\" class=my_pagination>$lpm1</a>";
                                                    $pagination .= "<a href=\"view_product.php?page=$lastpage&limit=$limit$SearchText\" class=my_pagination>$lastpage</a>";
                                                } //close to end; only hide early pages
                                                else {
                                                    $pagination .= "<a href=\"$view_product.php?page=1&limit=$limit$SearchText\" class=my_pagination>1</a>";
                                                    $pagination .= "<a href=\"$view_product.php?page=2&limit=$limit$SearchText\" class=my_pagination>2</a>";
                                                    $pagination .= "...";
                                                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                                                        if ($counter == $page)
                                                            $pagination .= "<span class=my_pagination >$counter</span>";
                                                        else
                                                            $pagination .= "<a href=\"$targetpage?page=$counter&limit=$limit$SearchText\" class=my_pagination>$counter</a>";
                                                    }
                                                }
                                            }
                                            //next button
                                            if ($page < $counter - 1)
                                                $pagination .= "<a href=\"view_product.php?page=$next&limit=$limit$SearchText\" class=my_pagination>Next</a>";
                                            else
                                                $pagination .= "<span class= my_pagination >Next</span>";
                                            $pagination .= "</div>\n";
                                        }
                                        ?>
                                        <tr>
                                            <th style="border-bottom: none;">No</th>
                                            <th>Num Lot</th>
                                            <th>Date de Prémption</th>
                                            <th>Stock (KG)</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        <?php
                                        $co1 = 0;
                                        $i = 1;
                                        $no = $page - 1;
                                        $no = $no * $limit;
                                        $prevArticle = "";
                                        while ($row = mysqli_fetch_array($result)) {
                                            $co1++;
                                            if($prevArticle != $row['name']){
                                        echo "<tr class='infotr'><td colspan='8' class='infotd textLeft'> &nbsp;&nbsp;".$row['name']."</td></tr>";
                                    } ?>
                                            <tr>
                                                <td> <?php echo $no + $i; ?></td>
                                                <td><?php echo $row['numLot']; ?></td>
                                                <td style="color:red;font-weight:bold;"><?php echo $row['date_premption']; ?></td>
                                                <td style="font-weight:bold;"><?php echo $row['quantity']; ?></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <?php
                                            $i++;
                                            $prevArticle = $row['name'];
                                        }
                                        ?>
                                        <table>
                                            <tr>
                                                <td align='right'style="width:20%"><?php $end = $no + $co1; ?>
                                                    Affichage de <?php echo $no + 1; ?> à <?php echo $end; ?> sur <?php echo $total_pages; ?></td><td>&nbsp;</td><td><?php echo $pagination; ?></td>
                                            </tr>
                                        </table>
                                    </table>
                        </div>
                    </div>
                    <div id="footer">
                        <p>
                        </p>
                    </div>
                    <!-- end footer -->
                    </body>
                    </html>
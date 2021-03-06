<?php
include_once("init.php");
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Azul - Catégories Stock</title>
        <!-- Stylesheets -->
        <!---->
        <link rel="stylesheet" href="css/style.css">
        <!-- Optimize for mobile devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!-- jQuery & JS files -->
        <?php include_once("tpl/common_js.php"); ?>
        <script src="js/script.js"></script>
        <script src="js/view_category.js"></script>
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

                            <h3 class="fl">Catégories Stock</h3>
                            <span class="fr expand-collapse-text">Cliquez pour réduire</span>
                            <span class="fr expand-collapse-text initial-expand">Cliquez pour agrandir</span>

                        </div>
                        <!-- end content-module-heading -->
                        <div class="content-module-main cf">
                        <?php
                                if(isset($_GET['msg'])) echo "<div class='confirmation-box round'>".$_GET['msg']."</div>";
                            ?>
                            <table>
                                <form action="" method="post" name="search">
                                    <input name="searchtxt" type="text" class="round my_text_box" placeholder="Recherche">
                                    &nbsp;&nbsp;<input name="Search" type="submit" class="my_button round blue text-upper" value="Rechercher">
                                </form>
                                <form action="" method="get" name="limit_go">
                                Lignes par Page<input name="limit" type="text" class="round my_text_box" id="search_limit" style="margin-left:5px;" value="<?php if (isset($_GET['limit'])) echo $_GET['limit']; else echo "10"; ?>" size="3" maxlength="3">
                                    <input name="go" type="button" value="Go" class=" round blue my_button  text-upper" onclick="return confirmLimitSubmit()">
                                </form>
                                <form name="deletefiles" action="delete.php" method="post">
                                    <input type="hidden" name="table" value="category_details">
                                    <input type="hidden" name="return" value="view_category.php">
                                    <!-- <input type="button" name="selectall" value="SelectAll"
                                           class="my_button round blue   text-upper" onClick="checkAll()" style="margin-left:5px;"/> -->
                                    <!-- <input type="button" name="unselectall" value="DeSelectAll"
                                           class="my_button round blue   text-upper" onClick="uncheckAll()" style="margin-left:5px;"/> -->
                                    <input name="dsubmit" type="button" value="Supprimer Selection"
                                           class="my_button round blue   text-upper" style="margin-left:5px;" onclick="return confirmDeleteSubmit()"/>
                                    <table>
                                        <?php
                                        /*$SQL = "SELECT * FROM  category_details ORDER BY id DESC";
                                        if (isset($_POST['Search']) AND trim($_POST['searchtxt']) != "") {
                                            $SQL = "SELECT * FROM  category_details WHERE category_name LIKE '%" . $_POST['searchtxt'] . "%' ORDER BY id DESC ";
                                        }*/
                                        $tbl_name = "category_details";        //your table name
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
                                        $query = "SELECT COUNT(*) as num FROM $tbl_name";
                                        if (isset($_POST['Search']) AND trim($_POST['searchtxt']) != "") {
                                            $query = "SELECT COUNT(*) as num FROM  category_details WHERE category_name LIKE '%" . $_POST['searchtxt'] . "%' ";
                                            $SearchText = "&searchtxt=".$_POST['searchtxt'];
                                        }
                                        if(isset($_GET['searchtxt']) AND trim($_GET['searchtxt']) != "" ){
                                            $SearchText = "&searchtxt=".$_GET['searchtxt'];
                                            $query = "SELECT COUNT(*) as num FROM  category_details WHERE category_name LIKE '%" . $_GET['searchtxt'] . "%' ";
                                        }
                                        $total_pages = mysqli_fetch_array(mysqli_query($db->connection, $query));
                                        $total_pages = $total_pages['num'];
                                        /* Setup vars for query. */
                                        $targetpage = "view_category.php";    //your file name  (the name of this file)
                                        $limit = 10;                                //how many items to show per page
                                        if (isset($_GET['limit']) && is_numeric($_GET['limit'])) {
                                            $limit = $_GET['limit'];
                                            $_GET['limit'] = 10;
                                        }
                                        $page = isset($_GET['page']) ? $_GET['page'] : 0;
                                        if ($page)
                                            $start = ($page - 1) * $limit;            //first item to display on this page
                                        else
                                            $start = 0;                                //if no page var is given, set start to 0
                                            /* Get data. */
                                        $sql = "SELECT * FROM category_details ORDER BY id DESC LIMIT $start, $limit  ";
                                        if (isset($_POST['Search']) AND trim($_POST['searchtxt']) != "") {
                                            $sql = "SELECT * FROM  category_details WHERE category_name LIKE '%" . $_POST['searchtxt'] . "%' ORDER BY id DESC LIMIT $start, $limit";
                                        }
                                        if(isset($_GET['searchtxt']) AND trim($_GET['searchtxt']) != "" ){
                                            $sql = "SELECT * FROM  category_details WHERE category_name LIKE '%" . $_GET['searchtxt'] . "%' ORDER BY id DESC LIMIT $start, $limit";
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
                                                $pagination .= "<a href=\"view_category.php?page=$prev&limit=$limit$SearchText\" class=my_pagination >Previous</a>";
                                            else
                                                $pagination .= "<span class=my_pagination>Previous</span>";
                                            //pages
                                            if ($lastpage < 7 + ($adjacents * 2)) {    //not enough pages to bother breaking it up

                                                for ($counter = 1; $counter <= $lastpage; $counter++) {

                                                    if ($counter == $page)
                                                        $pagination .= "<span class=my_pagination>$counter</span>";
                                                    else
                                                        $pagination .= "<a href=\"view_category.php?page=$counter&limit=$limit$SearchText\" class=my_pagination>$counter</a>";
                                                }
                                            } elseif ($lastpage > 5 + ($adjacents * 2)) {    //enough pages to hide some

                                                //close to beginning; only hide later pages

                                                if ($page < 1 + ($adjacents * 2)) {

                                                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {

                                                        if ($counter == $page)
                                                            $pagination .= "<span class=my_pagination>$counter</span>";
                                                        else
                                                            $pagination .= "<a href=\"view_category.php?page=$counter&limit=$limit$SearchText\" class=my_pagination>$counter</a>";
                                                    }

                                                    $pagination .= "...";

                                                    $pagination .= "<a href=\"view_category.php?page=$lpm1&limit=$limit\" class=my_pagination>$lpm1</a>";

                                                    $pagination .= "<a href=\"view_category.php?page=$lastpage&limit=$limit$SearchText\" class=my_pagination>$lastpage</a>";
                                                } //in middle; hide some front and some back

                                                elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                                                    $pagination .= "<a href=\"view_category.php?page=1&limit=$limit$SearchText\" class=my_pagination>1</a>";

                                                    $pagination .= "<a href=\"view_category.php?page=2&limit=$limit$SearchText\" class=my_pagination>2</a>";

                                                    $pagination .= "...";

                                                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {

                                                        if ($counter == $page)
                                                            $pagination .= "<span  class=my_pagination>$counter</span>";
                                                        else
                                                            $pagination .= "<a href=\"view_category.php?page=$counter&limit=$limit$SearchText\" class=my_pagination>$counter</a>";
                                                    }

                                                    $pagination .= "...";

                                                    $pagination .= "<a href=\"view_category.php?page=$lpm1&limit=$limit$SearchText\" class=my_pagination>$lpm1</a>";

                                                    $pagination .= "<a href=\"view_category.php?page=$lastpage&limit=$limit$SearchText\" class=my_pagination>$lastpage</a>";
                                                } //close to end; only hide early pages

                                                else {

                                                    $pagination .= "<a href=\"$view_category.php?page=1&limit=$limit$SearchText\" class=my_pagination>1</a>";

                                                    $pagination .= "<a href=\"$view_category.php?page=2&limit=$limit$SearchText\" class=my_pagination>2</a>";

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
                                                $pagination .= "<a href=\"view_category.php?page=$next&limit=$limit$SearchText\" class=my_pagination>Next</a>";
                                            else
                                                $pagination .= "<span class= my_pagination >Next</span>";

                                            $pagination .= "</div>\n";
                                        }
                                        ?>
                                        <tr>
                                            <th>No</th>
                                            <th>Nom</th>
                                            <th>déscription</th>
                                            <th>Modifier / Supprimer</th>
                                            <th>Sélectionner</th>
                                        </tr>

                                        <?php
                                        //count no of recards
                                        //$co = 0;
                                        $co1 = 0;
                                        /*$s = mysqli_query($db->connection, "select * from category_details");
                                        while ($r = mysqli_fetch_array($s)) {
                                            $co++;
                                        }*/

                                        $i = 1;
                                        $no = $page - 1;
                                        $no = $no * $limit;


                                        while ($row = mysqli_fetch_array($result)) {
                                            $co1++;
                                            ?>
                                            <tr>
                                                <td> <?php echo $no + $i; ?></td>

                                                <td><?php echo $row['category_name']; ?></td>
                                                <td> <?php echo $row['category_description']; ?></td>
                                                <td>
                                                    <a href="update_category.php?sid=<?php echo $row['id']; ?>&table=category_details&return=view_category.php"
                                                       class="table-actions-button ic-table-edit">
                                                    </a>
                                                    <!-- <a onclick="return confirmSubmit()"
                                                       href="delete.php?id=<?php //echo $row['id']; ?>&table=category_details&return=view_category.php"
                                                       class="table-actions-button ic-table-delete"></a> -->
                                                </td>
                                                <td><input type="checkbox" value="<?php echo $row['id']; ?>" name="checklist[]"
                                                           id="check_box"/></td>

                                            </tr>
    <?php $i++;
}
?>
                                        <table>
                                            <tr>
                                                <td align='right'style="width:20%"><?php $end = $no + $co1; ?>
                                                    Affichage de <?php echo $no + 1; ?> à <?php echo $end; ?> sur <?php echo $total_pages; ?></td><td >&nbsp;</td><td><?php echo $pagination; ?></td>
                                            </tr>


                                        </table>
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
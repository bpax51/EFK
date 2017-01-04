<?php
include_once("init.php");

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Azul - Voir Sorties</title>
    <!-- Stylesheets -->
    <!---->
    <link rel="stylesheet" href="css/style.css">
    <!-- Optimize for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- jQuery & JS files -->
    <?php include_once("tpl/common_js.php"); ?>
    <script src="js/script.js"></script>
    <script src="js/view_sales.js"></script>
<script>
	//var c=sessionStorage.getItem('checked-checkboxesviewsales');
	//alert(c);
</script>
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
            <li><a href="view_purchase.php" class=" purchase-tab">Entrées</a></li>
            <li><a href="view_sales.php" class="active-tab sales-tab">Sorties</a></li>
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

            <h3>Sorties</h3>
            <ul>
                <li><a href="add_sales.php">Ajout Sortie</a></li>
                <li><a href="view_sales.php">Voir Sorties</a></li>

            </ul>

        </div>
        <!-- end side-menu -->

        <div class="side-content fr">

            <div class="content-module">

                <div class="content-module-heading cf">

                    <h3 class="fl">Sorties</h3>
                    <span class="fr expand-collapse-text">Cliquez pour réduire</span>
<span class="fr expand-collapse-text initial-expand">Cliquez pour agrandir</span>

                </div>
                <!-- end content-module-heading -->

                <div class="content-module-main cf">


                    <table>
                        <form action="" method="post" name="search">
                            <input name="searchtxt" type="text" class="round my_text_box" placeholder="Recherche">
                            &nbsp;&nbsp;<input name="Search" type="submit" class="my_button round blue   text-upper" value="Rechercher">
                        </form>
                        <form action="" method="get" name="limit_go"> Lignes par Page<input name="limit" type="text" class="round my_text_box" id="search_limit" style="margin-left:5px;" value="<?php if (isset($_GET['limit'])) echo $_GET['limit']; else echo "100"; ?>" size="3" maxlength="3">
                            <input name="go" type="button" value="Go" class=" round blue my_button  text-upper" onclick="return confirmLimitSubmit()">
                        </form>
                        <form name="deletefiles" action="delete.php" method="post">
                            <input type="hidden" name="table" value="stock_sales">
                            <input type="hidden" name="return" value="view_sales.php">
                            <table id="tblDisplay">
                                <?php
                                /*$SQL = "SELECT DISTINCT(transactionid) FROM  stock_sales ORDER BY id DESC ";
                                if (isset($_POST['Search']) AND trim($_POST['searchtxt']) != "") {
                                    $SQL = "SELECT DISTINCT(transactionid) FROM  stock_sales WHERE stock_name LIKE '%" . $_POST['searchtxt'] . "%' ORDER BY id DESC ";
                                }*/
                                $tbl_name = "stock_sales";        //your table name
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
                                $query = "SELECT COUNT(transactionid) as num FROM $tbl_name ";
                                if (isset($_POST['Search']) AND trim($_POST['searchtxt']) != "") {
                                    $query = "SELECT COUNT(transactionid) as num FROM stock_sales WHERE stock_name LIKE '%" . $_POST['searchtxt'] . "%' OR transactionid LIKE '%" . $_POST['searchtxt'] . "%' OR numLot LIKE '%" . $_POST['searchtxt'] . "%' OR date LIKE '%" . $_POST['searchtxt'] . "%' ";
                                    $SearchText = "&searchtxt=".$_POST['searchtxt'];
                                }
                                if(isset($_GET['searchtxt']) AND trim($_GET['searchtxt']) != "" ){
                                            $SearchText = "&searchtxt=".$_GET['searchtxt'];
                                            $query = "SELECT COUNT(transactionid) as num FROM stock_sales WHERE stock_name LIKE '%" . $_POST['searchtxt'] . "%' OR transactionid LIKE '%" . $_POST['searchtxt'] . "%' OR numLot LIKE '%" . $_POST['searchtxt'] . "%' OR date LIKE '%" . $_POST['searchtxt'] . "%'";
                                        }

                                $total_pages = mysqli_fetch_array(mysqli_query($db->connection, $query));
                                $total_pages = $total_pages['num'];
                                /* Setup vars for query. */
                                $targetpage = "view_sales.php";    //your file name  (the name of this file)
                                $limit = 100;                                //how many items to show per page
                                if (isset($_GET['limit']) && is_numeric($_GET['limit'])) {
                                    $limit = $_GET['limit'];
                                    $_GET['limit'] = 100;
                                }
                                $page = isset($_GET['page']) ? $_GET['page'] : 0;
                                if ($page)
                                    $start = ($page - 1) * $limit;            //first item to display on this page
                                else
                                    $start = 0;                                //if no page var is given, set start to 0
                                /* Get data. */
								//Count number of records
								//$co=0;
								$co1=0;
								/*$s=mysqli_query($db->connection, "select * from stock_sales");
								while($r= mysqli_fetch_array($s))
								{
									$co++;
								}*/
                                $sql = "SELECT * FROM stock_sales ORDER BY id desc LIMIT $start, $limit  ";
                                if (isset($_POST['Search']) AND trim($_POST['searchtxt']) != "") {
                                    $sql = "SELECT * FROM stock_sales WHERE stock_name LIKE '%" . $_POST['searchtxt'] . "%' OR transactionid LIKE '%" . $_POST['searchtxt'] . "%' OR numLot LIKE '%" . $_POST['searchtxt'] . "%' OR date LIKE '%" . $_POST['searchtxt'] . "%'  ORDER BY id desc LIMIT $start, $limit";
                                }
                                if(isset($_GET['searchtxt']) AND trim($_GET['searchtxt']) != "" ){
                                            $sql = "SELECT * FROM stock_sales WHERE stock_name LIKE '%" . $_POST['searchtxt'] . "%' OR transactionid LIKE '%" . $_POST['searchtxt'] . "%' OR numLot LIKE '%" . $_POST['searchtxt'] . "%' OR date LIKE '%" . $_POST['searchtxt'] . "%'  ORDER BY id desc LIMIT $start, $limit";
                                        }
                                $result = mysqli_query($db->connection, $sql);
                                /* Setup page vars for display. */
                                if ($page == 0) $page = 1;                    //if no page var is given, default to 1.
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
                                        $pagination .= "<a href=\"view_sales.php?page=$prev&limit=$limit$SearchText\" class=my_pagination >Previous</a>";
                                    else

                                        $pagination .= "<span class=my_pagination>Previous</span>";


                                    //pages

                                    if ($lastpage < 7 + ($adjacents * 2))    //not enough pages to bother breaking it up

                                    {

                                        for ($counter = 1; $counter <= $lastpage; $counter++) {

                                            if ($counter == $page)

                                                $pagination .= "<span class=my_pagination>$counter</span>";

                                            else

                                                $pagination .= "<a href=\"view_sales.php?page=$counter&limit=$limit$SearchText\" class=my_pagination>$counter</a>";

                                        }

                                    } elseif ($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some

                                    {

                                        //close to beginning; only hide later pages

                                        if ($page < 1 + ($adjacents * 2)) {

                                            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {

                                                if ($counter == $page)

                                                    $pagination .= "<span class=my_pagination>$counter</span>";

                                                else

                                                    $pagination .= "<a href=\"view_sales.php?page=$counter&limit=$limit$SearchText\" class=my_pagination>$counter</a>";

                                            }

                                            $pagination .= "...";

                                            $pagination .= "<a href=\"view_sales.php?page=$lpm1&limit=$limit$SearchText\" class=my_pagination>$lpm1</a>";

                                            $pagination .= "<a href=\"view_sales.php?page=$lastpage&limit=$limit$SearchText\" class=my_pagination>$lastpage</a>";

                                        } //in middle; hide some front and some back

                                        elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                                            $pagination .= "<a href=\"view_sales.php?page=1&limit=$limit$SearchText\" class=my_pagination>1</a>";

                                            $pagination .= "<a href=\"view_sales.php?page=2&limit=$limit$SearchText\" class=my_pagination>2</a>";

                                            $pagination .= "...";

                                            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {

                                                if ($counter == $page)

                                                    $pagination .= "<span  class=my_pagination>$counter</span>";

                                                else

                                                    $pagination .= "<a href=\"view_sales.php?page=$counter&limit=$limit$SearchText\" class=my_pagination>$counter</a>";

                                            }

                                            $pagination .= "...";

                                            $pagination .= "<a href=\"view_sales.php?page=$lpm1&limit=$limit$SearchText\" class=my_pagination>$lpm1</a>";

                                            $pagination .= "<a href=\"view_sales.php?page=$lastpage&limit=$limit$SearchText\" class=my_pagination>$lastpage</a>";

                                        } //close to end; only hide early pages

                                        else {

                                            $pagination .= "<a href=\"$view_sales.php?page=1&limit=$limit$SearchText\" class=my_pagination>1</a>";

                                            $pagination .= "<a href=\"$view_sales.php?page=2&limit=$limit$SearchText\" class=my_pagination>2</a>";

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

                                        $pagination .= "<a href=\"view_sales.php?page=$next&limit=$limit$SearchText\" class=my_pagination>Next</a>";

                                    else

                                        $pagination .= "<span class= my_pagination >Next</span>";

                                    $pagination .= "</div>\n";

                                }

                                ?>
                                <tr>
                                    <th style="border-bottom: none;">No</th>
                                    <th>Article</th>
                                    <th>NumLot</th>
                                    <th>Quantité</th>
                                    <th style="width:25px !important;"></th>
                                </tr>
                                <?php
                                $count=0;
								$i = 1;
                                $no = $page - 1;
                                $no = $no * $limit;
                                $prevSale = "";
                                while ($row = mysqli_fetch_array($result)) {
									$count++;
									$co1++;
                                    if($prevSale != $row['transactionid']){
                                        $line = $db->queryUniqueObject("SELECT * FROM sorties WHERE id_sortie='".$row['transactionid']."'");
                                        if ($line){
                                        echo "<tr class='infotr'><td class='infotd'>".$line->id_sortie."</td><td colspan='3' class='infotd'> ".$line->commercial." | ".$line->date." | <span class='description'>".$line->description."</span></td>";
                                    ?>
                                    <td class='infotd'>
                                        <img src="images/print3.png" onclick="window.open('add_sales_print.php?sid=<?php echo $row['transactionid'];?>','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');" style="cursor:pointer;">
                                        </td></tr>
                                    <?php }} ?>
                                    <tr>
                                        <td> <?php echo $no + $i;?></td>
                                        <td> <?php echo $row['stock_name'];?></td>
                                        <td> <?php echo $row['numLot'];?></td>
                                        <td> <?php echo $row['quantity'];?></td>
                                        <td> &nbsp;</td>
                                    </tr>
                                    <?php $i++;
                                    $prevSale = $row['transactionid'];
                                } ?>
                                <tr>
                                </tr>
                                <table>
                                    <tr>
                                    <td align='right'style="width:20%"><?php $end=$no+$co1;?>
                                        <?php if($end == '0'){?>
                                            Affichage de <?php echo $no;?> à <?php echo $end;?> sur <?php echo $total_pages;?> lignes</td><td >&nbsp;</td><td><?php echo $pagination; ?></td>
                                <?php }else{?>
                                    Showing <?php echo $no+1; ;?> to <?php echo $end;?> of <?php echo $total_pages;?> entries</td><td >&nbsp;</td><td><?php echo $pagination; ?></td>
                                <?php }?>
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

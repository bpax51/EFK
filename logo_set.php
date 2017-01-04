<?php session_start();

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Azul - Store Logo</title>

    <!-- Stylesheets -->

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cmxform.css">
    <!--<link rel="stylesheet" href="js/lib/validationEngine.jquery.css">-->

    <!-- Scripts -->
    <script src="js/lib/jquery.min.js" type="text/javascript"></script>
    <script src="js/lib/jquery.validate.min.js" type="text/javascript"></script>
    <script src="js/logo_set.js"></script>

    <!-- Optimize for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

<!--    Only Index Page for Analytics   -->

<!-- TOP BAR -->
<div id="top-bar">

    <div class="page-full-width">

        <!--<a href="#" class="round button dark ic-left-arrow image-left ">See shortcuts</a>-->

    </div>
    <!-- end full-width -->

</div>
<!-- end top-bar -->


<!-- HEADER -->
<div id="header">

    <div class="page-full-width cf">

        <div id="login-intro" class="fl">

            <h1>Upload Logo </h1>


        </div>
        <!-- login-intro -->

        <!-- Change this image to your own company's logo -->
        <!-- The logo will automatically be resized to 39px height. -->
        <a href="#" id="company-branding" class="fr"><img src="<?php if (isset($_SESSION['logo'])) {
                echo "upload/" . $_SESSION['logo'];
            } else {
                echo "upload/posnic.png";
            } ?>" alt="Azul Fish"/></a>

    </div>
    <!-- end full-width -->

</div>
<!-- end header -->

<?php if (isset($_POST['submit'])) {

    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);
    if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/png"))
        && ($_FILES["file"]["size"] < 20000)
        && in_array($extension, $allowedExts)
    ) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
        } else {
            $upload = $_FILES["file"]["name"];
            $type = $_FILES["file"]["type"];


            if (isset($_SESSION['logo'])) {
                echo "upload/" . $_SESSION['logo'];
            } else {
                echo "upload/posnic.png";
            }
            if (file_exists("upload/" . $_FILES["file"]["name"])) {

                //echo $_FILES["file"]["name"] . " already exists. ";
            } else {

                $name = 'posnic.png';
                move_uploaded_file($_FILES["file"]["tmp_name"],
                    "images/" . $name);
                //echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
                $upload;
                include("lib/db.class.php");

                $host = $_SESSION['host'];
                $user = $_SESSION['user'];
                $pass = $_SESSION['pass'];
                $name = $_SESSION['db_name'];
                // Open the base (construct the object):
                $db = new DB($name, $host, $user, $pass);

                # Note that filters and validators are separate rule sets and method calls. There is a good reason for this.

                require "lib/gump.class.php";
                $db->query("UPDATE store_details  SET log ='" . $upload . "',type='" . $type . "'");
                echo "<script>window.location = 'index.php';</script>";
            }
        }
    } else {
        echo "<p  style='color:red;margin-left:550px;font-size:20px' >Invalid file</p>";
    }
}

?>


<!-- MAIN CONTENT -->
<div id="content">

    <form action="" method="POST" id="login-form" class="cmxform" enctype="multipart/form-data">
        <label for="file">Filename:</label>
        <input type="file" name="file" id="file"><br>
        <input type="submit" name="submit" value="Submit" class="button round blue image-right ic-right-arrow">
    </form>

</div>
<!-- end content -->


<!-- FOOTER -->
<div id="footer">
</div>
<!-- end footer -->

</body>
</html>


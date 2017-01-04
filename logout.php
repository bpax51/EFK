<?php
session_start();
session_destroy();
unset($_SESSION["id"]);
unset($_SESSION["username"]);
unset($_SESSION["usertype"]);
header("location: index.php?msg=Vous%20avez%20été%20déconnecté!&type=information");
?>
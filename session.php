<?php
session_start(); // Use session variable on this page. This function must put on the top of page.
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') { // if session variable "username" does not exist.
    header("location: index.php?msg=Merci%20de%20vous%20identifier%20pour%20accéder%20à%20cette%20interface!"); // Re-direct to index.php
}

include("lib/db.class.php");
include_once "config.php";


?>
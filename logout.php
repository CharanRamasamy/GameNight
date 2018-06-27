<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04-06-2018
 * Time: 04:35
 */

// Start the session
session_start();
$_SESSION = array();
session_destroy();

header("location:login.php");
?>
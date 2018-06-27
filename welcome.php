<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04-06-2018
 * Time: 04:35
 */

// Start the session
session_start();


if( !isset($_SESSION["name"]) ){
    header("location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<!--     header    -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Night</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<!--     body  with header    -->

<body>

<header class="group container">

    <h1 class="icon">
        <a href="index.php">Game <br> Night</a>
    </h1>

    <nav class="row-1-4">
        <ul>
            <li><a href="index.php">Home</a></li><!--
          -->
            <li><a href="contact.php">Contact</a></li><!--
          -->
            <li><a href="login.php">Log out</a></li>
        </ul>
    </nav>

</header>

<!--  Section -->
<section class="welcome container">
    <div class="message"><h3>
    <?php
    echo "Welcome ".$_SESSION["name"].".";
    ?></h3>
    </div>
</section>

<!--     footer    -->

<footer class="group container footer">

    <small>@GameNight</small>

    <h3>All Night Gaming!</h3>

</footer>

</body>





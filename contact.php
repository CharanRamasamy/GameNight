<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<!--     head     -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games Night</title>
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
            <?php
            if(isset($_SESSION['name'])) {
                ?>
                <li><a href="index.php">Home</a></li><!--
          -->
                <li><a  class="contact" href="contact.php">Contact</a></li><!--
          -->
                <li><a href="logout.php">Log out</a></li>
                <?php
            }
            else{
                ?>
                <li><a href="index.php">Home</a></li><!--
          --><li><a href="login.php">Login</a></li><!--
          --><li><a href="register.php">Register</a></li><!--
          --><li><a class="contact" href="contact.php">Contact</a></li>
                <?php
            }
            ?>
        </ul>
    </nav>

</header>

<section class="welcome container">

    <h2>Sricharan Ramasamy</h2>

        <p>Mail: Sricharan.Ramasamy@dal.ca<br>Phone: +1 902-210-8472</p>

</section>

<!--     footer     -->

<footer class="group container footer">

    <small>@GameNight</small>

    <h3>All Night Gaming!</h3>

</footer>

</body>
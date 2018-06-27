<?php
// Start the session
session_start();
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
            <?php
            if(isset($_SESSION['name'])) {
                ?>
                <li><a class="index" href="index.php">Home</a></li><!--
          -->
                <li><a href="contact.php">Contact</a></li><!--
          -->
                <li><a href="logout.php">Log out</a></li>
                <?php
            }
            else{
            ?>
            <li><a class="index" href="index.php">Home</a></li><!--
          --><li><a href="login.php">Login</a></li><!--
          --><li><a href="register.php">Register</a></li><!--
          --><li><a href="contact.php">Contact</a></li>
            <?php
            }
            ?>
        </ul>
    </nav>

</header>

<!--  Section -->
<section class="welcome container">

    <h2>All Night Gaming!</h2>

    <?php
    if(isset($_SESSION['name'])) {
    ?>
    <p>Welcome to the world of gamers.<br>Stay tuned to get updates on upcoming Game Night In and around your place. Work Hard,Play Hard and Rock the Night for free</p>

        <?php
    }
    else{
    ?>
    <p>Welcome to the world of gamers.<br>Register for free to get full access to the world of ultimate championship tournaments. Get quick updates on whereabouts of the tournament.</p>

    <a class="button" href="register.php">Register</a>
        <?php
    }
    ?>
</section>

<section class="games grid">
    <div class="row-1-2 row-1-3 row-1-4 ">

        <h3>FIFA 18</h3>
        <!--  [5]"FIFA 14 Loses Online Services This October - DVS Gaming", DVS Gaming, 2018. [Online]. Available: https://www.dvsgaming.org/fifa-14-loses-online-services-this-october/. [Accessed: 05- Jun- 2018]. -->
        <img src="images/fifa.jpg" alt="Football game Fifa cover Messi">

        <h5>Play Fifa all Night and prove you are the best. Pick your favourite football club and end the tournament with a treble.</h5>

    </div><!-- GTA 5
     --><div class="row-1-2 row-1-3 row-1-4 ">

        <h3>GTA 5</h3>
        <!--  [3]"Rockstar Games", Rockstar Games, 2018. [Online]. Available: https://www.rockstargames.com/newswire/article/49291/grand-theft-auto-v-official-cover-art.html. [Accessed: 05- Jun- 2018]. -->
        <img src="images/gta.jpg" alt="Gta5 game night ps4">

        <h5>Roam with your friends and enemies in a same map. Beware of gunshots. Make the gamer world Remember your Name!</h5>

    </div><!-- COD
    --><div class="row-1-2 row-1-3 row-1-4 cod">

        <h3>Call of Duty WW2</h3>
        <!-- [4]"Wallpaper Call of Duty WWII, 4K, Games, #7364", Wallpapersite.com, 2018. [Online]. Available: https://wallpapersite.com/games/call-of-duty-wwii-4k-7364.html. [Accessed: 05- Jun- 2018]. -->
        <img src="images/cod.jpg" alt="Call of Duty game poster">

        <h5>Call of Duty world war 2 server is used by gamers in 200 different countries. Be a part of something grand and spectacular.</h5>

    </div>
</section>

<!--     footer    -->

<footer class="group container footer">

    <small>@GameNight</small>

    <h3>All Night Gaming!</h3>

</footer>

</body>
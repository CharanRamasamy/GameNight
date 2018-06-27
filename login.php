<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04-06-2018
 * Time: 04:35
 */

session_start();

if( isset($_SESSION["name"]) ){
    header("location:index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<!--     head     -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Night</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<!--     body  with header    -->

<body>

<?php

/* [1]"PHP 5 Form Validation", W3schools.com, 2018. [Online]. Available: https://www.w3schools.com/php/php_form_validation.asp. [Accessed: 05- Jun- 2018]. */

// define variables and set to empty values
$emailErr = $passwordErr =  $flagErr= $dBfirstname = $dBlastname = $dBemail = $dBpwd ="";
$email = $pwd = $salted = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is in proper format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid Email";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $pwd = test_input($_POST["password"]);
        // check if password is in proper format
        if (strlen($pwd) < 8) {
            $passwordErr = "Invalid Password";
        }
    }

    if (($emailErr == "") && ($passwordErr == "")) {

        include "includes/DBConnection.php";

        try {

            $stmt = $conn->prepare("SELECT firstname,lastname,email,pwd FROM a1_users WHERE email= (:email)");
            $stmt->bindParam(':email', $email);

            $stmt->execute();

            $result = $stmt->fetch();

            $dBfirstname = $result[0];
            $dBlastname = $result[1];
            $dBemail = $result[2];
            $dBpwd = $result[3];

        } catch (PDOException $e) {
            echo "<script type='text/javascript'>
                    alert('Network connection failed');
                    window.location = 'login.php';
                    </script>";
        }

        $conn = null;
         if (password_verify($pwd, $dBpwd)) {

             // Set session variables
             $_SESSION["name"] ="$dBfirstname $dBlastname";
             header('Location: welcome.php');
         }
         else
         {
            $flagErr = "Email Id and Password does not match";
         }

    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<header class="group container">

    <h1 class="icon">
        <a href="index.php">Game <br> Night</a>
    </h1>

    <nav class="row-1-4">
        <ul>
            <li><a href="index.php">Home</a></li><!--
          --><li><a class="login_nav" href="login.php">Login</a></li><!--
          --><li><a href="register.php">Register</a></li><!--
          --><li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

</header>

<!--     Form       -->
<section class="grid form-section login">
    <div class="row-2-3 register_bg">
        <h3>
        <!--  [6]Uxfree.com, 2018. [Online]. Available: https://www.uxfree.com/wp-content/uploads/2018/03/flat-keys-e-mail-login-security.jpg. [Accessed: 05- Jun- 2018]. -->
        <img src="images/login.jpg" alt="Login to go to welcome page"></h3>
    </div><!--

    --><div class="row-1-3">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        <fieldset class="login_field">

            <label>
                Email
                <input type="text" name="email" placeholder="Email" value="<?php echo $email;?>">
                <span class="error"><?php echo $emailErr;?><br></span>
                <br>
            </label>

            <label>
                Password
                <input type="password" name="password" placeholder="Password" value="<?php echo $pwd;?>">
                <span class="error"><?php
                    if($passwordErr!="")
                    echo $passwordErr;
                    else
                        echo $flagErr?><br></span>
                <br>
            </label>


            <input class="button btn" type="submit" name="submit" value="submit">

        </fieldset>

    </form>
    </div>
</section>

<!--     footer     -->

<footer class="group container footer">

    <small>@GameNight</small>

    <h3>All Night Gaming!</h3>

</footer>


</body>
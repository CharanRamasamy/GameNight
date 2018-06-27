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
    <title>Games Night</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<!--     body  with header    -->

<body>

<?php

/* [1]"PHP 5 Form Validation", W3schools.com, 2018. [Online]. Available: https://www.w3schools.com/php/php_form_validation.asp. [Accessed: 05- Jun- 2018]. */

// define variables and set to empty values
$firstnameErr = $lastnameErr = $emailErr = $passwordErr = $confirmpwdErr = $addressErr = $postalcodeErr = "";
$firstname = $lastname = $email = $pwd = $confirmpwd = $address = $postalcode = "";
$reg_success = "Registration successful";
$reg_error = "Email already registered!";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["firstname"])) {
        $firstnameErr = "Firstname is required";
    } else {
        $firstname = test_input($_POST["firstname"]);
        if (!preg_match("/^[a-zA-Z]*$/",$firstname)) {
            $firstnameErr = "Only letters accepted";
        }
    }

    if (empty($_POST["lastname"])) {
        $lastnameErr = "Lastname is required";
    } else {
        $lastname = test_input($_POST["lastname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)) {
            $lastnameErr = "Only letters,space,apostrophe and hyphen accepted";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is in proper format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Proper Email format required ex:email@dal.com";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $pwd = test_input($_POST["password"]);
        // check if password is in proper format
        if (strlen($pwd)<8) {
            $passwordErr = "Password should be atleast 8 characters";
        }
    }

    if (empty($_POST["confirmpassword"])) {
        $confirmpwdErr = "Password confirmation is required";
    } else {
        $confirmpwd = test_input($_POST["confirmpassword"]);
        // check if passwords are matching
        if ($pwd != $confirmpwd) {
            $confirmpwdErr = "Passwords are not matching";
        }
    }

        $address = test_input($_POST["address"]);
    if($address == "")
        $addressErr="";
        // check if address is in proper format
        else if (!preg_match("/^[a-zA-Z0-9 ]*$/",$address)) {
            $addressErr = "Address must contain only letters and numbers";
        }


        $postalcode = test_input($_POST["postalcode"]);
    if($postalcode == "")
        $postalcodeErr="";
        else if (!preg_match("/^[a-zA-Z0-9]{3}\s+[a-zA-Z0-9]{3}$/",$postalcode)) {
            $postalcodeErr = "Proper format is required ex: A0A 0A0";
        }

        if(($firstnameErr == "") && ($lastnameErr == "") && ($emailErr == "") && ($passwordErr == "") && ($confirmpwdErr == "") && ($addressErr == "") && ($postalcodeErr == "")) {

            include "includes/DBConnection.php";

            try {

                $salted = "cd923jkbfb".$pwd."spo97g";
                $hashed = password_hash($pwd, PASSWORD_DEFAULT);

                // prepare sql and bind parameters
                $stmt = $conn->prepare("INSERT INTO a1_users (firstname, lastname, email, pwd, street_address, postal_code)
                VALUES (:firstname, :lastname, :email, :pwd, :street_address, :postal_code)");
                $stmt->bindParam(':firstname', $firstname);
                $stmt->bindParam(':lastname', $lastname);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':pwd', $hashed);
                $stmt->bindParam(':street_address', $address);
                $stmt->bindParam(':postal_code', $postalcode);

                $stmt->execute();
            }
            catch(PDOException $e) {

                if ($e->getCode() == 23000)
                    $emailErr = "Email already registered";
                else {
                    echo "<script type='text/javascript'>
                    alert('Network connection failed');
                    window.location = 'register.php';
                    </script>";
                }
            }
            $conn = null;

            if($emailErr == "") {
                echo "<script type='text/javascript'>
            alert('$reg_success');
            window.location = 'login.php';
            </script>";
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
          --><li><a href="login.php">Login</a></li><!--
          --><li><a class="register_nav" href="register.php">Register</a></li><!--
          --><li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

</header>


<!--     Form       -->
<section class="grid form-section">

    <div class="row-2-3 register_bg">
    <h3>
        <!--  [7]Tcha-mn.com, 2018. [Online]. Available: http://tcha-mn.com/wp-content/uploads/2016/05/Register-now1.jpg. [Accessed: 05- Jun- 2018]. -->
        <img src="images/register.jpg" alt="Register now to get full accesss">
    </h3>
    </div><!--

    --><form class="row-1-3" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        <fieldset class="register">

            <label>
                First Name
                <input type="text" name="firstname" placeholder="First name" value="<?php echo $firstname;?>">
                <span class="error"><?php echo $firstnameErr;?><br></span>
                <br>
            </label>

            <label>
                Last Name
                <input type="text" name="lastname" placeholder="Last name" value="<?php echo $lastname;?>">
                <span class="error"><?php echo $lastnameErr;?><br></span>
                <br>
            </label>

            <label>
                Email
                <input type="text" name="email" placeholder="Email" value="<?php echo $email;?>">
                <span class="error"><?php echo $emailErr;?><br></span>
                <br>
            </label>

            <label>
                Password
                <input type="password" name="password" placeholder="Password" value="<?php echo $pwd;?>">
                <span class="error"><?php echo $passwordErr;?><br></span>
                <br>
            </label>

            <label>
                Confirm Password
                <input type="password" name="confirmpassword" placeholder="Confirm Password" value="<?php echo $confirmpwd;?>">
                <span class="error"><?php echo $confirmpwdErr;?><br></span>
                <br>
            </label>

            <label>
                Street Address
                <textarea name="address"></textarea>
                <span class="error"><?php echo $addressErr;?><br></span>
                <br>
            </label>

            <label>
                Postal code
                <input type="text" name="postalcode" placeholder="Postal code" value="<?php echo $postalcode;?>">
                <span class="error"><?php echo $postalcodeErr;?><br></span>
                <br>
            </label>

                <input class="button btn" type="submit" name="submit" value="submit">

        </fieldset>

    </form>
    
</section>

<!--     footer     -->

<footer class="group container footer">

    <small>@GameNight</small>

    <h3>All Night Gaming!</h3>

</footer>


</body>
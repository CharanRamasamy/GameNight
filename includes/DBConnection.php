<?php
$servername ="db.cs.dal.ca:3306";
$username ="sramasamy";
$password ="B00790079";
try{
    $conn =new PDO("mysql:host=$servername;dbname=sramasamy", $username, $password);
// set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "<script type='text/javascript'>
           alert('Network connection failed');
           window.location = 'index.php';
           </script>";
}

?>
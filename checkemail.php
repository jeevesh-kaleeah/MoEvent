<?php
include("dbconnect.php");
$email = $_POST["login_email"];
$sql = "SELECT * FROM users WHERE email = '$email';";
$result = mysqli_query($conn, $sql);

if($email ==""){
    echo "<div style='color: white; font-size: 1.2rem; text-align: center; font-style: Arial; font-weight: bold;'>please input email</div>";
}
else if (!(mysqli_num_rows($result) > 0)) {
    echo "<div style='color: white; font-size: 1.2rem; margin: 2px; text-align: center; font-style: Arial; font-weight: bold;'>Email not found. Please try again!</div>";
   // echo"email not found try again!";
}

mysqli_close($conn);
?>
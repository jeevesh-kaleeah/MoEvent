<?php

include("dbconnect.php");

if(isset($_POST["email"])) {
    $email = $_POST["email"];
    $sql = "SELECT * FROM users WHERE email = '$email';";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<div style='color: white; font-size: 1.2rem; text-align: center; font-style: Arial; font-weight: bold;'>Email not available. Please try another!</div>";
    }
}

mysqli_close($conn);
?>
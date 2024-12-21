<?php
include('dbconnect.php');
session_start();
$old_pwd = $_POST['current-password'];
$new_pwd = $_POST['new-password'];
$re_pwd = $_POST['confirm-password'];
$email = $_SESSION['email'];

$sql = "SELECT password FROM users WHERE email ='$email';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$current_password = $row['password'];

if ($old_pwd != $current_password) {
    echo "<script>alert('Incorrect password');</script>";
    header("refresh:0; url=myprofile.php");
} elseif ($new_pwd != $re_pwd) {
    echo "<script>alert('Passwords do not match');</script>";
    header("refresh:0; url=myprofile.php");
} 
else {
    // Update the password
    $update_sql = "UPDATE users SET password = '$new_pwd' WHERE email = '$email';";
    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('Password updated successfully');</script>";
        header("refresh:0; url=myprofile.php");
    } else {
        echo "<script>alert('Error updating password');</script>";
        header("refresh:0; url=myprofile.php");
    }
}
?>

<?php 
    include 'dbconnect.php';
    session_start();
    if(!isset($_SESSION['admin_name'])){
        header('Location: adminlogin.php');
        exit();
    }
    //to get the name of the admin 
    $adminName = $_SESSION['admin_name'];
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoEvent-Admin Panel</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="http://localhost/moEvent/style1.css">
    <!--Jquery library-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>
    
</head>

<body>
    <div class="container">

    <?php include('admin_sidebar.php');?>

     <div class="main">

     <?php include('admin_topbar.php');?> 
    
<?php
    include('dbconnect.php');

    $sql_cinema = "SELECT * FROM events WHERE type = 'cinema'";
    $result_cinema = mysqli_query($conn, $sql_cinema);

    $sql_concerts = "SELECT * FROM events WHERE type = 'concerts'";
    $result_concerts = mysqli_query($conn, $sql_concerts);

    $sql_shows = "SELECT * FROM events WHERE type = 'shows'";
    $result_shows = mysqli_query($conn, $sql_shows);

    mysqli_close($conn);
?>
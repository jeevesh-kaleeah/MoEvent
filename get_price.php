<?php
// Include your database connection file
include("dbconnect.php");

// Check if the option parameter is set
if (isset($_GET['option'])) {
    // Sanitize the input
    $option = mysqli_real_escape_string($conn, $_GET['option']);

    // Prepare and execute the query to fetch the price
    $sql = "SELECT price FROM events WHERE eventname = '$option'";
    $result = mysqli_query($conn, $sql);

    // Check if a row is returned
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $price = $row['price'];
        echo $price; // Return the price as a response
    } else {
        echo "0"; // Return 0 if no price is found
    }
} else {
    echo "0"; // Return 0 if option parameter is not set
}

// Close the database connection
mysqli_close($conn);
?>

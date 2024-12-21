<?php include('admin_header.php'); ?>
<?php

//deleting message from  database
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $sql_delete = "DELETE FROM inquirires WHERE id='$delete_id' ";
        $result_delete = mysqli_query($conn, $sql_delete);
        if($result_delete){
            header('Location:admin_inquiries.php');
            exit;
        } else {
            echo "Error deleting message:" .mysqli_error($conn);
        }

}
?>

   <section class="user-container">
        <h1 class="title"> Unread Messages</h1>
        <div class="box-container">
            <?php
                $select_messages = "SELECT * FROM inquiries";
                $result = mysqli_query($conn, $select_messages);
                if($result && mysqli_num_rows($result)>0) {
                    while($fetch_messages = mysqli_fetch_assoc($result)){
                        echo '<div class="box">';
                        echo '<p>Name: <span>'. $fetch_messages['name']. '</span></p>';
                        echo '<p>Phone number: <span>'. $fetch_messages['phone']. '</span></p>';
                        echo '<p>Email: <span>'. $fetch_messages['email']. '</span></p>';
                        echo '<p>Message: <span>'. $fetch_messages['message']. '</span></p>';
                        echo '<a href="admin_user.php?delete='.$fetch_messages['name']. ' "class="delete" onclick="return confirm(\'Delete this\')">Delete</a>';
                        echo '</div>';
                    } 
            }
                
            ?>
              
        </div>
    </section>
<!-- =========== Scripts =========  -->
<script src="http://localhost/moEvent/scripts.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
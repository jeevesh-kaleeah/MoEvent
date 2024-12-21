<?php include('admin_header.php'); ?>
<?php

//deleting admin from  database
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $sql_delete = "DELETE FROM admin WHERE id='$delete_id' ";
        $result_delete = mysqli_query($conn, $sql_delete);
        if($result_delete){
            header('Location:admin_user.php');
            exit;
        } else {
            echo "Error deleting user:" .mysqli_error($conn);
        }

}
?>

   <section class="user-container">
        <h1 class="title"> Total registered users</h1>
        <div class="box-container">
            <?php
                $select_admins = "SELECT * FROM admin";
                $result = mysqli_query($conn, $select_admins);
                if($result && mysqli_num_rows($result)>0) {
                    while($fetch_admins = mysqli_fetch_assoc($result)){
                        echo '<div class="box">';
                        echo '<p>admin id: <span>'. $fetch_admins['id']. '</span></p>';
                        echo '<p>name: <span>'. $fetch_admins['name']. '</span></p>';
                        echo '<p>email: <span>'. $fetch_admins['email']. '</span></p>';
                        echo '<a href="admin_user.php?delete='.$fetch_admins['id']. ' "class="delete" onclick="return confirm(\'delete this\')">Delete</a>';
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
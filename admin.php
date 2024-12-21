<?php include('admin_header.php'); ?>

            <div class="cardBox">
                <div class="card">
                    <div id="adminLink">
                    
                        <?php
                        $select_admins = "SELECT * FROM admin";
                        $result_admins = mysqli_query($conn, $select_admins);
                        $num_admins = mysqli_num_rows($result_admins);
                        ?>

                        
                        <div class="numbers"> <?php echo $num_admins; ?> </div>
                        <div class="cardName">Total admins</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="people-circle-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div id="messageLink">
                    
                        <?php
                        $select_messages = "SELECT * FROM admin";
                        $result_messages = mysqli_query($conn, $select_messages);
                        $num_messages = mysqli_num_rows($result_messages);
                        ?>

                    
                        <div class="numbers"> <?php echo $num_messages; ?> </div>
                        <div class="cardName">Total messages</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div id="priceLink">
                        <?php 
                        $sql = "SELECT SUM(price) AS total_price FROM checkout";
                        $result = mysqli_query($conn, $sql);
                        
                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $totalPrice = $row['total_price'];
                            
                        } 
                        ?>
                        <div class="numbers"><?php echo $totalPrice; ?></div>
                        <div class="cardName">Total Earnings</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>
  
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="http://localhost/moEvent/scripts.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
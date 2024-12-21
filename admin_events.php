<?php include('admin_header.php'); ?>

<?php
$event_type = '';
//this checks if the form was submitted and add new event to database
    if(isset($_POST['add_event'])){
        $event_name = mysqli_real_escape_string($conn, $_POST['eventname']);
        $event_type = mysqli_real_escape_string($conn, $_POST['type']);
        
        //this will set columns genre and duration null for concerts
        $event_genre = 
        ($_POST['genre'] == 'concert') ? null : mysqli_real_escape_string($conn, $_POST['genre']);

        $event_duration = 
        ($_POST['duration'] == 'concert') ? null: mysqli_real_escape_string($conn, $_POST['duration']);

        $event_price = mysqli_real_escape_string($conn, $_POST['price']);
        $event_date = mysqli_real_escape_string($conn, $_POST['date']);
        $event_time = mysqli_real_escape_string($conn, $_POST['time']);
        
        //here, when type is concert, the info column will be null
        $event_info = 
        ($_POST['type'] == 'concert') ? null : mysqli_real_escape_string($conn, $_POST['info']);
        
        $event_location = mysqli_real_escape_string($conn, $_POST['location']);
        $event_description = mysqli_real_escape_string($conn, $_POST['description']);
        
        $cardImage = $_FILES['cardImage']['name'];
        $cardImage_tmp_name = $_FILES['cardImage']['tmp_name'];
        $cardImage_folder = 'images/'.$cardImage;
        
        $backgroundImage = $_FILES['backgroundImage']['name'];
        $backgroundImage_tmp_name = $_FILES['backgroundImage']['tmp_name'];
        $backgroundImage_folder = 'images/'.$backgroundImage;

        //check if event name already exists
        $sql_eventname = "SELECT eventname FROM events WHERE eventname='$event_name'";
        $results = mysqli_query($conn, $sql_eventname);
        
        if($results){
            if(mysqli_num_rows($results)>0){
               $message[] = 'Event already exists';
            
            } else {

                $insertEvent = "INSERT INTO events(eventname, type, genre, duration, price, date, time, info, location, description, cardImage, backgroundImage)
              VALUES ('$event_name', '$event_type', '$event_genre', '$event_duration', '$event_price', '$event_date', '$event_time', '$event_info', '$event_location', '$event_description', '$cardImage', '$backgroundImage')";
           
            if(mysqli_query($conn, $insertEvent)){
                move_uploaded_file($cardImage_tmp_name, $cardImage_folder);
                move_uploaded_file($backgroundImage_tmp_name, $backgroundImage_folder);
            
                $message[] = 'Event added successfully.';
           }else {
                $message[] = 'Error adding event: ' . mysqli_error($conn);
        }
           
        }
    } else {
        $message[] = 'Error checking event name: ' . mysqli_error($conn);
    }
}

/*deleting events from database*/
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $select_deleteImage = ("SELECT cardImage, backgroundImage FROM events WHERE id=$delete_id");
    $result_select = mysqli_query($conn, $select_deleteImage);

    if($result_select){
        $fetch_deleteImage = mysqli_fetch_assoc($result_select);
        unlink('images/' .$fetch_deleteImage['cardImage']);
        unlink('images/' .$fetch_deleteBImage['backgroundImage']);

    }

    $sql_delete = "DELETE FROM events WHERE id='$delete_id' ";
    $result_delete = mysqli_query($conn, $sql_delete);
    if($result_delete){
        header('Location:admin_events.php');
        exit;
    } else {
        echo "Error deleting event:" .mysqli_error($conn);
    }

}

?>
    <!--------add event section----------->
   <section class="add-events">
   <?php
        if (isset($message)){
            foreach($message as $message) {
                echo '
                    <div class="message">
                        <span>'.$message. '</span>
                        <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div>'
                ;    
            }
        }
        ?>
   <form name="addeventsform" action="" method="post" enctype="multipart/form-data">
    <!--we use enctype multipart as we have to insert images-->
        <div class="formHeader">
        <h1>Add Events</h1>
        <a id="viewEvents" class="btn"> View Events </a>
        </div>
            <div class="input-fields">
                <label>Name:</label>
                <input type="text"  name="eventname" required>
            </div>

            <div class="input-fields">
                <label>Category:</label>
                <select id="type"  name="type">
                    <option value="cinema">Cinema</option>
                    <option value="concerts">Concerts</option>
                    <option value="shows">Shows</option>
                </select>
            </div>

            <div class="input-fields">
                <label>Genre:</label>
                <input id="genreInput" type="text"  name="genre" <?php echo ($event_type == 'concert') ? 'disabled' : ''; ?>>
            </div>

            <div class="input-fields">
                <label>Duration:</label>
                <input id="durationInput" type="text"  name="duration" <?php echo ($event_type == 'concert') ? 'disabled' : ''; ?>>
            </div>

        <div class="input-fields">
            <label>Price:</label>
            <input type="text"  name="price" required>
        </div>
       

        <div class="input-fields">
            <label>Date:</label>
            <input type="date"  name="date" required>
        </div>

        <div class="input-fields">
            <label>Time:</label>
            <input type="time"  name="time" required>
        </div>

        <div class="input-fields">
            <label>Info:</label>
            <input id="infoInput" type="text"  name="info" <?php echo ($event_type == 'concert') ? 'disabled' : ''; ?>>
        </div>

        <div class="input-fields">
            <label>Location:</label>
            <input type="text"  name="location" required>
        </div>

        <div class="input-fields">
            <label>Description:</label>
            <textarea name="description" required></textarea>
        </div>

        <div class="input-fields">
            <label>Card Image:</label>
            <input type="file"  name="cardImage" accept="image/jpg" required>
        </div>

        <div class="input-fields">
            <label>Event Image:</label>
            <input type="file"  name="backgroundImage" accept="image/jpg" required>
        </div>
       
        <input type="submit"  name="add_event" value="Add Event" class="btn">
    </form>    
    </section>

    <!-------show events section--------->
    <section class="show-events">
        <div class="event-box" style="display: flex; flex-wrap: wrap;">
            <?php
                $select_events = "SELECT * FROM events";
                $result = mysqli_query($conn, $select_events);
                if($result && mysqli_num_rows($result)>0) {
                    while($fetch_events = mysqli_fetch_assoc($result)){
                        echo '<div class="ebox">' ;
                        //echo '<img src="images/' .$fetch_events['cardImage']. '">';
                        echo '<p>Event Name: <span>'. $fetch_events['eventname']. '</span></p>';
                        echo '<p>Type: <span>'. $fetch_events['type']. '</span></p>';
                        echo '<p>Genre: <span>'. $fetch_events['genre']. '</span></p>';
                        echo '<p>Duration: <span>'. $fetch_events['duration']. '</span></p>';
                        echo '<p>Price: <span>'. $fetch_events['price']. '</span></p>';
                        echo '<p>Date: <span>'. $fetch_events['date']. '</span></p>';
                        echo '<p>Time: <span>'. $fetch_events['time']. '</span></p>';
                        echo '<p>Info: <span>'. $fetch_events['info']. '</span></p>';
                        echo '<p>Location: <span>'. $fetch_events['location']. '</span></p>';
                        echo '<p>Description: <span>'. $fetch_events['description']. '</span></p>';
                        echo '<a href="admin_events.php?edit='.$fetch_events['id']. ' "class="edit">Edit</a>';
                        echo '<a href="admin_events.php?delete='.$fetch_events['id']. ' "class="eventdelete" onclick="return confirm(\'Are you sure you want to delete this event?\')">Delete</a>';
                        echo '</div>';
                    }
                }
            ?>
        </div>
    </section>

    <section class="edit-events">
        <?php
            if(isset($_GET['edit'])){
                $edit_id = $_GET['edit'];
                $editQuery = "SELECT * FROM events WHERE id=$edit_id";
                $result = mysqli_query($conn, $editQuery);

                if(mysqli_num_rows($result)>0){
                    while($fetch_edit = mysqli_fetch_assoc($result)){
        ?>
        <div class="event-update">
        <form action="" method="post" enctype="multipart/form-data">
            
            <input type="hidden" name="edit_id" value="<?php echo $fetch_edit['id']; ?>">
            <input type="text" name="edit_eventname" value="<?php echo $fetch_edit['eventname']; ?>">
            <input type="text" name="edit_type" value="<?php echo $fetch_edit['type']; ?>">
            <input type="text" name="edit_genre" value="<?php echo $fetch_edit['genre']; ?>">
            <input type="text" name="edit_duration" value="<?php echo $fetch_edit['duration']; ?>">
            <input type="text" name="edit_price" value="<?php echo $fetch_edit['price']; ?>">
            <input type="date" name="edit_date" value="<?php echo $fetch_edit['date']; ?>">
            <input type="time" name="edit_time" value="<?php echo $fetch_edit['time']; ?>">
            <input type="text" name="edit_info" value="<?php echo $fetch_edit['info']; ?>">
            <textarea name="edit_description"> <?php echo $fetch_edit['description']; ?> </textarea>
            <input type="submit" name="updateEvent" value="update" class="edit">
        
        </form> 
        </div>
        <?php           
                     }
                }
                echo "<script>document.querySelector('.edit-events').style.display = 'block'; </script>";
            }
        ?>
    </section>    
        
<!-- =========== Scripts =========  -->
<script src="http://localhost/moEvent/scripts.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
<?php
    include 'dbconnect.php';

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $repassword = mysqli_real_escape_string($conn, $_POST["cpassword"]);
        
        $sql = "SELECT * FROM admin WHERE email='$email'";
        $results = mysqli_query($conn, $sql);

        if (mysqli_num_rows($results)>0){
            $message[]='user already exists';
        } else {
            if ($password==$repassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $insertSql="INSERT INTO admin (name, email, password) VALUES ('$name', '$email', '$hash')";
                if(mysqli_query($conn, $insertSql)){
                    $message[]='registered successfully';
                    header("Location:adminlogin.php");
                    exit();
            } else {
                $message[]='Wrong password';
                }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Register</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="icon" href="logo/icon2.png"><!--logo for title-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><!--external css fontawesome-->
        <!--<a href="https://www.freepik.com/free-vector/landing-page-with-purple-gradient-landscape_5267485.htm#query=forest&position=2&from_view=search&track=sph">Image by pikisuperstar</a> on Freepik-->
    
        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body{
                background-image: url('Images/adminbackground.jpg');
                background-repeat: no-repeat;
                background-size: cover;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }
        </style>
    </head>


    <body>
        
        <div class="lgn_wrapper"> 
        <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '
                        <div class="message">
                            <span>'.$message.'</span>
                            <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                        </div>
                    ';
                }
            }
        ?>          
            <form name="adminloginfrm" action="" method="post">
                <h1>Admin Register</h1>
                <div class="input-box">
                    <input type="text" name="name" placeholder="Enter your name">
                    <br>
                </div>

                <div class="input-box">
                <input type="email"  name="email" placeholder="Example@gmail.com" required>
                <br>
                </div>

                <div class="input-box">
                <input type="password"  name="password" placeholder="password" required>
                <br>
                </div>

                <div class="input-box">
                <input type="password"  name="cpassword" placeholder="re enter your password" required>
                <br>
                </div>

                <button type="submit" class="lgn-btn">Register</button>
                <p>Already have an account? <a href="adminlogin.php">Login Now</a></p>
               
            </form>
        </div>

    </body>
</html>
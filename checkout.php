
<?php
session_start();
if (isset($_SESSION['login'])){
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="styles.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><!--external css fontawesome-->
		<link rel="icon" href="logo/icon2.png"><!--logo for title-->
		<title>Checkout</title>
		<script src="script.js"></script>		
	</head>
	
	<body class="register-main">
		
		<section class="sub-header">
		<div class="sub-container">
					<ul class="info">
						<li><i class="fa fa-envelope" aria-hidden="true"></i>moEvent@gmail.com</li>
						<li><i class="fa fa-map-marker" aria-hidden="true"></i>Ebene, Mauritius</li>
					</ul>
				
					<ul class="social-links">
						<li><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram foot-icon" aria-hidden="true"></i></a></li>
						<li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook foot-icon" aria-hidden="true"></i></a></li>
						<li><a href="https://www.whatsapp.com/" target="_blank"><i class="fa fa-whatsapp foot-icon" aria-hidden="true"></i></a></li>
						<li><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter foot-icon" aria-hidden="true"></i></a></li>
						<li><a href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube-play foot-icon" aria-hidden="true"></i></a></li>
					</ul>
				
			
		</div>
	</section>
	
<!--logo and navbar-->
    <header id="sticky-header">
        <div class="main-nav">
			<a href="index.html" class="logo" target="_blank">MoEvent.</a>
            <!-- Menu -->
			<ul class="nav">
				<li><a href="index.php">Home<span></span></a></li>
				<li><a href="#about-us">About<span></span></a></li>
				<li><a href="blog.html">Blog<span></span></a></li>
				<li><a href="checkout.php">Checkout<span></span></a></li>
				<li><a href="myprofile.php"><i class="fas fa-user"></i></a></li>
			</ul>
		</div>
	</header>
		<section class="registration-form">
			<form action="process_checkout.php" method="post" id="event-form" onsubmit="return validateregister()">
				<h1>checkout</h1>
				
					<select id="event-options" name="event-options" class="r-input" onchange="priceCalculator()">
					<option value="optiion">Select an event</option>
						<?php
						include("dbconnect.php");
						$sql = "SELECT eventname FROM events ORDER BY type";
						$result = mysqli_query($conn, $sql);

						while($row = mysqli_fetch_assoc($result)){?>
						<option value=<?php echo $row['eventname'];?>>
						<?php echo $row['eventname'];?></option>
						<?php } ?>

					</select> <br><br>
					
				<label for="ticket">number of tickets</label>
				<input type="number" id="ticket" class="r-input" name="quantity" min="1" max="10" onchange="priceCalculator()"> <br><br>


				<label for="screen">price MUR</label>
				<input type="text" id="screen" class="r-input" readonly><br><br>
				<input type="hidden" id="totalprice" class="r-input" name="totalprice">

				<input type="radio" name="payment" value="debit"> <label for="debit">debit card</label>
				<input type="radio" name="payment" value="paypal"> <label for="paypal">paypal</label>
				<input type="radio" name="payment" value="cash"> <label for="cash">cash</label> <br><br>
				
				
				<input type="submit" class="register-btn" value="checkout">
				<input type="reset" class="register-btn" value="reset">
			</form>
		</section>

		<script>
			function priceCalculator() {
				var num = parseInt(document.getElementById('ticket').value);
				var screen = document.getElementById('screen');
				var selectedOption = document.getElementById('event-options').value;

				// Make an AJAX request to fetch the price
				var xhr = new XMLHttpRequest();
				xhr.open('GET', 'get_price.php?option=' + encodeURIComponent(selectedOption), true);
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4 && xhr.status == 200) {
						var cost = parseInt(xhr.responseText);
						var price = cost * num;
						document.getElementById('screen').value = price;
					}
				};
				xhr.send();
			}
		</script>

	
		
		
		<footer>
		<!--social medias icons link /opens in another webpage-->
		<!--icons from external source fontawesome-->
		<div class="footer-content-1">
			<h5>USEFUL LINKS</h5>
			<a href="about.html">About us</a>
			<a href="blog.html">Blog</a>
			<a href="contact.html">Contact</a>
		</div>
		<div class="footer-content-2">
			<h5>NEWSLETTER</h5>
			<form name="subscribe_frm" action="#Register" method="POST">
				<input type="email" placeholder="Your Email Address" required>
				<br>
				<button type="submit">SUBSCRIBE NOW</button>
			</form>
		</div>
		<div class="footer-content-3">
			<h5>CONTACT INFORMATION</h5>
			<p class="copyright">&copy; 2023 Mo Event. All rights reserved.</p><br>
			<p>2nd Floor, Icon Tower, Ebene, Mauritius</p><br>
			<p>MoEvent@gmail.com</p>
			<br>
			<a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram foot-icon" aria-hidden="true"></i></a>
			<a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook foot-icon" aria-hidden="true"></i></a>
			<a href="https://www.whatsapp.com/" target="_blank"><i class="fa fa-whatsapp foot-icon" aria-hidden="true"></i></a>
			<a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter foot-icon" aria-hidden="true"></i></a>
			<a href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube-play foot-icon" aria-hidden="true"></i></a>
		</div>
	</body>

</html>

<?php
}
else{
	echo '<script>alert("you need to login to continue transaction!");</script>';
	header("refresh:0; url=login.html");
}
?>


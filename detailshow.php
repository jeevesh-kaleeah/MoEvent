<?php 
		include('dbconnect.php');
		if (isset($_GET['event_id'])) {
			$event_id = $_GET['event_id'];
			
			$sql = "SELECT * FROM events WHERE id = $event_id AND type = 'shows'"; 
			$result = mysqli_query($conn, $sql);
		
			if ($result && mysqli_num_rows($result) > 0) {
				$event_shows = mysqli_fetch_assoc($result);
				
				$backgroundImage_url = $event_shows['backgroundImage'];
				?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--add icon link-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><!--external css fontawesome-->
		<link rel="stylesheet" type="text/css" href="http://localhost/moEvent/style.css">
		<link rel="icon" href="logo/icon2.png"><!--logo for title-->
   		<title>MoEvent-Avatar</title>
		
   <style>
	
 
	body{
	  background-image:url("images/<?php echo $backgroundImage_url;?>");
	  background-repeat: no-repeat;
	  background-size: cover;
	  position:relative;
	}
	main::before{
	  content: '';
	  position: absolute;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	  background-color: rgba(0, 0, 0, 0.6);  /*Adjust the color and opacity as needed */
	  filter: blur(5px);
	  z-index: -1;
}
	</style>
</head>
<body>

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
			<a href="index.php" class="logo" target="_blank">MoEvent.</a>
            <!-- Menu -->
			<ul class="nav">
				<li><a href="index.php">Home<span></span></a></li>
				<li><a href="#about-us">About<span></span></a></li>
				<li><a href="contact.html">Contact<span></span></a></li>
				<li><a href="blog.html">Blog<span></span></a></li>
				<li><a href="registration.html">Register<span></span></a></li>
			</ul>
		</div>
	</header>
	
	<main>
		<section class="event-details" style="text-align: center;">
			<!--<div class="eventposter">-->
				<div class="event-img-container">
					<img src="images/<?php echo $event_shows['backgroundImage']; ?>" >
				</div>
				<h1 class="event-title" style="margin: 20px auto; font-size:30px; color:cyan;"><?php echo $event_shows['eventname']; ?></h1>
			
				<div class="info-events">
					<ul>
						<li><?php echo $event_shows['genre']; ?></li>
						<?php
                                $time = new DateTime($event_shows['time']);
                                echo '<li></i> Time: ' . $time->format('g:i A') . '</p>';
                                ?></li>
						<li><?php echo $event_shows['location']; ?></li>
					</ul>
					<br>
					<div class="duration-price">
						<p><?php echo $event_shows['duration']; ?></p>
						<p><?php echo $event_shows['price']; ?></p>
					</div>
					<div class="line"></div>
				
			
			
					<h3>Storyline</h3>
					<p><?php echo $event_shows['description']; ?></p>
				</div>
				<button class="cta-button" id="book"><a href="checkout.php">BOOK NOW</a></button>
				
			<!--</div>-->
		<section>
		<?php
			}
		} 
		?>
	</main>
	
	
	<footer>
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
	</footer>
</body>
</html>
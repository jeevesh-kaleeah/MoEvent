<?php 
    // Debugging: Check if parameters are received
    //if (!isset($_GET['event_id']) || !isset($_GET['category'])) {
       // echo "Missing parameters";
       // exit;
    //}

    // Get the event_id and category from the query parameters
    $eventId = $_GET['event_id'];
    $categoryName = $_GET['category'];

    // Debugging: Display received parameters
    //echo "Event ID: " . htmlspecialchars($eventId) . "<br>";
    //echo "Category: " . htmlspecialchars($categoryName) . "<br>";

    // Load the XML file
    $xml = simplexml_load_file('events.xml');
    if (!$xml) {
        echo "Failed to load XML file.";
        exit;
    }

    // Check if the category exists in the XML
    if (isset($xml->$categoryName)) {
        $category = $xml->$categoryName;
        $eventFound = false;

        // Loop through all events in the category
        foreach ($category->event as $event) {
            // Check if the event id matches
            if ((string)$event['id'] === (string)$eventId) {
                // Extract event details
                $event_name = (string)$event->name;
                $event_genre = (string)$event->genre ?? 'N/A';
                $event_location = (string)$event->location;
                $event_duration = (string)$event->duration;
                $event_date = (string)$event->date;
                $event_time = (string)$event->time;
                $event_cardImage = (string)$event->cardImage;
                $event_backgroundImage = (string)$event->backgroundImage;
                $event_description = (string)$event->description;
                $event_price = (string)$event->price;
				$currency = (string)$event->price['currency'];
				// Display event details in HTML
                $eventFound = true; // Mark the event as found
                break; // Stop the loop once the event is found
            }
        }

        if (!$eventFound) {
            echo "Event not found!";
        }
    } else {
        echo "Category not found!";
    }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--add icon link-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><!--external css fontawesome-->
		<link rel="stylesheet" type="text/css" href="http://localhost/moevent2/style.css">
		<link rel="icon" href="logo/icon2.png"><!--logo for title-->
   		<title>MoEvent- <?php echo htmlspecialchars($event_name);?></title>
		
   		<style>
	
 
		body{
	  		background-image:url("images/<?php echo htmlspecialchars($event_backgroundImage); ?>");
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
				<li><a href="blog.html">Blog<span></span></a></li>
				<li><a href="checkout.php">Checkout<span></span></a></li>
				<li><a href="myprofile.php"><i class="fas fa-user"></i></a></li>
			</ul>
		</div>
	</header>
	
	<main>

	<?php if ($eventFound): ?>

		<section class="event-details" style="text-align: center;">
			<!--<div class="eventposter">-->
				<div class="event-img-container">
				<img src="images/<?php echo htmlspecialchars($event_backgroundImage); ?>" alt="<?php echo htmlspecialchars($event_name); ?>">

				</div>
				<h1 class="event-title" style="margin: 20px auto; font-size:30px; color:cyan;">
					<?php echo htmlspecialchars($event_name); ?>
				</h1>
			
				<div class="info-events">
					<ul>
						<li><?php echo htmlspecialchars($event_genre); ?></li>
						<li><?php echo 'Time: ' . (new DateTime($event_time))->format('g:i A'); ?></li>
                    	<li><?php echo htmlspecialchars($event_location); ?></li>
					</ul>
					<br>
					<div class="duration-price">
						<p><?php echo $event_duration; ?></p>
						<p><?php echo $currency. " " .$event_price; ?></p>
					</div>

					<div class="line"></div>
				
					<h3>Storyline</h3>
					<p><?php echo htmlspecialchars($event_description); ?></p>
				</div>
				<button class="cta-button" id="book"><a href="checkout.php">BOOK NOW</a></button>
				
			<!--</div>-->
		</section>
		<?php endif; ?>
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
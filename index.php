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
   <title>MoEvent - Discover Exciting Events</title>

   <style>
			*{
	margin:0px;
	padding:0px;
	font-family:sans-serif;
	box-sizing:border-box;

	}

	/*remove text decoration from all links*/
	a{
	text-decoration: none;
	}

	.filterContainer {
    display: flex; /* Use flexbox for alignment */
    justify-content: right; /* Center align filter elements */
    align-items: center; /* Center align vertically */
    margin-bottom: 20px; /* Space below the filter */
	margin-right: 30px;
}

.filterContainer label {
    font-size: 18px; /* Increase font size of the label */
    margin-right: 10px; /* Space between label and select box */
    color: #333; /* Darker color for better readability */
}

#categoryFilter {
    padding: 10px; /* Add padding for the dropdown */
    font-size: 16px; /* Set font size for the dropdown */
    border: 1px solid #ccc; /* Light border for the dropdown */
    border-radius: 5px; /* Rounded corners */
    background-color: #f9f9f9; /* Light background for contrast */
    transition: border-color 0.3s; /* Smooth transition for border color */
}
/* Add focus effect */
#categoryFilter:focus {
    border-color: #007BFF; /* Change border color on focus */
    outline: none; /* Remove default outline */
}

#search{
	margin-left: 38%;
}
#search h1{
	margin-left: 2em;
}

#searchQuery{
	border: 2px solid black;
	border-radius: 20px;
	width: 25em;
	height: 3em;
	text-align: center;
}

#results a {
    display: block;
    margin-bottom: 10px;
	padding: 5px;
    text-decoration: none;
	text-align: center;
    color: #000; /* Optional styling */
	/*background-color: blue;*/
	border-bottom: 1px solid black;
}

#results a:hover{
	color: blue;
}

#results {
    margin-top: 20px;
	background-color: #ebebeb;
	/*border: 1px solid black;*/
	width: 35%;
}
   </style>

   <script>
	//Ajax request to fetch events based on the selected category
function filterEvents(category) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', fetch_events.php?category=${encodeURIComponent(category)}, true); // Use backticks for template literals
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.querySelector('.card-container').innerHTML = xhr.responseText; // Replace the card container's content with the response
        }
    };
    xhr.send();
}
	</script>
   
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
			<a href="index.html" class="logo" target="_blank">MoEvent.</a>
            <!-- Menu -->
			<ul class="nav">
				<li><a href="index.php">Home<span></span></a></li>
				<li><a href="#about-us">About<span></span></a></li>
				<li><a href="contact.html">contact<span></span></a></li>
				<li><a href="checkout.php">Checkout<span></span></a></li>
				<li><a href="myprofile.php"><i class="fas fa-user"></i></a></li>
			</ul>
		</div>
	</header>
                
	<main>
	<div id="search">
	<h1>Search Events</h1>
    <input type="text" id="searchQuery" onkeyup="loadDoc()" placeholder="Name, Type, Genre...">
    <div id="results"></div>
	</div>

    <script>
        function loadDoc() {
            var query = document.getElementById("searchQuery").value.toLowerCase().trim();
            
            // If search bar is empty, clear the results and return
            if (query === "") {
                document.getElementById("results").innerHTML = "";
                return;
            }

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    displayResults(this, query);
                }
            };
            xhttp.open("GET", "events1.xml", true);
            xhttp.send();
        }

        function displayResults(xml, query) {
            var i;
            var xmlDoc = xml.responseXML;
            var results = "";
            var x = xmlDoc.getElementsByTagName("event");

            for (i = 0; i < x.length; i++) {
                var name = x[i].getElementsByTagName("name")[0].childNodes[0].nodeValue.toLowerCase();
                var type = x[i].getElementsByTagName("type")[0].childNodes[0].nodeValue.toLowerCase();
                var genre = x[i].getElementsByTagName("genre")[0].childNodes[0].nodeValue.toLowerCase();
				var eventId = x[i].getAttribute("id");

                // Check if query matches name, type, or genre
                if (name.includes(query) || type.includes(query) || genre.includes(query)) {
                    var eventName = x[i].getElementsByTagName("name")[0].childNodes[0].nodeValue;
                    results += "<a href='evendetails.php?event_id=" + eventId + "'>" + eventName + "</a>";
                }
            }

            // If no results found, display a message
            if (results === "") {
                results = "No events found.";
            }

            document.getElementById("results").innerHTML = results;
        }
    </script>
	<!--Slide show for featured events-->
		<section class="Featured-events" id="featured">
			<h1 class="featured-heading">FEATURED EVENTS</h1>
				
				<div class="slideshow-container">
					<div class="mySlides fade">
						<div class="numbertext">1/3</div>
						<img src="Images\lk.jpg" style="width:100%">
						<div class="text">
							<h2>LION KING</h2>
							<p>Adventure, Musical</p>
							<a href="lionking.html" class="button">More Details</a>
						</div>
					</div>
					<div class="mySlides fade">
						<div class="numbertext">2/3</div>
						<img src="Images\Slide2.jpg" style="width:100%">
						<div class="text">
							<h2>ARIJIT SINGH</h2>
							<p>Saturday, 30 September 2023</p>
							<a href="arijitsingh.html" class="button">More Details</a>
						</div>
					</div>	
					<div class="mySlides fade">
						<div class="numbertext">3/3</div>
						<img src="Images\Slide3.jpg" style="width:100%">
						<div class="text">
							<h2> 3 IDIOTS </h2>
							<p>Comedy, Thriller</p>
							<br>
							<a href="3idiots.html" class="button">More Details</a>
						</div>
					</div>	
						<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
						<a class="next" onclick="plusSlides(1)">&#10095;</a>
					
					<br>
					<div style="text-align:center">
						<span class="dot" onclick="currentSlide(1)"></span>
						<span class="dot" onclick="currentSlide(2)"></span>
						<span class="dot" onclick="currentSlide(3)"></span>
					</div>	
				</div>
			</section>
		<!--slideshow ends-->

		<!--Browse events-->
		<!--Browse events end-->
			<section class="events">
				<h1 class="event-heading">UPCOMING EVENTS</h1>
				<section class="filterContainer">
				<label for="category">Filter by Category:</label>
            <select id="categoryFilter" onchange="filterEvents(this.value)">
              <option value="all">All</option>
              <option value="cinema">Cinema</option>
              <option value="concerts">Concerts</option>
              <option value="theatreShows">Theatre Shows</option>
            </select>
				</section>
			</section>

	

		<!--all events-->	

			<div id="eventContainer">
			
				<?php 
				// Load XML and XSLT
				$xml = new DOMDocument();
				$xml->load('events.xml');
				$xsl = new DOMDocument();
				$xsl->load('events.xsl'); // Path to your events.xsl

				// Configure the transformer
				$xsltProcessor = new XSLTProcessor();
				$xsltProcessor->importStylesheet($xsl);
				$transformedHtml = $xsltProcessor->transformToXML($xml);
    			echo $transformedHtml;
				
				
				?>
			
			</div>
				
		<!--About us-->
			<section class="about" id="about-us">
				<div class="about-heading">
					<h1>About Us</h1>
					<h2>Welcome to our platform!</h2>
					<p>We are passionate about bringing people together to experience unforgettable events.</p>
				</div>

				<div class="about-container">
					<section class="about-us-content">
						<div class="about-image">
							<img src="background.jpg" alt="">
						</div>
				
						<div class="about-content">
							<p>At MoEvent, we believe that life is all about experiences. Our mission is to bring you closer to the events that matter most to you, whether it's the latest blockbuster movie, a mesmerizing concert, or a captivating theatre show. We're here to make sure you never miss out on an opportunity to create unforgettable memories.</p>
							<div id = "content-about"></div>
							<button class="cta-button" id="learn-more-button">Learn More</button>
						</div>
					</section>					
				</div>
			</section>
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
	<script src="script1.js"></script>
	
</body>
</html>

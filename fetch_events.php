<?php
header('Content-Type: text/html; charset=utf-8');

// Load the XML file
$xml = simplexml_load_file('events.xml');

// Get the category from the URL
$category = isset($_GET['category']) ? $_GET['category'] : 'all';

// Prepare an empty string for the output
$output = '';

if ($category == 'all') {
    // Show all events
    foreach ($xml->children() as $eventType) {
        foreach ($eventType->event as $event) {
            $output .= generateEventHtml($event, $eventType->getName());
        }
    }
} else {
    // Show events for the specified category
    if (isset($xml->$category)) {
        foreach ($xml->$category->event as $event) {
            $output .= generateEventHtml($event, $category);
        }
    }
}

// Function to generate the HTML for an event
function generateEventHtml($event, $category) {
    $eventId = (string)$event['id'];
    $html = '<div class="card" data-category="' . $event->getName() . '">';
    $html .= '<div class="image"><img src="' . $event->cardImage . '" alt="Event Image"></div>';
    $html .= '<div class="card-content">';
    $html .= '<div class="overlay"></div>';
    $html .= '<div class="event-info">';
    $html .= '<p class="title">' . htmlspecialchars($event->name) . '</p>';
    $html .= '<div class="separator"></div>';
    $html .= '<p class="info">' . htmlspecialchars($event->genre) . '</p>';
    $html .= '<p class="duration">' . htmlspecialchars($event->duration) . '</p>';
    $html .= '<div class="info-details">';
    $html .= '<p class="info"><i class="fas fa-map-marker-alt"></i>' . htmlspecialchars($event->location) . '</p>';
    $html .= '<p class="info"><i class="far fa-calendar-alt"></i> Time: ' . $event->time . '</p>';
    $html .= '</div></div>';
    $html .= '<button class="action"><a href="eventpage.php?event_id='  . urlencode($eventId) . '&category=' . urlencode($category) . '" target="_blank">Book</a></button>';
    $html .= '</div></div>';


    //$html .= '<div style="color: red;">Debug: Event ID - ' . htmlspecialchars($eventId) . '</div>'; // Add this line
    $html .= '</div></div>';
    return $html;
}

// Output the generated HTML

echo $output;
?>


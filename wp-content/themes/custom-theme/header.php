<?php
function updateRequestCount() {
    $count_file = get_template_directory() . '/request_count.txt';
    $timestamp_file = get_template_directory() . '/timestamp.txt';

    $current_count = file_exists($count_file) ? (int) file_get_contents($count_file) : 0;
    $timestamp = file_exists($timestamp_file) ? (int) file_get_contents($timestamp_file) : time();

    if (time() - $timestamp >= 3600) {
        $current_count = 0;
        $timestamp = time();
    }

    $current_count++;

    file_put_contents($count_file, $current_count);
    file_put_contents($timestamp_file, $timestamp);

    return $current_count;
}

function isRateLimitExceeded() {
    $current_count = updateRequestCount();

    return $current_count > 50;
}

function savePhotoURL($photo_url) {
    $photo_file = get_template_directory() . '/saved_photo_url.jpg';

    // Download the image file from the URL and save it
    $image_data = file_get_contents($photo_url);
    file_put_contents($photo_file, $image_data);
}

if (!isRateLimitExceeded()) {
    $url = 'https://api.unsplash.com/photos/random?client_id=PHv2be2mtI1vvhR4OgDJFGVAe5FaiBALyij2MgY5gdE';
    $response = file_get_contents($url);

    if ($response) {
        $data = json_decode($response);

        if ($data && isset($data->urls) && isset($data->urls->regular)) {
            echo '<style>.header-background { background-image: url("' . esc_url($data->urls->regular) . '"); }</style>';

            // Save the photo URL to TXT file
            savePhotoURL($data->urls->regular);
        }
    } else {
        error_log('Failed to retrieve data from Unsplash API.');
        echo '<!-- Failed to retrieve data from Unsplash API. -->';
    }
} else {
    echo '<!-- Rate limit exceeded. -->';

    $photo_file = get_template_directory() . '/saved_photo_url.jpg';

    // Check if the image file exists
    if (file_exists($photo_file)) {
        echo '<style>.header-background { background-image: url("' . esc_url(get_template_directory_uri() . '/saved_photo_url.jpg') . '"); }</style>';
    }
}

// Delete the saved photo after 1 hour
$photo_file = get_template_directory() . '/saved_photo_url.jpg';
if (file_exists($photo_file) && (time() - filemtime($photo_file) >= 3600)) {
    unlink($photo_file);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WordPress Assignment</title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
</head>
<body>
<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">WordPress Assignment</a>

        <div class="hamburger-menu">
            <div class="hamburger-icon"></div>
            <div class="hamburger-icon"></div>
            <div class="hamburger-icon"></div>
        </div>

        <ul class="navbar-menu-mobile">
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
            <li><a href="<?php echo esc_url( home_url( '/scraped-data-page' ) ); ?>">Scraped Data Page</a></li>
        </ul>

        <ul class="navbar-menu">
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
            <li><a href="<?php echo esc_url( home_url( '/scraped-data-page' ) ); ?>">Scraped Data Page</a></li>
        </ul>
    </div>
</nav>


<div class="header-background">
    <h1>Assignment Frontend WordPress Developer</h1>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var hamburgerMenu = document.querySelector('.hamburger-menu');
    var navbarMenuMobile = document.querySelector('.navbar-menu-mobile');

    if (hamburgerMenu) {
        hamburgerMenu.addEventListener('click', function() {
            navbarMenuMobile.classList.toggle('show');
        });
    }
});
</script>
</body>
</html>


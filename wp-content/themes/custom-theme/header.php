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
    $photo_file = get_template_directory() . '/saved_photo_url.txt';

    file_put_contents($photo_file, $photo_url);
}

if (!isRateLimitExceeded()) {
    $url = 'https://api.unsplash.com/photos/random?client_id=WuS6MtESRDFMptTT4mLdSWuvuFe3D4JxqaLSVMh81yc';
    $response = file_get_contents($url);

    if ($response) {
        $data = json_decode($response);

        if ($data && isset($data->urls) && isset($data->urls->regular)) {
            echo '<style>.header-background { background-image: url("' . esc_url($data->urls->regular) . '"); }</style>';
        }
    } else {
        error_log('Failed to retrieve data from Unsplash API.');
        echo '<!-- Failed to retrieve data from Unsplash API. -->';
    }
} else {
    echo '<!-- Rate limit exceeded. -->';

    $photo_file = get_template_directory() . '/saved_photo_url.txt';
    $saved_photo_url = file_exists($photo_file) ? file_get_contents($photo_file) : '';

    if (!empty($saved_photo_url)) {
        echo '<style>.header-background { background-image: url("' . esc_url($saved_photo_url) . '"); }</style>';
    }
}

if (isRateLimitExceeded() && empty($saved_photo_url)) {
    savePhotoURL($data->urls->regular);
}

$photo_file = get_template_directory() . '/saved_photo_url.txt';
if (file_exists($photo_file) && (time() - filemtime($photo_file) >= 3600)) {
    unlink($photo_file);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
</head>
<body>
<nav class="navbar">
    <div class="container">
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">Your Site Name</a>

        <ul class="navbar-menu">
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
            <li><a href="<?php echo esc_url( home_url( '/scraped-data-page' ) ); ?>">Scraped Data Page</a></li>
        </ul>
    </div>
</nav>

<div class="header-background">
    <h1>Assignment Frontend WordPress Developer</h1>
</div>

</body>
</html>


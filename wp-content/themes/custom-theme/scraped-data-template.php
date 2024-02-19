<?php
require_once 'path/to/twitteroauth/autoload.php'; // Adjust the path as needed

use Abraham\TwitterOAuth\TwitterOAuth;

$consumerKey = 'D7kRoXBheIXjR5IQ6WnysrPpx';
$consumerSecret = 'EV1VoZ6eVwuwcDSamFYhjKp3UWLQVWKoHwZuDre4iIFjblUIzo';
$accessToken = '1450973341649707013-7TBWj1bTrWHblOJVpKVco2JhDftvJw';
$accessTokenSecret = 'DCe97PhiP7e2aA52DLwU1ko0TBvJg9eUkpWjoLKPPFb8n';

$twitterOAuth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

$username = 'elonmusk'; 
$userData = $twitterOAuth->get('users/by/username/' . $username);

if (!empty($userData)) {
    echo '<h2>User Data</h2>';
    echo '<p>Name: ' . $userData->name . '</p>';
    echo '<p>Screen Name: ' . $userData->screen_name . '</p>';
    echo '<p>Description: ' . $userData->description . '</p>';
    echo '<p>Followers Count: ' . $userData->followers_count . '</p>';
} else {
    echo 'No data found for the specified username.';
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scraped Data Template</title>
    <?php wp_head(); ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 960px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .creator-card {
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .creator-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .creator-info {
            font-size: 16px;
            color: #666;
        }
        .creator-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }
    </style>
</head>
<body <?php body_class(); ?>>
    <div class="container">
        <h1>Creators</h1>
        <div id="creators-list"></div>
    </div>

    <?php wp_footer(); ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var apiUrl = "https://api.example.com/creators"; 
            var creatorsList = document.getElementById("creators-list");

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    data.forEach(creator => {
                        var creatorCard = document.createElement("div");
                        creatorCard.classList.add("creator-card");

                        var creatorAvatar = document.createElement("img");
                        creatorAvatar.classList.add("creator-avatar");
                        creatorAvatar.src = creator.avatar_url;

                        var creatorName = document.createElement("div");
                        creatorName.classList.add("creator-name");
                        creatorName.textContent = creator.name;

                        var creatorInfo = document.createElement("div");
                        creatorInfo.classList.add("creator-info");
                        creatorInfo.textContent = creator.bio;

                        creatorCard.appendChild(creatorAvatar);
                        creatorCard.appendChild(creatorName);
                        creatorCard.appendChild(creatorInfo);

                        creatorsList.appendChild(creatorCard);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    </script>
</body>
</html>

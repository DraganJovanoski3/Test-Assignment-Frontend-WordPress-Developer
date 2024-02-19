<?php
get_header();

// Function to make HTTP GET request
function fetch_photos_from_unsplash($query, $page = 1, $per_page = 10) {
    $access_key = 'M0_LZYxeuY-_LIBoiNq59UIv-3iCTZJooPuTygrpmH8';
    $url = "https://api.unsplash.com/search/photos?page={$page}&per_page={$per_page}&query={$query}";
    $headers = array(
        'Authorization: Client-ID ' . $access_key
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

$search_query = '';
$photos_data = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search_query = isset($_POST['search_query']) ? $_POST['search_query'] : '';

    $photos_data = fetch_photos_from_unsplash($search_query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .photos {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
        height: 400px;
    }
    .photo {
        height: auto;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 250px;
        background-color: #f9f9f9;
        }

    .photo img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }
    #footer {
        position: fixed;
        bottom: 0px;
        width: 100%;
    }
    form {
        display: flex;
        justify-content: center;
        margin: 30px;
    }
    form > input {
        padding: 0px 10px; 
        font-size: 16px;
        margin: 0px 10px;
    }
    form > button {
        text-transform: uppercase;
        background-color: black;
        color: white;
        padding: 10px;
        font-size: 16px;
        border: 0px;
        border-radius: 5px;
    }
    #main {
        height: 100%;
    } 
    </style>
</head>
<body>
<div id="content">
    <div id="primary">
        <main id="main" class="site-main" role="main">
            <form method="POST">
                <input type="text" name="search_query" value="<?php echo $search_query; ?>" placeholder="Search for photos">
                <button type="submit">Search</button>
            </form>
            <div class="photos">

            <?php
            if (!empty($photos_data)) {
                foreach ($photos_data['results'] as $photo) {
                    ?>
                    <div class="photo">
                        <img src="<?php echo $photo['urls']['regular']; ?>" alt="<?php echo $photo['description']; ?>">
                        <p>By: <?php echo $photo['user']['name']; ?></p>
                    </div>
                    <?php
                }
                
            } else {
                echo "<p>No photos found.</p>";
            }
            
            ?>
        </div>

        </main>
    </div>
</div>
<?php 
get_footer(); 
?>
</body>
</html>

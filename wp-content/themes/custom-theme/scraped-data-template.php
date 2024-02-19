
<?php
/*
Template Name: Scraped Data Template
*/
include 'header.php';
?>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    .image-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
    height: 400px;
    margin-bottom: 100px;
  }

  .image-item {
    height: auto;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 250px;
    background-color: #f9f9f9;
  }

  .image-item img {
    width: 100%;
    height: 250px;
    object-fit: cover;
  }

  .user-info {
    padding: 10px;
    border-top: 1px solid #ddd;
  }
  .load-more-btn {
    position: fixed;
    background-color: black;
    color: white;
    text-transform: uppercase;
    left: 0px;
    top: 75px;
    padding: 10px;
    border: 0px;
    border-radius: 5px;
  }
  .container-loadmore {
    height: 100%;
    width: 100%;
  }
</style>
</head>
<body>
<div class="container-loadmore">
  <button id="load-more-btn" class="load-more-btn">Load More</button>
  <div class="image-container" id="image-container"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageContainer = document.getElementById('image-container');
    const loadMoreBtn = document.getElementById('load-more-btn');

    let page = 1; 

    const fetchPhotos = () => {
        fetch(`https://api.unsplash.com/photos?page=${page}&per_page=7&client_id=FuuNHg10kCM5SGba1Ne9Fg3nlH__2VH0LJlENe5-ts8`)
            .then(response => response.json())
            .then(data => {
                data.forEach(image => {
                    const imageItem = document.createElement('div');
                    imageItem.classList.add('image-item');

                    const imgUrl = `${image.urls.regular}?w=400&h=300&fit=crop&crop=entropy&q=80&auto=format`;

                    const img = document.createElement('img');
                    img.src = imgUrl;
                    img.alt = image.alt_description;

                    const userInfo = document.createElement('div');
                    userInfo.classList.add('user-info');
                    userInfo.innerHTML = `<p>Username: ${image.user.username}</p>
                                          <p>First Name: ${image.user.first_name}</p>
                                          <p>Last Name: ${image.user.last_name}</p>
                                          <p>Likes: ${image.likes}</p>`;

                    imageItem.appendChild(img);
                    imageItem.appendChild(userInfo);
                    imageContainer.appendChild(imageItem);
                });
            })
            .catch(error => console.error('Error fetching images:', error));
    };

    fetchPhotos();

    loadMoreBtn.addEventListener('click', () => {
        page++; 
        fetchPhotos(); 
    });
});
</script>
<?php
get_footer();
?>
</body>
</html>
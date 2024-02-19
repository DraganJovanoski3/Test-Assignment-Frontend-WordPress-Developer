jQuery(document).ready(function($) {
    $('#image-search-form').on('submit', function(e) {
        e.preventDefault();
        var query = $('#search-query').val();
        if (query.trim() !== '') {
            // Set query parameter based on user input
            var searchQuery = (query.toLowerCase() === 'people') ? 'people' : encodeURIComponent(query);
            var url = 'https://api.unsplash.com/search/photos?query=' + searchQuery + '&per_page=10&client_id=lFZx25l63KV_9SqRL1_5sO-785uqSjgtd7F_F7xxkX4';
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    displaySearchResults(response.results);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });

    function displaySearchResults(results) {
        var html = '';
        results.forEach(function(result) {
            html += '<div class="image-result">';
            html += '<img src="' + result.urls.regular + '" alt="' + result.alt_description + '">';
            html += '</div>';
        });
        $('#image-results').html(html);
    }
});

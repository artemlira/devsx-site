jQuery(document).ready(function($) {
  // Load more cases handler
  $('#cases-load-more').on('click', function() {
    var button = $(this);
    var currentPage = parseInt(button.data('page'));
    var category = button.data('category');
    var totalPosts = parseInt(button.data('total'));
    var loadedPosts = $('.section-cases-item').length;

    // Disable button during AJAX request
    button.prop('disabled', true).addClass('loading');

    $.ajax({
      url: ajax_object.ajax_url,
      type: 'POST',
      data: {
        action: 'load_more_cases',
        page: currentPage,
        category: category,
        posts_per_page: 8, // Always load 8 posts at a time
        security: ajax_object.nonce
      },
      success: function(response) {
        if (response.success) {
          // Append new posts
          $('#cases-list').append(response.data.html);

          // Update button data
          currentPage++;
          button.data('page', currentPage);

          // Check if we need to hide the button
          var newLoadedPosts = loadedPosts + response.data.count;
          if (newLoadedPosts >= totalPosts) {
            button.hide();
          } else {
            // Update button text
            var remainingPosts = Math.min(8, totalPosts - newLoadedPosts);
            button.text('Show ' + remainingPosts + ' More Articles');
          }
        } else {
          console.error('Error loading more cases');
        }

        // Re-enable button
        button.prop('disabled', false).removeClass('loading');
      },
      error: function(xhr, status, error) {
        console.error('AJAX Error: ' + error);
        button.prop('disabled', false).removeClass('loading');
      }
    });
  });
});
jQuery(document).ready(function($) {
    // Initialize variables
    var pageNum = parseInt(pbd_alp.startPage) + 1;
    var maxPages = parseInt(pbd_alp.maxPages);
    var nextLink = pbd_alp.nextLink;

    /**
     * Replace traditional navigation with "Load More Posts" button
     * if there are more pages to load.
     */
    if (pageNum <= maxPages) {
        $('#bcont')
            .append('<div class="pbd-alp-placeholder-' + pageNum + '"></div>')
            .append('<p id="pbd-alp-load-posts"><a href="#" class="button">Load More Posts</a></p>');

        $('.navigation').remove();
    }

    /**
     * Handle click event on "Load More Posts" button
     */
    $('#pbd-alp-load-posts a').click(function(e) {
        e.preventDefault();

        if (pageNum <= maxPages) {
            loadMorePosts();
        } else {
            $(this).append('.');
        }
    });

    /**
     * Load more posts via AJAX
     */
    function loadMorePosts() {
        var $loadButton = $('#pbd-alp-load-posts a');
        $loadButton.text('Loading posts...');

        $('.pbd-alp-placeholder-' + pageNum).load(nextLink + ' article', function() {
            // Update page number and nextLink
            pageNum++;
            nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/' + pageNum);

            // Add a new placeholder for next load
            $('#pbd-alp-load-posts').before('<div class="pbd-alp-placeholder-' + pageNum + '"></div>');

            // Update button text
            $loadButton.text(pageNum <= maxPages ? 'Load More Posts' : 'No more posts to load.');
        });
    }
});

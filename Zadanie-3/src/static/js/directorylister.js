$(document).ready(function() {

    var contentTop = $('#page-content').offset().top;

    // Show / Hide top link
    showHideTopLink(contentTop);

    $(window).scroll(function() {
        showHideTopLink(contentTop);
    });

    $('#page-top-link').click(function() {
        $('html, body').animate({ scrollTop: 0 }, 'fast');
        return false;
    });

    // Hash button on click action
    $('.file-info-button').click(function(event) {

        var name = $(this).closest('li').attr('data-name');
        var path = $(this).closest('li').attr('data-href');

        $('#file-info-modal .modal-title').text(name);

        $('#file-info .md5-hash').text('Loading...');
        $('#file-info .sha1-hash').text('Loading...');
        $('#file-info .filesize').text('Loading...');

        $.ajax({
            url:     '?hash=' + path,
            type:    'get',
            success: function(data) {

                var obj = jQuery.parseJSON(data);

                $('#file-info .md5-hash').text(obj.md5);
                $('#file-info .sha1-hash').text(obj.sha1);
                $('#file-info .filesize').text(obj.size);

            }
        });

        $('#file-info-modal').modal('show');

        event.preventDefault();

    });

});

function showHideTopLink(elTop) {
    if($('#page-navbar').offset().top + $('#page-navbar').height() >= elTop) {
        $('#page-top-nav').show();
    } else {
        $('#page-top-nav').hide();
    }
}

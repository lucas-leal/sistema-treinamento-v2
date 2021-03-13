require('./bootstrap');

jQuery('#file').on('change', function () {
    jQuery('#file-label').html(this.files[0].name);
});

$('.video-link').on('click', function () {
    let element = jQuery(this);

    var src = element.attr('url');
    let videoTitle = element.attr('video-title');

    $('#video-modal').modal('show');

    $('#video-modal h4').html(videoTitle);
    $('#video-modal video').attr('src', src);
});

$('#video-modal button').on('click', function () {
    $('#video-modal video').get(0).pause();
});

$('#video-modal video').on('play', function () {
    let token = jQuery('#video-modal input[name=_token]').val();
    let url = jQuery(this).attr('src');
    
    $.post(url + '/view', {_token: token});
});

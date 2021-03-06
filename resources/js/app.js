require('./bootstrap');

jQuery('#file').on('change', function () {
    jQuery('#file-label').html(this.files[0].name);
});

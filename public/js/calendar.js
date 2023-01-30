$(function() {
    $('.btn-danger').on('click', function() {
        $('.js-modal').fadeIn();
        var delete_date = $(this).val();
        var delete_part = $(this).text();
        console.log(delete_part);
        $('.modal-inner-reserveDate').text(delete_date);
        $('.modal-inner-reservePart').text(delete_part);
        return false;
    });
    $('.js-modal-close').on('click', function() {
        $('.js-modal').fadeOut();
        return false;
    });
});
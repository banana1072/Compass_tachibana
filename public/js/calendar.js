$(function() {
    $('.delete-btn').on('click', function() {
        $('.js-modal').fadeIn();
        var delete_date = $(this).val();
        var delete_part = $(this).text();
        var delete_part_num = parseInt(delete_part.replace(/\D/g, ''));
        $('.modal-inner-reserveDate').text(delete_date);
        $('.modal-inner-reservePart').text(delete_part);
        $('.submit-delete-date').val(delete_date);
        $('.submit-delete-part').val(delete_part_num);
        return false;
    });
    $('.js-modal-close').on('click', function() {
        $('.js-modal').fadeOut();
        return false;
    });
});
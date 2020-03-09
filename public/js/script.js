var checkbox = $('#limitless');
var limit = $('#limit');

checkbox.click(function() {
    if ($(this).prop("checked") == true) {
        limit.val('');
        limit.prop('disabled', true);
    } else if ($(this).prop("checked") == false) {
        limit.prop('disabled', false);
    }
});

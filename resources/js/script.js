$('input[type="checkbox"]').click(function() {
    if ($(this).prop("checked") == true) {
        alert("Checkbox is checked.");
    } else if ($(this).prop("checked") == false) {
        alert("Checkbox is unchecked.");
    }
})

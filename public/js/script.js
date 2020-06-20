let limit = $('#limit')
limit.append($("<option></option>").attr("value",0).text('Sınırsız'));
for(let i = 1; i <= 100; i++ ) {
    limit.append($("<option></option>").attr("value",i).text(i));
}

$( "#title" ).focusin(function() {
    $('#title').removeClass('is-invalid')
});

$( "#location" ).focusin(function() {
    $('#location').removeClass('is-invalid')
});

$( "#description" ).focusin(function() {
    $('#description').removeClass('is-invalid')
});

$( "#limit" ).focusin(function() {
    $('#limit').removeClass('is-invalid')
});

$( "#start_date" ).focusin(function() {
    $('#start_date').removeClass('is-invalid')
});

$( "#end_date" ).focusin(function() {
    $('#end_date').removeClass('is-invalid')
});


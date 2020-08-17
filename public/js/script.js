if(document.location.protocol!="https:"){
    document.location=document.URL.replace(/^http:/i, "https:");
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

fetch('https://kampdas.test/kampdas/public/vendor/cities.json')
    .then(response => response.json())
    .then(data => {
        let city = $('#city')
        data.forEach(d => city.append($("<option></option>").attr("value",d.name).text(d.name)))

    });


let limit = $('#limit')
limit.append($("<option></option>").attr("value",0).text('Sınırsız'));
for(let i = 2; i <= 100; i++ ) {
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

/*==================================================================
    [ Focus input ]*/
$('.input100').each(function(){
    $(this).on('blur', function(){
        if($(this).val().trim() != "") {
            $(this).addClass('has-val');
        }
        else {
            $(this).removeClass('has-val');
        }
    })
})


/*==================================================================
[ Validate ]*/
var input = $('.validate-input .input100');

$('.validate-form').on('submit',function(){
    var check = true;

    for(var i=0; i<input.length; i++) {
        if(validate(input[i]) == false){
            showValidate(input[i]);
            check=false;
        }
    }

    return check;
});


$('.validate-form .input100').each(function(){
    $(this).focus(function(){
        hideValidate(this);
    });
});

function validate (input) {
    if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
        if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
            return false;
        }
    }
    else {
        if($(input).val().trim() == ''){
            return false;
        }
    }
}

function showValidate(input) {
    var thisAlert = $(input).parent();

    $(thisAlert).addClass('alert-validate');
}

function hideValidate(input) {
    var thisAlert = $(input).parent();

    $(thisAlert).removeClass('alert-validate');
}

$(document).ready(function()
{
    $("#notificationLink").click(function()
    {
        $("#notificationContainer").fadeToggle(200);
        $("#notification_count").fadeToggle(200);
        return false;
    });

//Document Click hiding the popup
    $(document).click(function()
    {
        $("#notificationContainer").hide();
    });

//Popup on click

});

$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

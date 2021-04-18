$(document).ready(function(){
    //request Login
    $("#btn-login").click(function() {
        var formData = $("#form-login").serialize();
        var base_url = window.location.origin;
        $.ajax({
            type: "POST",
            url: base_url+"/validate",
            data: formData,
            success: function (response) {
                if(response.mensagem)
                    alert(response.mensagem);
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
    });

    //request Register
    $("#btn-register").click(function() {
        var formData = $("#form-register").serialize();
        var base_url = window.location.origin;
        $.ajax({
            type: "POST",
            url: base_url+"/register-validate",
            data: formData,
            success: function (response) {
                if(response.mensagem)
                    alert(response.mensagem);
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
    });
});
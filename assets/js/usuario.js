$(document).ready(function(){
    //request Login
    $("#btn-login").click(function() {
        var formData = $("#form-login").serialize();
        var base_url = window.location;
        $.ajax({
            type: "POST",
            url: base_url+"validate",
            data: formData,
            success: function (response) {
                if(response.success)
                    alert("Usuario Logado");
                if(response.error)
                    alert("Usuario Invalido Por Favor Realize seu Cadastro");
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
    });

    //request Register
    $("#btn-register").click(function() {
        var formData = $("#form-register").serialize();
        var base_url = window.location;
        $.ajax({
            type: "POST",
            url: base_url+"register-validate",
            data: formData,
            success: function (response) {
                if(response.mensagem)
                    alert(responde.mensagem);
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
    });
});
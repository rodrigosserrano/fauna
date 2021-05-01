import { BaseURL } from 'base_url.js';

$(document).ready(function(){
    //request Login
    $("#btn-login").click(function() {
        var formData = $("#form-login").serialize();
        $.ajax({
            type: "POST",
            url: BaseURL+"validate",
            data: formData,
            success: function (response) {
                if(response.mensagem){
                    $(".box-mensagem").removeClass("hidden");
                    $("#mensagem").html(response.mensagem);
                }
                
                if(response.is_logado){
                    $(".box-mensagem").addClass("box-mensagem-success");
                    $(".box-mensagem").addClass("box-mensagem-success");
                    window.location.reload();
                }
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
    });
    //request logout
    $("#btn-logout").click(function() {
        $.ajax({
            type: "POST",
            url: BaseURL+"logout",
            success: function (response) {
                if(response.mensagem)
                    window.location.href = BaseURL;
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
    });

    //request Register
    $("#btn-register").click(function() {
        var formData = $("#form-register").serialize();
        $.ajax({
            type: "POST",
            url: BaseURL+"register-validate",
            data: formData,
            success: function (response) {
                if(response.mensagem){
                    alert(response.mensagem);
                    window.location.href= BaseURL;
                }
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
    });
});
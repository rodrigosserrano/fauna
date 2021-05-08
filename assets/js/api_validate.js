$(document).ready(function(){
    if(window.location.origin != 'http://localhost'){
        base_url = 'http://lds.codeigniter-dev/';
    }else{
        base_url = 'http://localhost/fauna/';
    }

    //request Login
    $("#btn-login").click(function() {
        var formData = $("#form-login").serialize();
        $.ajax({
            type: "POST",
            url: base_url+"validate",
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
            url: base_url+"logout",
            success: function (response) {
                if(response.mensagem)
                    window.location.href = base_url;
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
            url: base_url+"register-validate",
            data: formData,
            success: function (response) {
                if(response.mensagem){
                    alert(response.mensagem);
                    window.location.href= base_url;
                }
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
    });
});
$(document).ready(function(){
    var getUrl = window.location;
    if(getUrl.host.split('/')[1] != undefined){
        var baseUrl = getUrl.protocol + "//" + getUrl.host.split('/')[1] + "//" + getUrl.pathname.split('/')[2];
    }else{
        var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    }

    //request Login
    $("#btn-login").click(function() {
        var formData = $("#form-login").serialize();
        $.ajax({
            type: "POST",
            url: baseUrl+"validate",
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
        // console.log( getUrl.host.split('/')[0]);
        $.ajax({
            type: "POST",
            url: baseUrl+"logout",
            success: function (response) {
                if(response.mensagem)
                    window.location.href = baseUrl;
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
            url: baseUrl+"register-validate",
            data: formData,
            success: function (response) {
                if(response.mensagem){
                    alert(response.mensagem);
                    window.location.href= baseUrl;
                }
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        });
    });
});
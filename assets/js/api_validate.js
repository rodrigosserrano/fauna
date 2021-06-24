$(document).ready(function(){
    if(window.location.origin != 'http://localhost'){
        base_url = 'http://lds.codeigniter-dev/';
    }else{
        base_url = `${window.location.origin}/fauna/`;
    }

    // Checagem de rota
    function checkURL(route) {
        return window.location.href == base_url + route;
    }

    // Alerta
    function alertFunc(message) {
        var alertBox = document.createElement('div');
        alertBox.setAttribute('class', 'alert-msg');
        alertBox.appendChild(document.createTextNode(message));
        document.querySelector('.alert-area').appendChild(alertBox);
        setTimeout(function() { document.querySelector('.alert-area').removeChild(alertBox) }, 4000);
    }

    if( checkURL('') ) {

        //request Login
        const inputsLogin = document.querySelectorAll('#form-login .form-input');
        if(inputsLogin.length) {
            for(input of inputsLogin) {
                
                input.addEventListener('keydown', (event) => {
                    if(event.code == 'Enter' || event.code == 'NumpadEnter') {
                        login();
                    }
                })
            }
        }

        $("#btn-login").click(function() {
            login();
        });

        function login() {
            var formData = $("#form-login").serialize();
            $.ajax({
                type: "POST",
                url: base_url+"validate",
                data: formData,
                success: function (response) {
                    if(response.mensagem && !response.is_logado){
                        // $(".box-mensagem").removeClass("hidden");
                        // $("#mensagem").html(response.mensagem);
                        alertFunc(response.mensagem);
                    }
                    
                    if(response.is_logado){
                        // $(".box-mensagem").addClass("box-mensagem-success");
                        // $(".box-mensagem").addClass("box-mensagem-success");
                        window.location.reload();
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
        }

    }

    if( !(checkURL('') || checkURL('register')) ) {
        //request logout
        $("#btn-logout").click(function() {
            $.ajax({
                type: "POST",
                url: base_url+"logout",
                success: function (response) {
                    // if(response.mensagem)
                        window.location.href = base_url;
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
        });
    }
    
    if( checkURL('register') ) {

        //request Register
        $("#btn-register").click(function() {
            let form = new FormData(document.getElementById("form-register"));
            
            $.ajax({
                type: "POST",
                url: base_url+"register-validate",
                data: form,
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.mensagem)
                        alertFunc(response.mensagem);
                    
                    if(response.error == 0)
                        window.location.href= base_url;
                    
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                } 
            });
        });

    }
});
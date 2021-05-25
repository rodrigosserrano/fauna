$(document).ready(function(){
    if(window.location.origin != 'http://localhost'){
        base_url = 'http://lds.codeigniter-dev/';
    }else{
        base_url = 'http://localhost/fauna/';
    }

    $.ajax({
        type: "GET",
        url: base_url+"get-dados-user",
        success: function (r) {
            var path = base_url+'assets/img/user/';

            var user = r.usuario;
            var pets = r.pet;

            console.log(r);
            console.log(user);
            //console.log(pet);

            
            if(user.foto_usuario == null){
                $('[data-img-user]').attr('src', path+'unknown.jpg');
            }else{
                $('[data-img-user]').attr('src', path+'/'+user.email+'/'+user.foto_usuario);
                $('[data-img-user]').attr('alt', 'Foto de '+user.nome_usuario);
                $('[data-img-user]').attr('title', 'Foto de '+user.nome_usuario);
            }

            //Populate form alterar dados
            $('#input-form-email').attr('value', user.email);
            $('[name="nome_usuario"]').attr('value', user.nome_usuario);
            $('[name="data_nascimento"]').attr('value', user.data_nascimento);
            $('[name="telefone"]').attr('value', user.telefone);


            //Pet View


            $('[data-id="pet-view"]').each((pets, pet) => {
                console.log(pet);
                $('#pet-alterar-modal-'+pet.id_animal);
                $('#pet-nome').prepend(pet.nome_animal);
            });


            console.log($('[data-img-user]').attr('src'));
            
            // if($(this).data('img') == 'img_usuario_settings'){
            //     url_foto = response.
            //     $(this).data('img').attr('src', response.);
            // }
        }
    });

    //request Login
    const inputsLogin = document.querySelectorAll('#form-login .form-input');
    if(inputsLogin.length) {
        for(input of inputsLogin) {
            
            input.addEventListener('keydown', (event) => {
                if(event.code == 'Enter') {
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
                    $(".box-mensagem").removeClass("hidden");
                    $("#mensagem").html(response.mensagem);
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
        let form = new FormData(document.getElementById("form-register"));
        
        $.ajax({
            type: "POST",
            url: base_url+"register-validate",
            data: form,
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.mensagem)
                    alert(response.mensagem);
                
                if(response.error == 0)
                    window.location.href= base_url;
                
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            } 
        });
    });
});
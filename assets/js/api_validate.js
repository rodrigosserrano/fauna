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
            var path_user = base_url+'assets/img/user';
            var path_pet = base_url+'assets/img/pet';

            var user = r.usuario;
            var pets = r.pet;
            var tipos = r.tipo;

            console.log(r);
            console.log(user);
            console.log(pets);

            
            if(user.foto_usuario == null){
                $('[data-img-user]').attr('src', path_user+'unknown.jpg');
            }else{
                $('[data-img-user]').attr('src', path_user+'/'+user.email+'/'+user.foto_usuario);
                $('[data-img-user]').attr('alt', 'Foto de '+user.nome_usuario);
                $('[data-img-user]').attr('title', 'Foto de '+user.nome_usuario);
            }

            //Populate form alterar dados
            $('#input-form-email').attr('value', user.email);
            $('[name="nome_usuario"]').attr('value', user.nome_usuario);
            $('[name="data_nascimento"]').attr('value', user.data_nascimento);
            $('[name="telefone"]').attr('value', user.telefone);


            //Pet View

            $(pets).each((index, pet)=>{
                $('[data-id="pet-view"]').each(() => {
                    // console.log($('[data-id="pet-view"]').attr('id', 'pet-alterar-modal-'+pet.id_animal));
                    $('[data-id="pet-view"]').attr('id', 'pet-alterar-modal-'+pet.id_animal);
                    $('#pet-nome').prepend(pet.nome_animal);
                    $('#form-alterar-pet').attr('id', 'form-alterar-pet-'+pet.id_animal);

                    if(pet.foto_animal == null){
                        $('#form-pet-pic-alterar').attr('src', path_pet+'unknown.jpg');
                    }else{
                        $('#form-pet-pic-alterar').attr('src', path_pet+'/'+user.email+'/'+pet.foto_animal);
                        $('#form-pet-pic-alterar').attr('alt', 'Foto de '+pet.nome_animal);
                        $('#form-pet-pic-alterar').attr('title', 'Foto de '+pet.nome_animal);

                        $('#input-foto-animal-com-foto').attr('value', pet.foto_animal);
                    }

                    $('#frm_alterar_id_animal').attr('value', pet.id_animal);
                    $('#frm_alterar_id_usuario').attr('value', pet.id_usuario);
                    $('#frm_alterar_nome_animal').attr('value', pet.nome_animal);
                    
                    $('.form-btn').attr('id', pet.id_animal);
                    
                    
                    $('#pet-excluir-modal').attr('id', 'pet-excluir-modal-'+pet.id_animal);
                    $('#delete-pet-message').prepend('Você deseja realmente excluir '+pet.nome_animal+' ? :(');
                    $('.del-pet-btn').attr('id', pet.id_animal);
                    $('.del-pet-btn').attr('data-id', pet.id_animal);
                });

            });

            // pets.map(({
            //     foto_animal,
            //     id_animal,
            //     id_usuario,
            //     nome_animal
            // }) =>{
            //     $('[data-id="pet-view"]').attr('id', 'pet-alterar-modal-'+id_animal);
            //     $('#pet-nome').prepend(nome_animal);
            //     $('#form-alterar-pet').attr('id', 'form-alterar-pet-'+id_animal);

            //     if(foto_animal == null){
            //         $('#form-pet-pic-alterar').attr('src', path_pet+'unknown.jpg');
            //     }else{
            //         $('#form-pet-pic-alterar').attr('src', path_pet+'/'+user.email+'/'+foto_animal);
            //         $('#form-pet-pic-alterar').attr('alt', 'Foto de '+nome_animal);
            //         $('#form-pet-pic-alterar').attr('title', 'Foto de '+nome_animal);

            //         $('#input-foto-animal-com-foto').attr('value', foto_animal);
            //     }

            //     $('#frm_alterar_id_animal').attr('value', id_animal);
            //     $('#frm_alterar_id_usuario').attr('value', id_usuario);
            //     $('#frm_alterar_nome_animal').attr('value', nome_animal);
                
            //     $('.form-btn').attr('id', id_animal);
                
                
            //     $('#pet-excluir-modal').attr('id', 'pet-excluir-modal-'+id_animal);
            //     $('#delete-pet-message').prepend('Você deseja realmente excluir '+nome_animal+' ? :(');
            //     $('.del-pet-btn').attr('id', id_animal);
            //     $('.del-pet-btn').attr('data-id', id_animal);
            // });

            tipos.map(({
                id_tipo,
                descricao
            }) => {
                var descTratado = descricao[0].toUpperCase()+descricao.substr(1);
                $('#frm_criar_tipo').append(`<option value='${id_tipo}'>${descTratado}</option>`);
            });

            r.sexo.map(({
                id_sexo,
                descricao
            }) => {
                var descTratado = descricao[0].toUpperCase()+descricao.substr(1);
                $('#frm_criar_sexo_animal').append(`<option value='${id_sexo}'>${descTratado}</option>`);
            });

            console.log( $('#tipo-animal').attr('id'));
            console.log($('[data-img-user]').attr('src'));
            console.log($('#form-pet-pic-alterar').attr('src'));
            
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
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

    if( checkURL('settings') ) {
        $.ajax({
            type: "GET",
            url: base_url+"get-dados-user",
            success: function (r) {
                var path_user = base_url+'assets/img/user';
                var path_pet = base_url+'assets/img/pet';

                var user = r.usuario;
                var pets = r.pet;
                var tipos = r.tipo;
                
                if(user.foto_usuario == null){
                    $('[data-img-user]').attr('src', path_user+'/unknown.jpg');
                }else{
                    $('[data-img-user]').attr('src', path_user+'/'+user.email+'/'+user.foto_usuario);
                }
                $('[data-img-user]').attr('alt', 'Foto de '+user.nome_usuario);
                $('[data-img-user]').attr('title', 'Foto de '+user.nome_usuario);

                //Populate form alterar dados
                $('#input-form-email').attr('value', user.email);
                $('[name="nome_usuario"]').attr('value', user.nome_usuario);
                $('[name="data_nascimento"]').attr('value', user.data_nascimento);
                $('[name="telefone"]').attr('value', user.telefone);


                //Pet View

                const editPetModal = document.querySelector('#pet-alterar-modal');
                const deletePetModal = document.querySelector('#pet-excluir-modal');

                pets.map((pet) => {
                    let newPetContainer = document.querySelector('.pet').cloneNode(true);
                    newPetContainer.style.display = 'flex';

                    // Foto
                    if(pet.foto_animal == null) {
                        newPetContainer.querySelector('.pet-pic').src = `${path_pet}/unknown.jpg`;
                    } else {
                        newPetContainer.querySelector('.pet-pic').src = `${path_pet}/${user.email}/${pet.foto_animal}`;
                    }
                    
                    if(pet.nome_animal.length > 10) {
                        newPetContainer.querySelector('.pet-name').innerText = `${pet.nome_animal.substring(0, 10)}...`;
                    } else {
                        newPetContainer.querySelector('.pet-name').innerText = pet.nome_animal;
                    }
                    

                    // Ao clicar em editar pet
                    newPetContainer.querySelector('#edit-pet').addEventListener('click', () => {
                        if(pet.nome_animal.length > 50) {
                            editPetModal.querySelector('.modal-title').innerText = `Alterar Pet ${pet.nome_animal.substring(0, 50)}...`
                        } else {
                            editPetModal.querySelector('.modal-title').innerText = `Alterar Pet ${pet.nome_animal}`
                        }

                        if(pet.foto_animal == null) {
                            editPetModal.querySelector('#form-pet-pic-alterar').src = `${path_pet}/unknown.jpg`;
                        } else {
                            editPetModal.querySelector('#form-pet-pic-alterar').src = `${path_pet}/${user.email}/${pet.foto_animal}`;
                        }

                        editPetModal.querySelector('#form-pet-pic-alterar').alt = `Foto do ${pet.nome_animal}`;
                        editPetModal.querySelector('#form-pet-pic-alterar').title = pet.nome_animal;
                        
                        if(pet.nome_animal.length > 35) {
                            editPetModal.querySelector('.form-title').innerText = `Altere as informações de ${pet.nome_animal.substring(0, 35)}...`;
                        } else {
                            editPetModal.querySelector('.form-title').innerText = `Altere as informações de ${pet.nome_animal}`;
                        }

                        editPetModal.querySelector('#frm_alterar_id_animal').value = pet.id_animal;
                        editPetModal.querySelector('#frm_alterar_id_usuario').value = user.id_usuario;
                        editPetModal.querySelector('#frm_alterar_nome_animal').value = pet.nome_animal;
                    });

                    // Ao clicar em remover pet
                    newPetContainer.querySelector('#delete-pet').addEventListener('click', () => {
                        if(pet.nome_animal.length > 50) {
                            deletePetModal.querySelector('.modal-title').innerText = `Deletar Pet ${pet.nome_animal.substring(0, 50)}...`
                        } else {
                            deletePetModal.querySelector('.modal-title').innerText = `Deletar Pet ${pet.nome_animal}`
                        }

                        
                        deletePetModal.querySelector('.del-pet-btn').setAttribute('data-id', pet.id_animal)
                    })

                    document.querySelector('#user-pets').appendChild(newPetContainer);
                })

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

            }
        });
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

    }

    if( !(checkURL('') || checkURL('register')) ) {
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
                        alert(response.mensagem);
                    
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
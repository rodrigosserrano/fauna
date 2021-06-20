
$(document).ready(function(){
    if(window.location.origin != 'http://localhost'){
        base_url = 'http://lds.codeigniter-dev/';
    }else{
        base_url = `${window.location.origin}/fauna/`;
}

    // Constantes
    const bodyElement = document.querySelector('body');
    const path_user = base_url+'assets/img/user';
    const path_pet = base_url+'assets/img/pet';

    // Fechar Modal
    function closeModal(modal) {
        bodyElement.removeAttribute('class');
        modal.style.display = 'none';
        modal.className = 'modal fade';
        modal.setAttribute('aria-hidden', true);
        modal.removeAttribute('role');
        modal.removeAttribute('aria-modal');
        bodyElement.removeChild(document.querySelector('.modal-backdrop'));
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

    // Criar pet novo sem reiniciar página
    function loadPet(form, blob = null) {
        let item = {}
        form.forEach((value, key) => {
            item[key] = value;
        });
        
        if(blob) {
            item['blob'] = blob.substr(5).slice(0, -2);
        }
        
        return item;
    }

    if( checkURL('settings') ) {

        //USUARIO

        //Excluir conta
        $("#btn-excluir-usuario").click(function(){
            $.ajax({
                type: "POST",
                url: base_url+"delete",
                success: function (response) {
                    if(response.mensagem){
                        AlertFunc(response.mensagem);
                        // alert(response.mensagem);
                        window.location.reload();
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
        });

        //Alterar dados conta
        $("#btn-altera-dados-usuario").click(function(){
            let form = new FormData(document.getElementById("form_alterar"));
            
            $.ajax({
                type: "POST",
                url: base_url+"edit",
                data: form,
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.mensagem){
                        // alert(response.mensagem);
                        alertFunc(response.mensagem);
                        // window.location.reload();
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
        });

        $.ajax({
            type: "GET",
            url: base_url+"get-dados-user",
            success: function (r) {
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

                //Cadastrar Pet
                $("#btn-cria-pet").click(function(){
                    
                    let form = new FormData(document.getElementById("form-criar-pet"));
                    
                    $.ajax({
                        type: "POST",
                        url: base_url+"create-pet",
                        data: form,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if(response.mensagem){
                                alertFunc(response.mensagem);
                                closeModal(document.querySelector('#pet-criar-modal'));

                                if(response.id) {
                                    let url = document.querySelector('#pet-criar-modal').querySelector('.form-pic').style.backgroundImage;
                                    let pet = loadPet(form, url);
                                    pet['id_animal'] = response.id;

                                    showPet(pet);
                                }
                                
                                // alert(response.mensagem);
                                // window.location.reload();
                            }
                        },
                        error: function (request, status, error) {
                            console.log(request.responseText);
                        }
                    });
                });

                //   Excluir pet
                $("#btn-excluir-pet").click(function(){
                        let id = $("#btn-excluir-pet").attr('data-id');
                        $.ajax({
                            type: "POST",
                            url: base_url+"delete-pet",
                            data: {id_animal:id},
                            success: function (response) {
                                if(response.mensagem){
                                    alertFunc(response.mensagem);
                                    closeModal(deletePetModal);

                                    let petId = deletePetModal.querySelector('#btn-excluir-pet').getAttribute('data-id');
                                    let deletedPet = document.getElementById(petId);
                                    document.querySelector('#user-pets').removeChild(deletedPet);
                                    
                                    
                                    // alert(response.mensagem);
                                    // window.location.reload();
                                }
                            },
                            error: function (request, status, error) {
                                console.log(request.responseText);
                            }
                        });
                });

                $("#btn-altera-pet").click(function(){

                    let form = new FormData(document.getElementById('form-alterar-pet'));

                    $.ajax({
                        type: "POST",
                        url: base_url+"edit-pet",
                        data: form,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if(response.mensagem){

                                alertFunc(response.mensagem);
                                closeModal(editPetModal);

                                let pet = loadPet(form);
                                pet['id_animal'] = editPetModal.querySelector('[name=id_animal]').value;
                                pet['foto_animal'] = editPetModal.querySelector('.form-pet-pic').src;

                                let editedPet = document.getElementById(pet.id_animal);
                                editedPet.querySelector('.pet-name').innerText = pet.nome_animal;
                                editedPet.querySelector('.pet-pic').src = pet.foto_animal;


                                // alert(response.mensagem);
                                // window.location.reload();
                            }
                        },
                        error: function (request, status, error) {
                            console.log(request.responseText);
                        }
                    });
                });

                function showPet(pet) {
                    let newPetContainer = document.querySelector('.pet').cloneNode(true);
                    newPetContainer.style.display = 'flex';
                    if(pet.id_animal) {
                        newPetContainer.id = pet.id_animal;
                    }
            
                    // Foto
                    if(pet.blob) {
                        newPetContainer.querySelector('.pet-pic').src = pet.blob;
                        
                    } else if(pet.foto_animal == null || pet.foto_animal.name == '') {
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
                }

                pets.map((pet) => {
                    showPet(pet);
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

    function uriRoute() {
        let route = window.location.href.replace(base_url, '').split('/');
        return route;
    }

    if( uriRoute()[0] == 'profile' ) {

        const deleteModal = document.querySelector('#modal-delete-seguidor');

        let id = uriRoute()[1];
        let url = id ? `${base_url}get-profile/${id}` : `${base_url}get-profile`;
        $.ajax({
            type: "GET",
            url: url,
            success: function (r) {
                // console.log(r.tipo);
                let user = r.usuario;
                let pets = r.pet;
                let sexo;
                let n_seguindo = r.n_seguindo;
                let n_seguidores = r.n_seguidores;
                let seguindo = r.seguindo;
                let seguidores = r.seguidores;
                let postagens = r.postagens;
                let is_user = r.is_user;
                let is_following = r.is_following;
                let date = new Date(user.data_nascimento);
                let dataFormatada = ((date.getDate() + 1)) + "/" + ((date.getMonth() + 1)) + "/" + date.getFullYear();

                r.sexo.map((sexo) => {
                    id_sexo = sexo.id_sexo,
                    desc_sexo = sexo.descricao

                    if(id_sexo == user.sexo_usuario){
                        $('[name="sexo"]').html(desc_sexo[0].toUpperCase() + desc_sexo.substr(1));
                    }
                })

                let btnsArea = document.querySelector('#btns-area');
                if(is_user) {
                    document.querySelector('#user-profile-title').removeChild(btnsArea);
                } else {
                    btnsArea.style.display = 'flex';

                    // Botão Seguir
                    let btnFollowElement = document.querySelector('.btn-follow');

                    if(is_following) {
                        startFollowing(btnFollowElement);
                    } else {
                        stopFollowing(btnFollowElement);
                    }

                    btnFollowElement.addEventListener('click', () => {

                        if(btnFollowElement.id == 'btn-seguir') {
                            $.ajax({
                                type: "POST",
                                url: base_url+"create-seguir",
                                data: { id_usuario: user.id },
                                success: function () {
                                    startFollowing(btnFollowElement);

                                    let navItem = document.querySelector('.nav-userpic')

                                    let seguidor = {
                                        email: r.logged_user.email,
                                        foto_usuario: navItem.src.split('/').slice(-1).pop(),
                                        id_usuario: r.logged_user.id,
                                        usuario: navItem.title,
                                    }

                                    showFollowingProfile(seguidor, '#menu-follower');
                                }
                            })
                        } else {
                            $.ajax({
                                type: "POST",
                                url: base_url+"delete-seguindo",
                                data: { id_usuario: user.id },
                                success: function () {
                                    stopFollowing(btnFollowElement);
                                    let listaSeguidores = document.querySelector('#menu-follower').querySelector('.follow-area');
                                    let userFollow = listaSeguidores.querySelector(`div[id='${r.logged_user.id}']`);
                                    listaSeguidores.removeChild(userFollow);
                                }
                            })
                        }
                    })

                    function startFollowing(btn) {
                        btn.innerText = 'Seguindo';
                        btn.id = 'btn-deixar-seguir';
                    }

                    function stopFollowing(btn) {
                        btn.innerText = 'Seguir';
                        btn.id = 'btn-seguir';
                    }
                }

                if(user.foto_usuario == null){
                    $('[data-img-user]').attr('src', `${path_user}/unknown.jpg`);
                }else{
                    $('[data-img-user]').attr('src', `${user.foto_usuario}`);
                }
                $('[data-img-user]').attr('alt', `Foto de ${user.nome_usuario}`);
                $('[data-img-user]').attr('title', `Foto de ${user.nome_usuario}`);

                //Populate profile user
                $('#nome-usuario-profile').html(user.nome_usuario);
                $('[name="data_nascimento"]').html(`Nasceu em ${dataFormatada}`);
                $('[name="telefone"]').html(`+055 ${user.telefone}`);

                pets.map((pet) => {
                    showPetProfile(pet, r.tipo, r.sexo, r.usuario);
                })

                let postPerLoad = 3;
                let postIndex = 0;
                let check = postagens.length > postPerLoad;

                let menu = document.querySelector('#menu-post');
                let btn = menu.querySelector('.more')

                if(postagens.length == 0) {
                    btn.innerText = 'Nenhuma postagem';
                    btn.style.marginTop = '10px';
                    btn.style.color = '#000';
                }

                postagens.map((post) => {
                    if(check) {
                        if(postIndex < postPerLoad) {
                            showPost(post);
                            postIndex++;
                        } else {
                            
                            menu.appendChild(btn);
                            btn.addEventListener('click', () => {
                                showPost(post);
                                menu.removeChild(btn);
                            })
                        }
                    } else {
                        menu.removeChild(btn);
                    }
                    
                })

                seguindo.map((seguido) => {
                    showFollowingProfile(seguido, '#menu-following', is_user);
                })

                seguidores.map((seguidor) => {
                    showFollowingProfile(seguidor, '#menu-follower', is_user);
                })
            },
            error: function (err) {
                console.log(err)
              }
        });

        const petModal = document.querySelector('#pet-info');

        function showPetProfile(pet, tipos, sexos, user){ 
            // console.log(user)
            let petArea = document.querySelector('#user-profile-pet-area');
            let newPetContainerProfile = petArea.querySelector('.unit').cloneNode(true);
            newPetContainerProfile.style.display = 'flex';

            // Foto
            if(pet.foto_animal == null) {
                newPetContainerProfile.querySelector('.unit-pic').setAttribute('src', `${path_pet}/unknown.jpg`);
            } else {
                newPetContainerProfile.querySelector('.unit-pic').setAttribute('src', `${path_pet}/${user.email}/${pet.foto_animal}`);
                newPetContainerProfile.querySelector('.unit-pic').setAttribute('alt', pet.nome_animal);
                newPetContainerProfile.querySelector('.unit-pic').setAttribute('title', pet.nome_animal);
            }
            
            if(pet.nome_animal.length > 10) {
                newPetContainerProfile.querySelector('#pet-name').innerText = `${pet.nome_animal.substring(0, 10)}...`;
            } else {
                newPetContainerProfile.querySelector('#pet-name').innerText = pet.nome_animal;
            }

            newPetContainerProfile.addEventListener('click', () => {
                // Foto
                if(pet.foto_animal == null) {
                    petModal.querySelector('[data-pet-img]').setAttribute('src', `${path_pet}/unknown.jpg`);
                } else {
                    petModal.querySelector('[data-pet-img]').setAttribute('src', `${path_pet}/${user.email}/${pet.foto_animal}`);
                    petModal.querySelector('[data-pet-img]').setAttribute('alt', pet.nome_animal);
                    petModal.querySelector('[data-pet-img]').setAttribute('title', pet.nome_animal);
                }
                
                if(pet.nome_animal.length > 10) {
                    petModal.querySelector('#pet-name').innerText = `${pet.nome_animal.substring(0, 10)}...`;
                } else {
                    petModal.querySelector('#pet-name').innerText = pet.nome_animal;
                }
                
                tipos.map((tipo) => {
                    if(tipo.id_tipo == pet.tipo){
                        petModal.querySelector('#tipo-pet').innerText = tipo.descricao;
                    }
                });
    
                petModal.querySelector('#raca-pet').innerText = pet.raca;
    
                sexos.map((sexo) => {
                    if(sexo.id_sexo == pet.sexo_animal){
                        petModal.querySelector('#sexo-animal').innerText = sexo.descricao;
                    }
                })
        })

            petArea.appendChild(newPetContainerProfile);
        }

        function showPost(post) {
            let postArea = document.querySelector('#menu-post');

            let newPost = postArea.querySelector('.post-card').cloneNode(true);
            newPost.style.display = 'flex';

            if(post.midia == null) {
                newPost.querySelector('.post-pic img').setAttribute('src', `${base_url}assets/teste/pitbull.png`);
            } else {
                newPost.querySelector('.post-pic img').setAttribute('src', `${base_url}assets/img/post/${post.midia_url}`);
                newPost.querySelector('.post-pic img').setAttribute('alt', 'Foto da Postagem');
            }

            newPost.querySelector('.post-description').innerText = post.descricao;
            newPost.querySelector('.post-date').innerText = post.dh_post;
            newPost.querySelector('.like-amount').innerText = post.curtidas;

            newPost.querySelector('.post-pic').href = `${base_url}home/${post.id_postagem}`;

            postArea.appendChild(newPost);
        }

        function showFollowingProfile(seguidor, element, is_user) {
            let followingArea = document.querySelector(element);

            let newFollowingContainer = followingArea.querySelector('.unit').cloneNode(true);
            newFollowingContainer.id = seguidor.id_usuario;
            newFollowingContainer.style.display = 'flex';
            
            if(seguidor.foto_usuario == null) {
                newFollowingContainer.querySelector('.unit-pic').setAttribute('src', `${path_user}/unknown.jpg`);
            } else {
                newFollowingContainer.querySelector('.unit-pic').setAttribute('src', `${path_user}/${seguidor.email}/${seguidor.foto_usuario}`);
                newFollowingContainer.querySelector('.unit-pic').setAttribute('alt', seguidor.usuario);
                newFollowingContainer.querySelector('.unit-pic').setAttribute('title', seguidor.usuario);
            }
            
            if(seguidor.usuario.length > 10) {
                newFollowingContainer.querySelector('.unit-name').innerText = `${seguidor.usuario.substring(0, 10)}...`;
            } else {
                newFollowingContainer.querySelector('.unit-name').innerText = seguidor.usuario;
            }

            newFollowingContainer.querySelector('.card').addEventListener('click', () => {
                window.location.href = `${base_url}profile/${seguidor.id_usuario}`;
            })

            if(element == '#menu-follower') {
                if(is_user) {
                    newFollowingContainer.querySelector('.delete-follower').addEventListener('click', () => {
                        deleteModal.querySelector('.modal-title span').innerText = seguidor.usuario;
                        deleteModal.querySelector('.modal-btn').setAttribute('data-id', seguidor.id_usuario);
                    });
                } else {
                    newFollowingContainer.removeChild(newFollowingContainer.querySelector('.delete-follower'));
                }
            }
            
            followingArea.querySelector('.follow-area').appendChild(newFollowingContainer);
        }

        // Deletar Seguidor
        let btnDeletar = document.querySelector('#btn-deletar-seguidor');
        btnDeletar.addEventListener('click', () => {
            let id = btnDeletar.getAttribute('data-id');

            $.ajax({
                type: "POST",
                url: base_url+"delete-seguidor",
                data: { id_usuario: id },
                success: function () {
                    closeModal(deleteModal);
                    let listaSeguidores = document.querySelector('#menu-follower').querySelector('.follow-area');
                    let userFollow = listaSeguidores.querySelector(`div[id='${id}']`);
                    listaSeguidores.removeChild(userFollow);
                }
            })
        })
            
    }


    // Esqueci minha senha
    if( checkURL('forgot') ) {
        document.querySelector('.logo').addEventListener('click', () => {
            window.location.href = `${base_url}home`;
        })

        $("#btn-recuperar").click(function() {
            let form = new FormData(document.getElementById('form-recovery'));

            $.ajax({
                type: "POST",
                url: base_url+"send-mail",
                data: form,
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.mensagem) {
                        alertFunc(response.mensagem);
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                } 
            })
        });
    }
});
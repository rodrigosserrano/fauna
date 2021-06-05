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

    function trataString(string) {
        var stringTratada = string[0].toUpperCase()+string.substr(1);
        return stringTratada;
    }

    // Requisição GET das Postagens e Comentários via AJAX
    if( checkURL('home') ) {

        $.ajax({
            type: "GET",
            url: base_url+"get-post-comment",
            success: function (r) {
                var path_user = base_url+'assets/img/user';
                // var path_pet = base_url+'assets/img/pet';

                console.log(r);
                var categorias = r.categorias;
                var pets = r.pets;
                var postagens = r.postagens;
                var usuario = r.usuario;

                // Modal
                const editComentarioModal = document.querySelector('#edit-comment-modal');
                const editPostagemModal = document.querySelector('#edit-post-modal');
                const newPostagemModal = document.querySelector('#new-post-modal');

                //Criar postagem
                categorias.map(({
                    id_categoria,
                    descricao
                }) => {
                    newPostagemModal.querySelector('[name="id_categoria"]').innerHTML += `<option value='${id_categoria}'>`+trataString(descricao)+`</option>`;
                    // $('[name="id_categoria"]').append(`<option value='${id_categoria}'>`+trataString(descricao)+`</option>`);
                });

                pets.map(({
                    id_animal,
                    nome_animal
                }) => {
                    newPostagemModal.querySelector('[name="id_animal"]').innerHTML += `<option value='${id_animal}'>`+trataString(nome_animal)+`</option>`;
                    // $('[name="id_animal"]').append(`<option value='${id_animal}'>`+trataString(nome_animal)+`</option>`);
                });

                //Postagem

                postagens.map((postagem) => {
                    // console.log(postagem);
                    let newPost = document.querySelector('.post').cloneNode(true);
                    newPost.style.display = 'block';

                    newPost.id = postagem.id_postagem;

                    // Foto Usuário
                    if(postagem.foto_usuario == null) {
                        newPost.querySelector('.profile-photo').src = `${path_user}/unknown.jpg`;
                    } else {
                        newPost.querySelector('.profile-photo').src = `${path_user}/${postagem.email}/${postagem.foto_usuario}`;
                    }
                    newPost.querySelector('.profile-photo').addEventListener('click', () =>{
                        window.location.href = postagem.perfil;
                    });

                    //Nome usuário e pet
                    newPost.querySelector('#user-name').innerText = postagem.usuario;
                    newPost.querySelector('#user-name').addEventListener('click', () =>{
                        window.location.href = postagem.perfil;
                    });
                    newPost.querySelector('#pet-name').innerText = postagem.animal;

                    //Data postagem
                    let data = new Date(postagem.dh_post);
                    let dataFormatada = ((data.getDate() )) + "/" + ((data.getMonth() + 1)) + "/" + data.getFullYear(); 
                    newPost.querySelector('#date-post').innerText = dataFormatada;
                    
                    //Desc postagem
                    newPost.querySelector('#desc-post').innerText = postagem.descricao;
                    
                    //Foto postagem
                    if(postagem.midia == null) {
                        newPost.querySelector('#post-photo').src = `${base_url}/assets/teste/pitbull.png`;
                    } else {
                        newPost.querySelector('#post-photo').src = `${base_url}/assets/img/post/${postagem.midia_url}`;
                    }

                    // Like
                    newPost.querySelector("#like-icon").addEventListener("click", e => {
                        if(e.target.getAttribute("src") === `${base_url}assets/img/icon/paw-like-unset.png`){
                            e.target.setAttribute("src", `${base_url}assets/img/icon/paw-like-set.png`);
                        }
                        else
                            e.target.setAttribute("src", `${base_url}assets/img/icon/paw-like-unset.png`);
                    })
                    
                    //Comentário
                    postagem.comentarios.map((comentario) => {
                        let newComment = document.querySelector('.comment').cloneNode(true);
                        newComment.style.display = 'flex';
                        
                        newComment.id = comentario.id_comentario;

                        
                        //Foto usuário
                        if(comentario.foto_usuario == null) {
                            newComment.querySelector('.comment-user-photo').src = `${path_user}/unknown.jpg`;
                        } else {
                            newComment.querySelector('.comment-user-photo').src = `${path_user}/${comentario.email}/${comentario.foto_usuario}`;
                        }

                        newComment.querySelector('.comment-user-photo').addEventListener('click', () => {
                            window.location.href = `${base_url}profile/${comentario.id_usuario}`;
                        });

                        //Nome usuario
                        newComment.querySelector('.comment-user').innerText = comentario.usuario;

                        newComment.querySelector('.comment-user').addEventListener('click', () => {
                            window.location.href = `${base_url}profile/${comentario.id_usuario}`;
                        });

                        //Comentário
                        newComment.querySelector('.comment-text').innerText = comentario.texto;

                        if(comentario.id_usuario == usuario.id_usuario || usuario.is_admin) {
                            // Editar Comentário
                            newComment.querySelector('#edit-comment').addEventListener('click', () => {
                                editComentarioModal.querySelector('textarea').value = comentario.texto;
                                editComentarioModal.querySelector('input[name=id_comentario]').value = comentario.id_comentario;
                            })
                            
                            // Deletar Comentário
                            newComment.querySelector('#delete-comment').addEventListener('click', () => {
                                let id = newComment.id;
                                $.ajax({
                                    type: "POST",
                                    url: base_url+"delete-comentario",
                                    data: {id_comentario:id},
                                    success: function (response) {
                                        if(response.mensagem){
                                            alert(response.mensagem);
                                            window.location.reload();
                                        }
                                    },
                                    error: function (request, status, error) {
                                        console.log(request.responseText);
                                    }
                                });
                            })
                        } else {
                            // Remover opções de comentário se o usuário não for o dono dele
                            let menu = newComment.querySelectorAll('.comment-info')[0];
                            menu.removeChild(menu.childNodes[3]);
                        }
    
                        newPost.querySelector('.comments').appendChild(newComment);
                    })


                    // Criar Comentário
                    newPost.querySelector("#id_postagem").value = postagem.id_postagem;

                    newPost.querySelector('.send-comment').addEventListener('click', () => {
                        let formData = new FormData(newPost.querySelector('.form-comment'));
                        $.ajax({
                            type: "POST",
                            url: base_url+"create-comentario",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                if(response.mensagem){
                                    alert(response.mensagem);
                                    window.location.reload();
                                }
                            },
                            error: function (request, status, error) {
                                console.log(request.responseText);
                            }
                        });
                    })

                    if(postagem.id_usuario == usuario.id_usuario || usuario.is_admin) {
                        // Editar Postagem
                        newPost.querySelector('#edit-post').addEventListener('click', () => {
                            editPostagemModal.querySelector('textarea').innerText = postagem.descricao;
                            editPostagemModal.querySelector('[name="id_postagem"]').value = postagem.id_postagem;

                            editPostagemModal.querySelector('[name="id_categoria"]').innerHTML = '<option disabled>Categoria</option>';
                            editPostagemModal.querySelector('[name="id_animal"]').innerHTML = '<option disabled>Pet relacionado</option>';

                            // Carregar a categoria da postagem a ser editada
                            categorias.map(({
                                id_categoria,
                                descricao
                            }) => {
                                if(id_categoria == postagem.id_categoria) {
                                    editPostagemModal.querySelector('[name="id_categoria"]').innerHTML += `<option selected value='${id_categoria}'>`+trataString(descricao)+`</option>`;
                                } else {
                                    editPostagemModal.querySelector('[name="id_categoria"]').innerHTML += `<option value='${id_categoria}'>`+trataString(descricao)+`</option>`;
                                }
                            });
                
                            // Carregar o animal da postagem a ser editada
                            pets.map(({
                                id_animal,
                                nome_animal
                            }) => {
                                if(id_animal == postagem.id_animal) {
                                    editPostagemModal.querySelector('[name="id_animal"]').innerHTML += `<option selected value='${id_animal}'>`+trataString(nome_animal)+`</option>`;
                                } else {
                                    editPostagemModal.querySelector('[name="id_animal"]').innerHTML += `<option value='${id_animal}'>`+trataString(nome_animal)+`</option>`;
                                }
                                
                            });
                        })

                        // Deletar Postagem
                        newPost.querySelector('#delete-post').addEventListener('click', () => {
                            let id = newPost.id;
                            $.ajax({
                                type: "POST",
                                url: base_url+"delete-postagem",
                                data: {id_postagem:id},
                                success: function (response) {
                                    if(response.mensagem){
                                        alert(response.mensagem);
                                        window.location.reload();
                                    }
                                },
                                error: function (request, status, error) {
                                    console.log(request.responseText);
                                }
                            });
                        })
                    } else {
                        // Remover botões se o usuário não for o dono da postagem
                        let menu = newPost.querySelector('.desc-n-menu');
                        menu.removeChild(menu.childNodes[5]);
                    }

                    // Botões de Menu da Postagem
                    Array.from(newPost.querySelectorAll(".menu-icon")).forEach((el, i) => {
                        el.addEventListener("click", e => {
                            e.stopPropagation();
                            const listOpts = Array.from(newPost.querySelectorAll(".list-opts"));
                            for(j in listOpts){
                                if(j != i)
                                    if(listOpts[j].classList.contains("display-block")){
                                        listOpts[j].classList.remove("display-block");
                                        listOpts[j].classList.add("display-none");
                                    }
                            }
                
                            if(listOpts[i].classList.contains("display-none")){
                                listOpts[i].classList.remove("display-none");
                                listOpts[i].classList.add("display-block");
                            }
                            else if(listOpts[i].classList.contains("display-block")){
                                listOpts[i].classList.remove("display-block");
                                listOpts[i].classList.add("display-none");
                            }
                        })
                    })

                    // Botões de Menu sumirem ao clicar em outra área da tela
                    document.getElementsByTagName("body")[0].addEventListener("click", () => {
                        Array.from(newPost.querySelectorAll(".menu-list")).forEach(el => {
                            if(el.classList.contains("display-block")){
                                el.classList.remove("display-block");
                                el.classList.add("display-none");
                            }
                        })
                    })
                    
                    document.querySelector('.posts').appendChild(newPost);
                    
                })
            }
        });


        // Criar Postagem
        $("#btn-cria-postagem").click(function(){
            
            let form = new FormData(document.getElementById("form-criar-post"));

            $.ajax({
                type: "POST",
                url: base_url+"create-postagem",
                data: form,
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.mensagem){
                        alert(response.mensagem);
                        window.location.reload();
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
        });

        // Alterar Postagem
        $("#btn-altera-postagem").click(function(){

            let form = new FormData(document.getElementById('form-editar-post'));

            $.ajax({
                type: "POST",
                url: base_url+"edit-postagem",
                data: form,
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.mensagem){
                        alert(response.mensagem);
                        window.location.reload();
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
        });


        // Alterar Comentário
        $("#btn-altera-comentario").click(function(){

            let form = new FormData(document.getElementById('form-editar-comentario'));

            $.ajax({
                type: "POST",
                url: base_url+"edit-comentario",
                data: form,
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.mensagem){
                        alert(response.mensagem);
                        window.location.reload();
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
        });

    }
});

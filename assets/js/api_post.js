$(document).ready(function(){
    if(window.location.origin != 'http://localhost'){
        base_url = 'http://lds.codeigniter-dev/';
    }else{
        base_url = `${window.location.origin}/fauna/`;
    }

    const bodyElement = document.querySelector('body');

    // Checagem de rota
    function checkURL(route) {
        return window.location.href == base_url + route;
    }

    function trataString(string) {
        var stringTratada = string[0].toUpperCase()+string.substr(1);
        return stringTratada;
    }

    function uriRoute() {
        let route = window.location.href.replace(base_url, '').split('/');
        return route;
    }

    function alertFunc(message) {
        var alertBox = document.createElement('div');
        alertBox.setAttribute('class', 'alert-msg');
        alertBox.appendChild(document.createTextNode(message));
        document.querySelector('.alert-area').appendChild(alertBox);
        setTimeout(function() { document.querySelector('.alert-area').removeChild(alertBox) }, 4000);
    }

    function closeModal(modal) {
        bodyElement.removeAttribute('class');
        modal.style.display = 'none';
        modal.className = 'modal fade';
        modal.setAttribute('aria-hidden', true);
        modal.removeAttribute('role');
        modal.removeAttribute('aria-modal');
        bodyElement.removeChild(document.querySelector('.modal-backdrop'));
    }

    function loadProps(form, blob = null) {
        let item = {}
        form.forEach((value, key) => {
            item[key] = value;
        });

        if(blob) {
            item['blob'] = blob.substr(5).slice(0, -2);
        }
        
        return item;
    }

    // Requisição GET das Postagens e Comentários via AJAX

    if( uriRoute()[0] == 'home' ) {

        // Modal
        const editComentarioModal = document.querySelector('#edit-comment-modal');
        const editPostagemModal = document.querySelector('#edit-post-modal');
        const newPostagemModal = document.querySelector('#new-post-modal');

        // Navegação
        document.querySelector('#explore').addEventListener('click', () => {
            window.location.href = `${base_url}home`;
        })

        document.querySelector('#adoption').addEventListener('click', () => {
            window.location.href = `${base_url}home/adocao`;
        })

        document.querySelector('#lost-animals').addEventListener('click', () => {
            window.location.href = `${base_url}home/desaparecimento`;
        })

        // Navegação Mobile
        document.querySelector('#explore-mobile').href = `${base_url}home`;
        document.querySelector('#adoption-mobile').href = `${base_url}home/adocao`;
        document.querySelector('#lost-animals-mobile').href = `${base_url}home/desaparecimento`;


        // Filtro
        let filter = uriRoute()[1];

        get_url = `${base_url}get-post-comment`;

        if(filter) {
            get_url += `/${filter}`;
        }

        // Busca
        $.ajax({
            type: "GET",
            url: get_url,
            success: function (r) {
                var path_user = base_url+'assets/img/user';
                // var path_pet = base_url+'assets/img/pet';

                // console.log(r);
                var categorias = r.categorias;
                var pets = r.pets;
                var postagens = r.postagens;
                var usuario = r.usuario;

                if(!postagens.length) {
                    let noPostAlert = document.createElement('div');
                    noPostAlert.id = 'empty-page';
                    noPostAlert.innerText = 'Nenhuma postagem encontrada.';
                    document.querySelector('.posts').appendChild(noPostAlert);
                }

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
                    if(postagem.usuario.length > 24) {
                        newPost.querySelector('#user-name').innerText = `${postagem.usuario.substring(0, 24)}...`;
                    } else {
                        newPost.querySelector('#user-name').innerText = postagem.usuario;
                    }

                    newPost.querySelector('#user-name').addEventListener('click', () =>{
                        window.location.href = postagem.perfil;
                    });

                    if(postagem.animal.length > 24) {
                        newPost.querySelector('#pet-name').innerText = `${postagem.animal.substring(0, 24)}...`;
                    } else {
                        newPost.querySelector('#pet-name').innerText = postagem.animal;
                    }

                    //Data postagem
                    let data = new Date(postagem.dh_post);
                    let dataFormatada = ((data.getDate() )) + "/" + ((data.getMonth() + 1)) + "/" + data.getFullYear(); 
                    newPost.querySelector('#date-post').innerText = dataFormatada;
                    
                    //Desc postagem
                    newPost.querySelector('#desc-post').innerText = postagem.descricao;
                    
                    //Foto postagem
                    if(postagem.midia == null) {
                        newPost.querySelector('#post-photo').src = `${base_url}/assets/img/post/unknown.jpg`;
                    } else {
                        newPost.querySelector('#post-photo').src = `${base_url}/assets/img/post/${postagem.midia_url}`;
                    }

                    // Like
                    let likeAmountElement = newPost.querySelector('#likes-number');
                    likeAmountElement.innerText = postagem.curtidas;

                    if(postagem.curtiu) {
                        newPost.querySelector('#like-icon img').src = `${base_url}assets/img/icon/paw-like-set.png`;
                    } else {
                        newPost.querySelector('#like-icon img').src = `${base_url}assets/img/icon/paw-like-unset.png`;
                    }

                    newPost.querySelector("#like-icon").addEventListener("click", e => {
                        if(e.target.getAttribute("src") === `${base_url}assets/img/icon/paw-like-unset.png`){
                            // Dar like
                            e.target.setAttribute("src", `${base_url}assets/img/icon/paw-like-set.png`);
                            likeAmountElement.innerText = Number(likeAmountElement.innerText) + 1;

                            let postLikeID = postagem.id_postagem;

                            $.ajax({
                                type: "POST",
                                url: base_url+"create-curtida",
                                data: { id_postagem: postLikeID },
                            })
                        }
                        else {
                            // Retirar Like
                            e.target.setAttribute("src", `${base_url}assets/img/icon/paw-like-unset.png`);
                            likeAmountElement.innerText = Number(likeAmountElement.innerText) - 1;

                            let postLikeID = postagem.id_postagem;

                            $.ajax({
                                type: "POST",
                                url: base_url+"delete-curtida",
                                data: { id_postagem: postLikeID },
                            })
                        }
                    })
                    
                    //Comentário

                    function loadComentario(comentario, isNew = null) {                       
                        let newComment = document.querySelector('.comment').cloneNode(true);
                        newComment.style.display = 'flex';
                        
                        newComment.id = comentario.id_comentario;

                        
                        //Foto usuário
                        if(comentario.blob) {
                            newComment.querySelector('.comment-user-photo').src = comentario.blob;
                        } else if(comentario.foto_usuario == null || comentario.blob?.name == '') {
                            newComment.querySelector('.comment-user-photo').src = `${path_user}/unknown.jpg`;
                        } else {
                            newComment.querySelector('.comment-user-photo').src = `${path_user}/${comentario.email}/${comentario.foto_usuario}`;
                        }

                        newComment.querySelector('.comment-user-photo').addEventListener('click', () => {
                            window.location.href = `${base_url}profile/${comentario.id_usuario}`;
                        });

                        //Nome usuario
                        if(comentario.usuario.length > 24) {
                            newComment.querySelector('.comment-user').innerText = `${comentario.usuario.substring(0, 24)}...`;
                        } else {
                            newComment.querySelector('.comment-user').innerText = comentario.usuario;
                        }

                        newComment.querySelector('.comment-user').addEventListener('click', () => {
                            window.location.href = `${base_url}profile/${comentario.id_usuario}`;
                        });

                        //Comentário
                        newComment.querySelector('.comment-text').innerText = comentario.texto;

                        // console.log(comentario.id_usuario);
                        if(comentario.id_usuario == usuario.id_usuario || usuario.is_admin) {
                            // Carregar menu
                            let menu = newComment.querySelectorAll('.comment-info')[0].childNodes[3];
                            let menuButton = menu.childNodes[1];
                            let menuList = menu.childNodes[3];
                            loadMenu(menuButton, menuList);

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
                                            let commentSection = newPost.querySelector('.comments');
                                            commentSection.removeChild(newComment);
                                            // refreshMenuPost();
                                            /* alert(response.mensagem); */
                                            // window.location.reload();
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
                        
                        if(isNew) {
                            newPost.querySelector('.comments').prepend(newComment);
                        } else {
                            newPost.querySelector('.comments').appendChild(newComment);
                        }
                        
                    }

                    const maxComments = 2;
                    let indexComments = 0;
                    let moreButton = newPost.querySelector('#more-comments');

                    if(postagem.comentarios.length == 0) {
                        newPost.removeChild(newPost.childNodes[13]);
                    }

                    postagem.comentarios.map((comentario) => {
                        // Caso haja mais que duas postagens
                        if(postagem.comentarios.length > maxComments) {
                            // Carregar apenas duas
                            if(indexComments < maxComments) {
                                loadComentario(comentario);
                                indexComments++;

                            } else {
                                // Restante aparece ao clicar em "Mais comentários"
                                moreButton.addEventListener('click', () => {
                                    loadComentario(comentario);
                                });
                            }

                        } else {
                            // Caso haja menos de duas postagens não mostrar botão
                            loadComentario(comentario);
                            newPost.removeChild(newPost.childNodes[13]);
                        }
                        
                    })

                    // Dps de clicar no botão, ele deve desaparecer
                    moreButton.addEventListener('click', () => {
                        newPost.removeChild(moreButton);
                    });

                    // Criar Comentário
                    newPost.querySelector("#id_postagem").value = postagem.id_postagem;

                    function criarComentario() {
                        let formData = new FormData(newPost.querySelector('.form-comment'));
                        $.ajax({
                            type: "POST",
                            url: base_url+"create-comentario",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                if(response.mensagem){
                                    if(response.id) {
                                        let comentario = loadProps(formData);
                                        comentario['id_comentario'] = response.id;
                                        comentario['id_usuario'] = usuario.id_usuario;
                                        comentario['usuario'] = document.querySelector('.nav-userpic').alt;
                                        comentario['blob'] = document.querySelector('.nav-userpic').src;
                                        newPost.querySelector('.message').value = '';
                                        loadComentario(comentario, true);
                                        // refreshMenuPost();
                                    }
                                    /* alert(response.mensagem); */
                                    // window.location.reload();
                                }
                            },
                            error: function (request, status, error) {
                                console.log(request.responseText);
                            }
                        });
                    }

                    newPost.querySelector('.send-comment').addEventListener('click', () => {
                        criarComentario();
                    })

                    newPost.querySelector('.message').addEventListener('keydown', (event) => {
                        if(event.code == 'Enter' || event.code == 'NumpadEnter') {
                            criarComentario();
                        }
                    })

                    function loadMenu(menuButton, menuList) {
                        menuButton.addEventListener('click', () => {
                            let allMenus = document.querySelectorAll('.list-opts');
                            Object.values(allMenus).map(item => {
                                if (menuList != item && item.classList.contains('display-block')) {
                                    item.classList.remove('display-block');
                                    item.classList.add('display-none');
                                }
                            })

                            if (menuList.classList.contains('display-none')) {
                                menuList.classList.remove('display-none');
                                menuList.classList.add('display-block');

                            } else if(menuList.classList.contains('display-block')) {
                                menuList.classList.remove('display-block');
                                menuList.classList.add('display-none');
                            }
                        });

                    }

                    if(postagem.id_usuario == usuario.id_usuario || usuario.is_admin) {
                        // Menu
                        let menu = newPost.querySelector('.desc-n-menu').childNodes[5];
                        let menuButton = menu.childNodes[1];
                        let menuList = menu.childNodes[3];
                        loadMenu(menuButton, menuList);
                        

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
                                        /* alert(response.mensagem); */
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

                    // function refreshMenuPost() {
                    //     Array.from(newPost.querySelectorAll(".menu-icon")).forEach((el, i) => {
                    //         el.addEventListener("click", e => {
                    //             e.stopPropagation();
                    //             const listOpts = Array.from(newPost.querySelectorAll(".list-opts"));

                    //             for(j in listOpts){
                    //                 if(j != i)
                    //                     if(listOpts[j].classList.contains("display-block")){
                    //                         listOpts[j].classList.remove("display-block");
                    //                         listOpts[j].classList.add("display-none");
                    //                     }
                    //             }
                    
                    //             if(listOpts[i].classList.contains("display-none")){
                    //                 listOpts[i].classList.remove("display-none");
                    //                 listOpts[i].classList.add("display-block");
                    //             }
                    //             else if(listOpts[i].classList.contains("display-block")){
                    //                 listOpts[i].classList.remove("display-block");
                    //                 listOpts[i].classList.add("display-none");
                    //             }
                    //         })
                    //     })
                    // }
                    // refreshMenuPost();
                    
                    document.querySelector('.posts').appendChild(newPost);
                    
                })
            }
        });

        // Botões de Menu sumirem ao clicar em outra área da tela
        document.getElementsByTagName("body")[0].addEventListener("click", (element) => {
            let allowedClasses = ['menu-icon dropdown-post-icon', 'menu-icon dropdown-comment-icon'];
            let check = false;

            // Clicou no botão?
            if( allowedClasses.find(value => value == element.target.className) ) {
                check = true;
            }

            // Clicou no ícone?
            if( element.target.tagName == 'I' ) {
                check = true;
            }

            // Caso não, esconder todos os menus
            if( !check ) {
                Array.from(document.querySelectorAll(".menu-list")).forEach(el => {
                    if(el.classList.contains("display-block")){
                        el.classList.remove("display-block");
                        el.classList.add("display-none");
                    }
                })
            }
        })


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
                    if(response.success){
                        window.location.reload();
                    } else {
                        alertFunc(response.mensagem);
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            })
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
                    if(response.success){
                        window.location.reload();
                    } else {
                        alertFunc(response.mensagem);
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
                        let id = editComentarioModal.querySelector('[name=id_comentario]').value;
                        let texto = editComentarioModal.querySelector('[name=texto]').value;
                        let comentarioElement = document.querySelector(`[class=comment][id='${id}']`);

                        comentarioElement.querySelector('.comment-text').innerText = texto;
                        closeModal(editComentarioModal);
                        /* alert(response.mensagem); */
                        // window.location.reload();
                    }
                },
                error: function (request, status, error) {
                    /* console.log(request.responseText); */
                }
            });
        });

    }
});

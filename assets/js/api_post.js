$(document).ready(function(){
    if(window.location.origin != 'http://localhost'){
        base_url = 'http://lds.codeigniter-dev/';
    }else{
        base_url = `${window.location.origin}/fauna/`;
    }

    function trataString(string) {
        var stringTratada = string[0].toUpperCase()+string.substr(1);
        return stringTratada;
    }

    $.ajax({
        type: "GET",
        url: base_url+"get-post-comment",
        success: function (r) {
            var path_user = base_url+'assets/img/user';
            // var path_pet = base_url+'assets/img/pet';

            // console.log(r);
            var categorias = r.categorias;
            var pets = r.pets;
            var postagens = r.postagens;

            //Criar postagem
            categorias.map(({
                id_categoria,
                descricao
            }) => {
                $('[name="id_categoria"]').append(`<option value='${id_categoria}'>`+trataString(descricao)+`</option>`);
            });

            pets.map(({
                id_animal,
                nome_animal
            }) => {
                $('[name="id_animal"]').append(`<option value='${id_animal}'>`+trataString(nome_animal)+`</option>`);
            });

            //Postagem

            postagens.map((postagem) => {
                // console.log(postagem);
                let newPost = document.querySelector('.post').cloneNode(true);
                newPost.style.display = 'block';

                newPost.id = postagem.id_postagem
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
                
                //Comentário
                postagem.comentarios.map((comentario) => {
                    let newComment = document.querySelector('.comment').cloneNode(true);
                    newComment.style.display = 'flex';
                    
                    newComment.id = comentario.id_comentario
                    //Foto usuário
                    if(comentario.foto_usuario == null) {
                        newComment.querySelector('.comment-user-photo').src = `${path_user}/unknown.jpg`;
                    } else {
                        newComment.querySelector('.comment-user-photo').src = `${path_user}/${comentario.email}/${comentario.foto_usuario}`;
                    }
                    newComment.querySelector('.comment-user-photo').addEventListener('click', () =>{
                        window.location.href = `${base_url}/profile/${comentario.id_usuario}`;
                    });

                    //Nome usuario
                    newComment.querySelector('.comment-user').innerText = comentario.usuario;
                    //Comentário
                    newComment.querySelector('.comment-text').innerText = comentario.texto;
  
                    document.querySelector('.comments').appendChild(newComment);
                })
                newPost.querySelector("#id_postagem").value = postagem.id_postagem;
                
                document.querySelector('.posts').appendChild(newPost);
                
            })
        }
    });


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

    let allPosts = document.querySelectorAll('.post');
    Object.values(allPosts).map(post => {
        // Editar Postagem
        // Excluir Postagem
        post.querySelector('#delete-post').addEventListener('click', () => {
            let id = post.id;
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

        // Criar Comentário
        let formComentario = post.querySelector('.form-comment');
        console.log(formComentario);
        formComentario.querySelector('.send-comment').addEventListener('click', () => {
            formComentario.querySelector('.send-comment').addEventListener('click', () => {
                let formData = new FormData(formComentario);
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
        })

        let allComments = post.querySelectorAll('.comment');
        Object.values(allComments).map(comment => {
            comment.querySelector('#delete-comment').addEventListener('click', () => {
                let id = comment.id;
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
        })
    })
});

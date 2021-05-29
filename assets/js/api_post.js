$(document).ready(function(){
    if(window.location.origin != 'http://localhost'){
        base_url = 'http://lds.codeigniter-dev/';
    }else{
        base_url = `${window.location.origin}/fauna/`;
    }

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

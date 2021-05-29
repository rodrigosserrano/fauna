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

    let formCriarComentario = document.querySelectorAll('.submit-comment');
    for(form of formCriarComentario) {
        form.querySelector('.send-comment').addEventListener('click', () => {
            let formData = new FormData(form);
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
    }
});
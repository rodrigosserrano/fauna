
$(document).ready(function(){
    if(window.location.origin != 'http://localhost'){
        base_url = 'http://lds.codeigniter-dev/';
    }else{
        base_url = 'http://localhost/fauna/';
    }

    //Excluir conta
    $("#btn-excluir-usuario").click(function(){
        $.ajax({
            type: "POST",
            url: base_url+"delete",
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
});
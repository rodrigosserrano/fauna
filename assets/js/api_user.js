
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

        //USUARIO

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
                        alert(response.mensagem);
                        window.location.reload();
                    }
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });
        });
        //PET
        
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
                        alert(response.mensagem);
                        window.location.reload();
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
                            alert(response.mensagem);
                            window.location.reload();
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
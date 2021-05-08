
$(document).ready(function(){
    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

    //USUARIO

    //Excluir conta
    $("#btn-excluir-usuario").click(function(){
        $.ajax({
            type: "POST",
            url: baseUrl+"delete",
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
        var formData = $("#form_alterar").serialize();
        $.ajax({
            type: "POST",
            url: baseUrl+"edit",
            data: formData,
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
        var formData = $("#form-criar-pet").serialize();
        $.ajax({
            type: "POST",
            url: baseUrl+"create-pet",
            data: formData,
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

      //Excluir pet
      $("#btn-excluir-pet-id").click(function(){
        var id = $("#btn-excluir-pet-id").data('id');
        $.ajax({
            type: "POST",
            url: baseUrl+"delete-pet",
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

    //Alterar dados pet
    $("#btn-altera-dados-pet").click(function(){
        var formData = $("#form-alterar-pet").serialize();
        $.ajax({
            type: "POST",
            url: baseUrl+"edit-pet",
            data: formData,
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
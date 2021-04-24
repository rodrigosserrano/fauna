
$(document).ready(function(){
    if(window.location.origin != 'http://localhost'){
        base_url = 'http://lds.codeigniter-dev/';
    }else{
        base_url = 'http://localhost/fauna/';
    }

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
        var formData = $("#form_alterar").serialize();
        $.ajax({
            type: "POST",
            url: base_url+"edit",
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


      //Excluir pet
      $("#btn-excluir-pet").click(function(){
        $.ajax({
            type: "POST",
            url: base_url+"delete-pet",
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
            url: base_url+"edit-pet",
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

     //Cadastrar Pet
     $("#btn-novo-pet").click(function(){
        var formData = $("#form-cria-pet").serialize();
        $.ajax({
            type: "POST",
            url: base_url+"create-pet",
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
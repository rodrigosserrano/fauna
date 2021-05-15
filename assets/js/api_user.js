$(document).ready(function(){
    if(window.location.origin != 'https://localhost'){
        base_url = 'http://lds.codeigniter-dev/';
        //console.log(window.location.origin);
    }else{
        base_url = 'https://localhost/fauna/';
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
    var foto_usuario = null;
    document.querySelector('#foto_usuario').addEventListener('change', (event) => {
        foto_usuario = event.target.files;
    })

    $("#btn-altera-dados-usuario").click(function(){
        var formData = $("#form_alterar").serialize();
        console.log(foto_usuario);
        var nomeF = (foto_usuario[0].name);
        var blob = (foto_usuario[0].blob);

        formData += `&nomeF=${nomeF}`; 
        console.log(formData);
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
    
     //Cadastrar Pet
     
    $("#btn-cria-pet").click(function(){
        var formData = $("#form-criar-pet").serialize();
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

      //Excluir pet
      $("#btn-excluir-pet-id").click(function(){
        var id = $("#btn-excluir-pet-id").data('id');
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
});
import { BaseURL } from 'base_url.js';

$(document).ready(function(){    
    //USUARIO

    //Excluir conta
    $("#btn-excluir-usuario").click(function(){
        $.ajax({
            type: "POST",
            url: BaseURL+"delete",
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
            url: BaseURL+"edit",
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
            url: BaseURL+"create-pet",
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
            url: BaseURL+"delete-pet",
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
            url: BaseURL+"edit-pet",
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
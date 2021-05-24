
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
    //   $("#btn-excluir-pet-id").click(function(){
        
    //   });

    //Alterar dados pet

    let btnsTypeEditPet = document.getElementsByClassName('btn-type');
    
    for(btnsEdit of btnsTypeEditPet) {
        // Excluir Pet
        if(btnsEdit.innerText == 'delete-pet') {
            let btn = btnsEdit.parentNode;
            let id = btn.id;

            btn.addEventListener('click', () => {
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
            })
        }



        // Editar Pet
        if(btnsEdit.innerText == 'edit-pet') {
            let btn = btnsEdit.parentNode;
            let id = btn.id;

            btn.addEventListener('click', () => {
                // let formData = $(`#form-alterar-pet-${id}`).serialize();
                let form = new FormData(document.getElementById(`form-alterar-pet-${id}`));
        
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
            })
        }
    }

    // document.querySelector('#btn-altera-dados-pet').addEventListener('click', (event) => {
    //     console.log(event.target.childNodes[1].innerText);
    //     console.log(event.target);
    // })

    // $("#btn-altera-dados-pet").click(function(){

    //     var formData = $("#form-alterar-pet").serialize();
    //     $.ajax({
    //         type: "POST",
    //         url: base_url+"edit-pet",
    //         data: formData,
    //         success: function (response) {
    //             if(response.mensagem){
    //                 alert(response.mensagem);
    //                 window.location.reload();
    //             }
    //         },
    //         error: function (request, status, error) {
    //             console.log(request.responseText);
    //         }
    //     });
    // });
});
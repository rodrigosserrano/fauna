$(document).ready( 
    function() {
        $("#btn-login").click(
                function() {

                    var formData = $("#form-login").serialize();
                    var base_url = window.location;
                    $.ajax({
                        type: "POST",
                        url: base_url +"validate",
                        data: formData,
                        success: function (response) {
                            if(response.success)
                                alert("Usuario Logado");
                            if(response.error)
                                alert("Usuario Invalido Por Favor Realize seu Cadastro");

                        }
                        
                    });
                }
            );
    } 
);
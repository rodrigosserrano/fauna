<!DOCTYPE html>
<html lang="en">
<head>
    <!--Fiz em HTML pra depois passar pro .php. Fiz isso porque não tinha controller ainda e pra desligar meu servidor porque o PC é uma bostar.
    Mas foi por isso que eu repeti código do header e do style-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fauna, rede social de pets"/>
    <meta name="author" content="André Seike, Gabriel Sá, João Bruzetti, Jonatha Wagner, Nathan Holanda, Rodrigo Serrano"/>
    <meta name="generator" content="VS Code"/>
    <meta name="keywords" content="rede social, pets, animais"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url()?>assets/js/api_validate.js"></script>
    <script src="<?= base_url()?>assets/js/api_user.js"></script>
    <script src="https://kit.fontawesome.com/598f8e27d9.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nothing+You+Could+Do&display=swap" rel="stylesheet"> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <title>Fauna</title>
</head>
<body>
    <main>
        <section class="posts">
            <!--as divs post devem ser geradas de forma dinâmica pelo JS através de conteúdo fornecido pelo backend e recuperado por um AJAX. Utilizei ids para identificar e facilitar inserção em potenciais campos dinâmicos-->
            <div class="post">
                <div class="info-post">
                    <div class="profile-info">
                        <div class="profile-photo"></div>
                        <div class="user-pet-name">
                            <b><span id="user-name">João Araujo</span></b>
                            <span id="pet-name">Muzaretti</span>
                        </div>
                    </div>
                    <div class="date-post"><span id="date-post">19/07/2021</span></div>
                </div>
                
                <div class="desc-n-menu">
                    <div class="desc">Legenda da foto</div>
                    <div class="myDropdown-menu">
                        <span class="myDropdown-icon">myDropdown-icon</span>
                        <div class="myDropdown-list">
                            <ul>
                                <li id="edit-post" style="cursor:pointer;">Editar post</li>
                                <li id="delete-post" style="cursor:pointer;">Apagar post</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="post-photo"></div>
                <div class="post-likes">
                    <div class="like-icon"></div>
                    <b><span id="likes-amount">55 pessoas curtiram isso</span></b>
                </div>
                <div class="comments">
                    <!--Comentários também devem ser gerados com a mesma lógica das postagens-->
                    <div class="comment">
                        <div class="comment-user-photo"></div> <!--Foto inserida com background-image-->
                        <div class="comment-content">
                            <b><span class="comment-user">Nathan Holanda:</span></b>
                            <span class="comment-text">Achei uma bosta</span>
                        </div>
                    </div>
                    <div class="comment">
                        <div class="comment-user-photo"></div> <!--Foto inserida com background-image-->
                        <div class="comment-content">
                            <b><span class="comment-user">Nathan Holanda:</span></b>
                            <span class="comment-text">Achei uma bosta</span>
                        </div>
                    </div>
                    <div class="comment">
                        <div class="comment-user-photo"></div> <!--Foto inserida com background-image-->
                        <div class="comment-content">
                            <b><span class="comment-user">Nathan Holanda:</span></b>
                            <span class="comment-text">Achei uma bosta</span>
                        </div>
                    </div>
                </div>
                <div id="more-comments">
                    <a style="color: #00f; cursor: pointer;">Mais comentários</a>
                </div>
                <div class="write-comments">
                    <form action="" method="post">
                        <textarea id="message">Escreva um comentário</textarea>
                        <!--<button id="send-comment" type="submit">➝</button>-->
                    </form>
                </div>
            </div>
        </section>
        <section class="navigation">
            <div class="nav-container">
                <div id="explore">
                    <span>Explorar</span>
                    <span>➝</span>
                </div>
                <div class="categories">
                    <h4 class="categories-title">Categoria de posts</h4>
                    <div id="adoption">
                        <span>Adoção</span>
                        <span>➝</span>
                    </div>
                    <div id="lost-animals">
                        <span>Animais perdidos</span>
                        <span>➝</span> 
                    </div>
                    <div></div>
                </div>
            </div>
            <div class="copyright">
                <span class="lang">Português (Brasil)</span>
                <span class="copyright-desc">© FAUNA<?php echo date("Y");?></span>
            </div>
        </section>
    </main>
</body>


<style>
    :root {
    --background-color: #D7EDC5;
    --container-color: #FFF;
    --link-color: #0870AB;
    --link-hover-color: #01446b;
    --darker-color: #413E42;
    --darker-hover-color: #727171;
    --font-color: #3A3A3A;
    --input-color: #F3F3F3;
}

</style>

<script>
    document.getElementById("message").addEventListener("focus", e => {
        if(e.target.value === "Escreva um comentário")
            e.target.value = ""; 
    })
    document.getElementById("message").addEventListener("blur", e => {
        if(e.target.value === "")
            e.target.value = "Escreva um comentário";
    })
</script>
</html>
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
    <nav id="navbar">
        <a href="<?= base_url() ?>" id="nav-logo" style="color: #fff">Fauna</a>

        <!-- se o usuário estiver logado aparecer também -->
        <div id="nav-user">
            <div class="nav-userpic-area">
                <!-- <img class="nav-userpic" src="<?= base_url() ?>assets/img/user/foto.png" title="Nome" alt="Nome"> -->
            </div>

            <a href="<?= base_url()?>usuario-dados" class="link"><img id="btn-config" src="../../assets/img/icon/config.png" alt="Configurações" title="Configurações"></a>
            <!-- da pra rodar um scriptzinho com btn-config pra redirecionar ou colocar dentro de um 'a' -->
            <div class="vertical-bar"></div>
            <a href="" id="btn-logout" class="logout">Sair ➝</a>
        </div>
        <!-- -->
    </nav>
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
                    <div class="dropdown-menu">
                        <span class="dropdown-icon">dropdown-icon</span>
                        <div class="dropdown-list">
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

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    outline: 0;
}

#navbar {
    background-color: var(--darker-color);
    width: 100%; 
    height: 50px;
    display: flex;
    justify-content: space-between;
    position: fixed;
}

#navbar #nav-logo{
    font-family: 'Indie Flower', cursive;
    font-size: 36px;
    margin-left: 2%;
    text-decoration: none;
    color: black;
}

#navbar #nav-user {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 5px;
}

#navbar #nav-user .nav-userpic-area {
    width: 30px;
    height: 30px;
    border-radius: 20px;
    overflow: hidden;
    background-color: white;
    cursor: pointer;
    margin-right: 10px;
}

#navbar #nav-user .nav-userpic-area .nav-userpic {
    max-width: 30px;
    max-height: 30px;
}

.nav-userpic-area, #btn-config, .vertical-bar, .logout {
    margin: 0 5px;
}

#navbar #nav-user #btn-config {
    transition: 0.2s;
    cursor: pointer;
    vertical-align:-20%;
}

#navbar #nav-user #btn-config:hover {
    filter: opacity(50%);
}

.vertical-bar {
    height: 30px;
    width: 1px;
    background-color: var(--darker-color);
}

#navbar #nav-user .logout {
    text-decoration: none;
    color: black;
    transition: 0.2s;
}

#navbar #nav-user .logout:hover {
    color: var(--darker-color);
}

/*CSS da página começa aqui*/
ul{
    list-style-type: none;
}

.dropdown-menu{
    position: relative;
}

.dropdown-list{
    display: none;
    position: absolute;
    background-color: #fff;
    padding: 10px;
    width: 110px;
}

.dropdown-list li{
    margin-bottom: 5px;
}

.dropdown-menu:hover .dropdown-list{
    display: block;
}

body{
    background-color: var(--background-color);
    font-family: Roboto, sans-serif;
}

main{
    padding: 5% 10% 10% 30%;
    display: flex;
    justify-content: space-between;
}

section{
    background-color: #fff;
    padding: 10px;
}

.info-post{
    display:flex;
    justify-content:space-between;
}

.profile-info{
    display: flex;
}

.profile-photo{
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background-color: #ccc;
    margin-right: 5px;
}

.user-pet-name{
    display: flex;
    flex-direction: column;
}

.desc-n-menu{
    padding: 15px 3px;
    display: flex;
    justify-content:space-between;
}

.post-photo{
    width: 500px;
    height: 300px;
    background-color: #ccc;
    margin-bottom: 10px;
}

.comments{
    margin-top: 10px;
    margin-bottom: 10px;
}

.comment{
    display: flex;
    align-items: center;
    margin-bottom: 4px;
}

.comment-user-photo{
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background-color: #ccc;
    margin-right: 3px;
}

.write-comments{
    margin-top: 10px;
}

write-comments form{
    position: relative;
    display: flex;
    align-items: center;
}

#message{
    resize: none;
    height: 40px;
    outline: none;
    padding: 3px;
    width: 100%;
}

/*#send-comment{
    position: absolute;
    left: -20px;
}
*/
.navigation{
    height: 160px;
    width: 250px;
}

#explore{
    display: flex;
    justify-content: space-between;
    padding: 3px;
    color: #fff;
    background-color: var(--darker-color);
    border-radius: 3px;
    cursor: pointer;
    margin-bottom: 20px;
}

.categories-title{
    margin-bottom: 3px;
}

#adoption, #lost-animals{
    display: flex;
    justify-content: space-between;
    padding: 5px;
    color: #fff;
    background-color: var(--darker-color);
    border-radius: 3px;
    cursor: pointer;
}

#adoption{
    margin-bottom: 3px;
}

.copyright{
    margin-top: 25px;
    display: flex;
    flex-direction: column;
}

.copyright span:first-child{
    margin-bottom: 3px;
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
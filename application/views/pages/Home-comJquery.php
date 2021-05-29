<body>
    <!-- MENU MOBILE -->

    <button type="button" class="icon" id="navigation-menu-mobile">
        <!-- <i class="fa fa-bars"></i> -->
        <p class="mobile-bars">—</p>
        <p class="mobile-bars">—</p>
        <p class="mobile-bars">—</p>
    </button>
    <!-- Top Navigation Menu -->
    <div class="topnav">
        <!-- Navigation links (hidden by default) -->
        <div id="navigation-links-mobile">
            <a class="menu-mobile-item" href="#news">Explorar</a>
            <a class="menu-mobile-item" href="#contact">Adoção</a>
            <a class="menu-mobile-item" href="#about">Animais Perdidos</a>
        </div>
    </div>

    <!--  -->

    
    <main>

        <!-- MODAL CRIAR POSTAGEM -->
        
        <div class="modal fade" id="new-post-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="new-post-area" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Nova Postagem</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                        <form id="form-criar-post">
                            <div>
                                <!-- colocar um overflow auto para aparecer a barra de rolagem -->
                                <textarea name="descricao" placeholder="Escreva uma mensagem..." rows="4" cols="40"></textarea>
                                <br>
                                <!-- br pode ser removido dps -->
                                <input type="file" name="midia">
                                <label for="midia">Inserir mídia</label>
                            </div>

                            <br><br>

                            <select name="id_categoria">
                                <option selected disabled>Categoria</option>
                                    <!-- <option value="< ?= $categoria->id_categoria ?>">< ?= $categoria->descricao ?></option> -->
                                <!-- Loop de categorias -->
                            </select>

                            <br><br>

                            <select name="id_animal">
                                <option selected disabled>Pet relacionado</option>
                                    <!-- <option value="< ?= $pet->id_animal ?>">< ?= $pet->nome_animal ?></option> -->
                                <!-- Loop de pets -->
                            </select>

                            <br><br>
                            
                            <button type="button" id="btn-cria-postagem">Criar Postagem</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <button id="btn-new-post" data-bs-toggle="modal" data-bs-target="#new-post-modal"></button>

        <!--  -->




    <!-- MODAL EDITAR POSTAGEM -->
        
    <div class="modal fade" id="edit-post-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="new-post-area" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Editar Postagem</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                        <form id="form-criar-post">
                            <div>
                                <!-- colocar um overflow auto para aparecer a barra de rolagem -->
                                <textarea name="descricao" rows="4" cols="40"></textarea>
                                <br>
                                <!-- br pode ser removido dps -->
                                <input type="file" name="midia">
                                <label for="midia">Escolher mídia</label>
                            </div>

                            <br><br>

                            <select name="id_categoria">
                                <option selected disabled>Categoria</option>
                                <!-- Loop de categorias -->
                            </select>

                            <br><br>

                            <select name="id_animal">
                                <option selected disabled>Pet relacionado</option>
                                <!-- Loop de pets -->
                            </select>

                            <br><br>
                            
                            <button type="button" id="btn-altera-postagem">Editar Postagem</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!--  -->


        <section class="posts">
                <div class="post">
                    <div class="info-post">
                        <div class="profile-info">

                            <img src="" class="profile-photo">

                            <div class="user-pet-name">
                                <!-- <b><span id="user-name">< ?php echo $postagem->usuario;?></span></b> -->
                                <!-- <b><span id="user-name">< ?php echo $postagem->usuario;?></span></b> -->
                                <b><span id="user-name"></span></b>
                                <span id="pet-name"></span>
                            </div>
                        </div>
                        <!-- <div class="date-post"><span id="date-post">< ?php echo date("d/m/Y", strtotime($postagem->dh_post));?></span></div> -->
                        <div class="date-post"><span id="date-post"></span></div>
                    </div>
                    <div class="desc-n-menu">
                        <!-- <div class="desc">< ?php echo $postagem->descricao;?></div> -->
                        <div id="desc-post" class="desc"></div>
                        <div class="dropdown-post-menu">
                            <span class="menu-icon dropdown-post-icon"><i class="fas fa-ellipsis-h fa-xs"></i></i></span>
                            <div class="list-opts display-none dropdown-post-list menu-list">
                                <ul>
                                    <li id="edit-post" data-bs-toggle="modal" data-bs-target="#edit-post-modal" style="cursor:pointer;">Editar publicação</li>
                                    <li id="delete-post" style="cursor:pointer;">Apagar publicação</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                        
                    <div class="post-photo">
                        <!-- < ?php //if($postagem->midia) : ?> -->
                            <!-- <img src="< ?= base_url()?>assets/img/post/< ?= $postagem->midia_url ?>"> -->
                        <!-- < ?php else : ?> -->
                            <img id="post-photo" src="">
                        <!-- < ?php endif; ?> -->
                    </div>
                                        
                    <div class="post-likes">
                        <a id="like-icon">
                            <img src="<?= base_url()?>assets/img/icon/paw-like-unset.png">
                        </a>
                        <b><span id="likes-amount">55 pessoas curtiram isso</span></b>
                    </div>
                    <div class="line"></div>
                    <div class="comments">
                        <!-- < ?php foreach ($postagem->comentarios as $comentario):?> -->
                        <div class="comment">
                            <div class="comment-content">
                                <div class="comment-info">
                                    <div class="comment-info">


                                        <!-- < ?php if(empty($comentario->foto_usuario)) : ?> -->
                                            <!-- <img src="" class="profile-photo"> -->
                                            <img src="" class="comment-user-photo">
                                        <!-- < ?php else : ?> -->
                                            <!-- <img src="< ?= base_url()?>assets/img/user/< ?php echo $comentario->email.'/'.$comentario->foto_usuario; ?>" class="comment-user-photo"> -->
                                        <!-- < ?php endif; ?> -->


                                        <!-- <b><span class="comment-user">< ?php echo $comentario->usuario; ?>:</span></b> -->
                                        <b><span class="comment-user"></span></b>
                                    </div>
                                    <div class="dropdown-comment-menu">
                                        <span class="menu-icon dropdown-comment-icon"><i class="fas fa-ellipsis-h fa-xs"></i></i></span>
                                        <div class="list-opts dropdown-comment-list menu-list display-none">
                                            <ul>
                                                <li id="edit-comment" style="cursor:pointer;">Editar comentário</li>
                                                <li id="delete-comment" style="cursor:pointer;">Apagar comentário</li>
                                            </ul>
                                        </div>
                                    </div> 
                                </div>
                                <!-- <p class="comment-text">< ?php echo $comentario->texto; ?></p> -->
                                <p class="comment-text"></p>
                            </div>
                        </div>
                        <!-- < ?php endforeach; ?> -->
                    </div>
                    
                    <div id="more-comments">
                        <a style="color: #0870AB; cursor: pointer;">Mais comentários...</a>
                    </div>

                <div class="write-comments">
                    <form class="submit-comment" action="" method="post">
                        <!-- <input type="hidden" name="id_postagem" value=< ?=$postagem->id_postagem ?>> -->
                        <input type="hidden" name="id_postagem" id="id_postagem" value="">
                        <textarea class="message" name="texto" type="button" placeholder="Escreva um comentário"></textarea>
                        <button class="send-comment" type="button">➝</button>
                    </form>
                </div>
            </div>         
        </section>
        
        
        <section class="navigation">
            <div class="nav-container">
                <div id="explore" class="nav-btns">
                    <span>Explorar</span>
                    <span>➝</span>
                </div>
                <div class="categories">
                    <h4 class="categories-title">Categoria de posts</h4>
                    <div id="adoption" class="nav-btns">
                        <span>Adoção</span>
                        <span>➝</span>
                    </div>
                    <div id="lost-animals" class="nav-btns">
                        <span>Animais perdidos</span>
                        <span>➝</span> 
                    </div>
                    <div></div>
                </div>
            </div>
            <div class="copyright">
                <span class="lang">Português (Brasil)</span>
                <span class="copyright-desc">© FAUNA&nbsp<?php echo date("Y");?></span>
            </div>
        </section>
    </main>
</body>
<script>
window.onload = function(){
    // document.getElementById("message").addEventListener("focus", e => {
    //     if(e.target.value === "Escreva um comentário")
    //         e.target.value = ""; 
    // })
    // document.getElementById("message").addEventListener("blur", e => {
    //     if(e.target.value === "")
    //         e.target.value = "Escreva um comentário";
    // })

    document.querySelector("#like-icon").addEventListener("click", e => {
        if(e.target.getAttribute("src") === "<?= base_url()?>assets/img/icon/paw-like-unset.png"){
            e.target.setAttribute("src", "<?= base_url()?>assets/img/icon/paw-like-set.png");
        }
        else
            e.target.setAttribute("src", "<?= base_url()?>assets/img/icon/paw-like-unset.png");
    })

    Array.from(document.querySelectorAll(".menu-icon")).forEach((el, i) => {
        el.addEventListener("click", e => {
            e.stopPropagation();
            const listOpts = Array.from(document.querySelectorAll(".list-opts"));
            for(j in listOpts){
                if(j != i)
                    if(listOpts[j].classList.contains("display-block")){
                        listOpts[j].classList.remove("display-block");
                        listOpts[j].classList.add("display-none");
                    }
            }

            if(listOpts[i].classList.contains("display-none")){
                listOpts[i].classList.remove("display-none");
                listOpts[i].classList.add("display-block");
            }
            else if(listOpts[i].classList.contains("display-block")){
                listOpts[i].classList.remove("display-block");
                listOpts[i].classList.add("display-none");
            }
        })
    })

    document.getElementsByTagName("body")[0].addEventListener("click", () => {
        Array.from(document.querySelectorAll(".menu-list")).forEach(el => {
            if(el.classList.contains("display-block")){
                el.classList.remove("display-block");
                el.classList.add("display-none");
            }
        })
    })

    // Menu Mobile
    const mobileMenuButton = document.getElementById("navigation-menu-mobile");
    const mobileMenu = document.getElementById("navigation-links-mobile");


    mobileMenuButton.addEventListener('click', () => {
        let menuBars = document.querySelectorAll('.mobile-bars');
        

        if (mobileMenu.style.display === "flex") {
            mobileMenu.style.display = "none";

            menuBars[0].style.marginBottom = "0";
            menuBars[0].style.transform = 'rotate(0deg)';
            menuBars[1].style.transform = 'rotate(0deg)';
            menuBars[2].style.display = "flex";


        } else {
            mobileMenu.style.display = "flex";
            
            menuBars[0].style.marginBottom = "-10px";
            menuBars[0].style.transform = 'rotate(45deg)';
            menuBars[1].style.transform = 'rotate(-45deg)';
            menuBars[2].style.display = "none";
        }
    })
}

</script>
</html>
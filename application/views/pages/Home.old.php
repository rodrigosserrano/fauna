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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <h5 class="modal-title" id="staticBackdropLabel">Nova Postagem</h5>
                    </div>


                    <div class="modal-body">
                        <form id="form-criar-post">
                            <div class="post-content">
                                <!-- colocar um overflow auto para aparecer a barra de rolagem -->
                                <div class="content-main">
                                    <textarea name="descricao" placeholder="Escreva uma mensagem..." rows="4" cols="40"></textarea>
                                    <div class="preview" id="new-img"><img></div>
                                </div>
                                <div class="line"></div>
                                <!-- br pode ser removido dps -->
                                <input type="file" name="midia" id="new-post" hidden>
                                <div class="content-footer">
                                    <label class="file-label mt-1" for="new-post">
                                        <i class="fas fa-paperclip"></i>
                                        <span>Inserir mídia</span>
                                    </label>
                                    <select class="modal-select" name="id_categoria">
                                        <option selected disabled>Categoria</option>
                                        <?php foreach($categorias as $categoria) : ?>
                                            <option value="<?= $categoria->id_categoria ?>"><?= $categoria->descricao ?></option>
                                        <?php endforeach; ?>
                                        <!-- Loop de categorias -->
                                    </select>
                                    <select class="modal-select" name="id_animal">
                                        <option selected disabled>Pet relacionado</option>
                                        <?php foreach($pets as $pet) : ?>
                                            <option value="<?= $pet->id_animal ?>"><?= $pet->nome_animal ?></option>
                                        <?php endforeach; ?>
                                        <!-- Loop de pets -->
                                    </select>
                                </div>
                            </div>
                            <div class="btn-container"><button type="button" id="btn-cria-postagem">Criar postagem</button></div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <button id="btn-new-post" data-bs-toggle="modal" data-bs-target="#new-post-modal"><i class="fa-2x fas fa-plus text-white"></i></button>

        <!--  -->




    <!-- MODAL EDITAR POSTAGEM -->
        
    <div class="modal fade" id="edit-post-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="new-post-area" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <h5 class="modal-title" id="staticBackdropLabel">Editar postagem</h5>
                    </div>


                    <div class="modal-body">
                        <form id="form-criar-post">
                            <div class="post-content">
                                <!-- colocar um overflow auto para aparecer a barra de rolagem -->
                                <div class="content-main">
                                    <textarea placeholder="Teste............" name="descricao" rows="4" cols="40"></textarea>
                                    <div class="preview" id="edit-img"><img></div>
                                </div>
                                <div class="line"></div>
                                <!-- br pode ser removido dps -->
                                <input type="file" name="midia" id="edit-post" hidden>
                                <div class="content-footer">
                                    <label class="file-label mt-1" for="edit-post">
                                        <i class="fas fa-paperclip"></i>
                                        <span>Inserir mídia</span>
                                    </label>
                                    <select class="modal-select" name="id_categoria">
                                        <option selected disabled>Categoria</option>
                                        <?php foreach($categorias as $categoria) : ?>
                                            <option value="<?= $categoria->id_categoria ?>"><?= $categoria->descricao ?></option>
                                        <?php endforeach; ?>
                                        <!-- Loop de categorias -->
                                    </select>
                                    <select class="modal-select" name="id_animal">
                                        <option selected disabled>Pet relacionado</option>
                                        <?php foreach($pets as $pet) : ?>
                                            <option value="<?= $pet->id_animal ?>"><?= $pet->nome_animal ?></option>
                                        <?php endforeach; ?>
                                        <!-- Loop de pets -->
                                    </select>
                                </div>
                            </div>
                            <div class="btn-container"><button type="button" id="btn-altera-postagem">Editar Postagem</button></div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!--  -->

        <section class="posts">
            <?php foreach ($postagens as $postagem):?>
                <div class="post" id="<?=$postagem->id_postagem?>">
                    <div class="info-post">
                        <div class="profile-info">


                            <?php if(empty($postagem->foto_usuario)) : ?>
                                <img src="<?= base_url()?>assets/img/user/unknown.jpg" class="profile-photo">
                            <?php else : ?>
                                <img src="<?= base_url()?>assets/img/user/<?php echo $postagem->email.'/'.$postagem->foto_usuario; ?>" class="profile-photo">
                            <?php endif; ?>


                            <div class="user-pet-name">
                                <b><span id="user-name"><?php echo $postagem->usuario;?></span></b>
                                <span id="pet-name"><?php echo $postagem->animal;?></span>
                            </div>
                        </div>
                        <div class="date-post"><span id="date-post"><?php echo date("d/m/Y", strtotime($postagem->dh_post));?></span></div>
                    </div>
                    <div class="desc-n-menu">
                        <div class="desc"><?php echo $postagem->descricao;?></div>
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
                        <?php if($postagem->midia) : ?>
                            <img src="<?= base_url()?>assets/img/post/<?= $postagem->midia_url ?>">
                        <?php else : ?>
                            <img src="<?= base_url()?>assets/teste/pitbull.png">
                        <?php endif; ?>
                    </div>
                                        
                    <div class="post-likes">
                        <a id="like-icon">
                            <img src="<?= base_url()?>assets/img/icon/paw-like-unset.png">
                        </a>
                        <b><span id="likes-amount">55 pessoas curtiram isso</span></b>
                    </div>
                    <div class="line"></div>
                    <div class="comments">
                        <?php foreach ($postagem->comentarios as $comentario):?>
                        <div class="comment" id="<?= $comentario->id_comentario?>">
                            <div class="comment-content">
                                <div class="comment-info">
                                    <div class="comment-info">


                                        <?php if(empty($comentario->foto_usuario)) : ?>
                                            <img src="<?= base_url()?>assets/img/user/unknown.jpg" class="profile-photo">
                                        <?php else : ?>
                                            <img src="<?= base_url()?>assets/img/user/<?php echo $comentario->email.'/'.$comentario->foto_usuario; ?>" class="comment-user-photo">
                                        <?php endif; ?>


                                        <b><span class="comment-user"><?php echo $comentario->usuario; ?>:</span></b>
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
                                <p class="comment-text"><?php echo $comentario->texto; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div id="more-comments">
                        <a style="color: #0870AB; cursor: pointer;">Mais comentários...</a>
                    </div>

                <div class="write-comments">
                    <form class="form-comment">
                        <input type="hidden" name="id_postagem" value=<?=$postagem->id_postagem ?>>
                        <textarea class="message" name="texto" placeholder="Escreva um comentário"></textarea>
                        <!-- <input type="text" value="" class="message" name="texto" placeholder="Escreva um comentário"> -->
                        <button class="send-comment" type="button">➝</button>
                    </form>
                </div>
            <?php endforeach;?>              
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

    //Modals de postagens
    const editImg = document.querySelector("#edit-img > img")
    const editPost = document.getElementById("edit-post")
    const newImg = document.querySelector("#new-img > img")
    const newPost = document.getElementById("new-post")

    const openFile = function(e, output){
        const input = e.target;
         
        const reader = new FileReader();
        reader.onload = function(){
            const dataURL = reader.result;
            output.style.display = "block";
            output.src = dataURL;
        };
        reader.readAsDataURL(input.files[0]);
    };

    editPost.addEventListener("input", e => openFile(e, editImg))
    newPost.addEventListener("input", e => openFile(e, newImg))
}

</script>
</html>
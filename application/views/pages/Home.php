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
                                <!-- Loop de categorias -->
                            </select>

                            <br><br>

                            <select name="id_animal">
                                <option selected disabled>Pet relacionado</option>
                                <!-- Loop de pets -->
                            </select>

                            <br><br>
                            
                            <button type="button" id="#btn-cria-postagem">Criar Postagem</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <button id="btn-new-post" data-bs-toggle="modal" data-bs-target="#new-post-modal"></button>

        <!--  -->


        <section class="posts">
            <div class="post">
                <div class="info-post">
                    <div class="profile-info">
                        <img src="<?= base_url()?>assets/teste/d_pedro_ii.png" class="profile-photo">
                        <div class="user-pet-name">
                            <b><span id="user-name">Dom Pedro II</span></b>
                            <span id="pet-name">Beethoven</span>
                        </div>
                    </div>
                    <div class="date-post"><span id="date-post">19/07/2021</span></div>
                </div>
                
                <div class="desc-n-menu">
                    <div class="desc">Esse é o meninão do papai feliz da vida :)</div>
                    <div class="dropdown-post-menu">
                        <span class="menu-icon dropdown-post-icon"><i class="fas fa-ellipsis-h fa-xs"></i></i></span>
                        <div class="list-opts display-none dropdown-post-list menu-list">
                            <ul>
                                <li id="edit-post" style="cursor:pointer;">Editar publicação</li>
                                <li id="delete-post" style="cursor:pointer;">Apagar publicação</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="post-photo"><img src="<?= base_url()?>assets/teste/pitbull.png"></div>
                <div class="post-likes">
                    <a id="like-icon">
                        <img src="<?= base_url()?>assets/img/icon/paw-like-unset.png">
                    </a>
                    <b><span id="likes-amount">55 pessoas curtiram isso</span></b>
                </div>
                <div class="line"></div>
                <div class="comments">
                    <div class="comment">
                        <div class="comment-content">
                            <div class="comment-info">
                                <div class="comment-info">
                                    <img src="<?= base_url()?>assets/teste/deodoro_da_fonseca.png" class="comment-user-photo">
                                    <b><span class="comment-user">Deodoro da Fonseca:</span></b>
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
                            <p class="comment-text">Fica esperto, fi! Vou derrubar a monarquia e pegar seu cachorro pra mim, seu vacilão!</p>
                        </div>
                    </div>
                    <div class="comment">
                        <div class="comment-content">
                            <div class="comment-info">
                                <div class="comment-info">
                                <img src="<?= base_url()?>assets/teste/napoleao.png" class="comment-user-photo"> 
                                    <b><span class="comment-user">Napoleão Bonaparte:</span></b>
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
                            <p class="comment-text">De quelle couleur est mon cheval blanc?</p>
                        </div>
                    </div>
                    <div class="comment">
                        <div class="comment-content">
                            <div class="comment-info">
                                <div class="comment-info">
                                <img src="<?= base_url()?>assets/teste/machado_de_assis.png" class="comment-user-photo"> 
                                    <b><span class="comment-user">Machado de Assis:</span></b>
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
                            <p class="comment-text">Vocês nunca saberão se Capitu traiu Bentinho... Muahahahahahaha!</p>
                        </div>
                    </div>
                </div>
                <div id="more-comments">
                    <a style="color: #0870AB; cursor: pointer;">Mais comentários...</a>
                </div>
                <div class="write-comments">
                    <form action="" method="post">
                        <textarea id="message">Escreva um comentário</textarea>
                        <button id="send-comment">➝</button>
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
    document.getElementById("message").addEventListener("focus", e => {
        if(e.target.value === "Escreva um comentário")
            e.target.value = ""; 
    })
    document.getElementById("message").addEventListener("blur", e => {
        if(e.target.value === "")
            e.target.value = "Escreva um comentário";
    })

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
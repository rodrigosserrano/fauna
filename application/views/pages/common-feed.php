<!DOCTYPE html>
<body>
    <main>
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
                    <!--Comentários também devem ser gerados com a mesma lógica das postagens-->
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
</script>
</html>
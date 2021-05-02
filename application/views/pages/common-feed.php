<!DOCTYPE html>
<body>
    <main>
        <section class="posts">
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
                    <div class="dropdown-post-menu">
                        <span class="dropdown-post-icon"><i class="fas fa-ellipsis-v fa-xs"></i></span>
                        <div class="dropdown-post-list">
                            <ul>
                                <li id="edit-post" style="cursor:pointer;">Editar postagem</li>
                                <li id="delete-post" style="cursor:pointer;">Apagar postagem</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="post-photo"></div>
                <div class="post-likes">
                    <div id="like-icon" style="background-image: url('<?= base_url()?>assets/img/icon/paw-like-unset.png')"></div>
                    <b><span id="likes-amount">55 pessoas curtiram isso</span></b>
                </div>
                <div class="comments">
                    <!--Comentários também devem ser gerados com a mesma lógica das postagens-->
                    <div class="comment">
                        <div class="comment-user-photo"></div> <!--Foto inserida com background-image-->
                        <div class="comment-content">
                            <div>
                                <b><span class="comment-user">Nathan Holanda:</span></b>
                                <span class="comment-text">Achei uma bosta</span>
                            </div>
                            <div class="dropdown-comment-menu">
                                <span class="dropdown-comment-icon"><i class="fas fa-ellipsis-h fa-xs"></i></i></span>
                                <div class="dropdown-comment-list">
                                    <ul>
                                        <li id="edit-comment" style="cursor:pointer;">Editar comentário</li>
                                        <li id="delete-comment" style="cursor:pointer;">Apagar comentário</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment">
                        <div class="comment-user-photo"></div> <!--Foto inserida com background-image-->
                        <div class="comment-content">
                            <div>
                                <b><span class="comment-user">Nathan Holanda:</span></b>
                                <span class="comment-text">Achei uma bosta</span>
                            </div>
                            <div class="dropdown-comment-menu">
                                <span class="dropdown-comment-icon"><i class="fas fa-ellipsis-h fa-xs"></i></i></span>
                                <div class="dropdown-comment-list">
                                    <ul>
                                        <li id="edit-comment" style="cursor:pointer;">Editar comentário</li>
                                        <li id="delete-comment" style="cursor:pointer;">Apagar comentário</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment">
                        <div class="comment-user-photo"></div> <!--Foto inserida com background-image-->
                        <div class="comment-content">
                            <div>
                                <b><span class="comment-user">Nathan Holanda:</span></b>
                                <span class="comment-text">Achei uma bosta</span>
                            </div>
                            <div class="dropdown-comment-menu">
                                <span class="dropdown-comment-icon"><i class="fas fa-ellipsis-h fa-xs"></i></i></span>
                                <div class="dropdown-comment-list">
                                    <ul>
                                        <li id="edit-comment" style="cursor:pointer;">Editar comentário</li>
                                        <li id="delete-comment" style="cursor:pointer;">Apagar comentário</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="more-comments">
                    <a style="color: #00f; cursor: pointer;">Mais comentários</a>
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

    document.getElementById("like-icon").addEventListener("click", e => {
        console.log(e.target.style.backgroundImage)
        if(e.target.style.backgroundImage === "url('<?= base_url()?>assets/img/icon/paw-like-unset.png')")
            e.target.style.backgroundImage = "url('<?= base_url()?>assets/img/icon/paw-like-set.png')"
        else
            e.target.style.backgroundImage = "url('<?= base_url()?>assets/img/icon/paw-like-unset.png')"
    })
</script>
</html>
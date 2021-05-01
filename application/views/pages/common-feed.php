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
                    <div class="myDropdown-menu">
                        <span class="myDropdown-icon"><i class="fas fa-ellipsis-v"></i></span>
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
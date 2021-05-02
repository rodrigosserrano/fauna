<body>

    <main>
        <section class="profile-section" id="user-profile">
            <div id="user-profile-title">
                Perfil
                <div id="btns-area">
                    <button class="btn-follow" id="btn-seguir" type="button">Seguir</button>
                    <button id="btn-option-user" class="btn-option" type="button">•••</button>
                </div>
            </div>

            <div class="bar"></div>

            <div id="user-profile-info">
                <div class="user-profile-info-half">
                    <div class="user-profile-pic">
                        <img src="https://avatars.githubusercontent.com/u/51789589?v=4" alt="NOME" title="NOME">
                    </div>

                    <p class="user-profile-name">NOME</p>
                </div>

                <div class="user-profile-info-half">
                    <div id="info-item-area">
                        <div class="info-item">
                            <img class="info-item-icon" src="<?= base_url() ?>assets/img/icon/calendar.png" alt="Calendário" title="Data de Nascimento">
                            <p class="info-item-description">
                                Nasceu em
                                01/05/2021
                            </p>
                        </div>
                        
                        <div class="info-item">
                            <img class="info-item-icon" src="<?= base_url() ?>assets/img/icon/mobile-phone.png" alt="Celular" title="Número de Celular">
                            <p class="info-item-description">
                                +055 (11) 9xxxx-xxxx
                            </p>
                        </div>

                        <div class="info-item">
                            <img class="info-item-icon" src="<?= base_url() ?>assets/img/icon/gender.png" alt="Gênero" title="Gênero Sexual">
                            <p class="info-item-description">
                                Masculino
                            </p>
                        </div>
                    </div>
                </div>

                <button id="btn-ativar-visibilidade" class="btn-visibility" type="button">
                    <img id="visibility-icon" src="<?= base_url() ?>assets/img/icon/visibility-close.png" alt="Oculto" title="Oculto">
                    <p id="visibility-description">Informações ocultadas</p>
                </button>
            </div>

            <div class="bar"></div>

            <div id="user-profile-pet-area">

                    <div class="unit">
                        <div class="card">
                            <div class="unit-pic-area">
                                <img class="unit-pic" src="<?= base_url() ?>assets/img/cachorro_login.png" alt="NOME" title="NOME">
                            </div>
                            <p class="unit-name">Nome</p>
                        </div>
                    </div>

            </div>

            <div id="user-menu">
                <section class="nav" id="profile-menu" role="tablist">  
                    <button class="profile-option-selected" id="profile-posts" data-bs-toggle="tab" data-bs-target="#menu-post" type="button" role="tab" aria-controls="menu-post" aria-selected="true">Postagens</button>
                    <button class="profile-option" id="profile-following" data-bs-toggle="tab" data-bs-target="#menu-following" type="button" role="tab" aria-controls="menu-following" aria-selected="false">Seguindo</button>
                    <button class="profile-option" id="profile-followers" data-bs-toggle="tab" data-bs-target="#menu-follower" type="button" role="tab" aria-controls="menu-follower" aria-selected="false">Seguidores</button>
                </section>

                <section id="profile-user-info" class="tab-content">




                    <!-- Aba Postagem -->
                    <div class="tab-pane fade show active" id="menu-post" role="tabpanel" aria-labelledby="menu-post-tab">

                        <!-- Loop de Post -->
                        <div class="post-card">
                            <div class="post-pic">
                                <img src="https://avatars.githubusercontent.com/u/51789589?v=4" alt="Postagem">
                            </div>

                            <div class="post-info">
                                <p class="post-description">
                                    Descrição feita por João
                                </p>

                                <p class="post-date">
                                    10/04/2021
                                </p>
                            </div>

                            <div class="post-option">
                                <button class="btn-option" type="button">•••</button>

                                <div class="like-area">
                                    <button id="btn-like" class="like-icon">
                                        <img src="<?= base_url() ?>assets/img/icon/paw-like-unset.png" alt="Curtida" title="Curtida">
                                    </button>

                                    <p class="like-amount">
                                        55
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--  -->

                        <button class="more" id="btn-exibir-mais" type="button">
                            Mais postagens
                        </button>

                    </div>




                    <!-- Aba Seguindo -->
                    <div class="tab-pane fade" id="menu-following" role="tabpanel" aria-labelledby="menu-following-tab">

                        <div class="follow-area">
                            <!-- Loop de Pessoas Seguindo -->
                            <div class="unit">
                                <div class="card">
                                    <div class="unit-pic-area">
                                        <img class="unit-pic" src="<?= base_url() ?>assets/img/cachorro_login.png" alt="NOME" title="NOME">
                                    </div>
                                    <p class="unit-name">Nome</p>
                                </div>
                            </div>
                            <!--  -->
                        </div>

                    </div>

                    <!-- Aba Seguidores -->
                    <div class="tab-pane fade" id="menu-follower" role="tabpanel" aria-labelledby="menu-follower-tab">
                        
                        <div class="follow-area">
                            <!-- Loop de Seguidores -->
                            <div class="unit">
                                <div class="card">
                                    <div class="unit-pic-area">
                                        <img class="unit-pic" src="<?= base_url() ?>assets/img/cachorro_login.png" alt="NOME" title="NOME">
                                    </div>
                                    <p class="unit-name">Nome</p>
                                </div>
                            </div>
                            <!--  -->
                        </div>

                    </div>
                </section>
            </div>
        </section>
    </main>
</body>
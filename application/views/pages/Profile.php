<!-- 
    Pessoal do back
    Neste arquivo separei a função de cada botão pelos IDs, exemplo:
    o Botão de seguir tem ID btn-seguir para começar a seguir
    e btn-deixar-seguir para deixar de seguir
 -->

<body>
    <main>
        <section class="profile-section" id="user-profile">
            <div id="user-profile-title">
                Perfil
                <div id="btns-area">
                    <!-- Caso não esteja seguindo -->
                    <button class="btn-follow" id="btn-seguir" type="button">Seguir</button>
                    <!--  -->

                    <!-- Caso já esteja -->
                    <!-- <button class="btn-follow" id="btn-deixar-seguir" type="button">Seguindo</button> -->
                    <!--  -->


                    <!-- <button id="btn-option-user" class="btn-option" type="button">•••</button>
                    <ul id="div-option-dropdown" class="option-dropdown-close">
                        <li>
                            <button id="" type="button" class="btn-dropdown">Botão</button>
                        </li>
                        <li>
                            <button id="" type="button" class="btn-dropdown">Botão</button>
                        </li>
                        <li>
                            <button id="" type="button" class="btn-dropdown">Botão</button>
                        </li>
                    </ul>
 -->
                    
                </div>
            </div>

            <div class="bar"></div>

            <div class="profile-info">
                <div class="profile-info-half">
                    <div class="profile-pic">
                            <img data-img-user>
                    </div>

                    <p class="profile-name" id="nome-usuario-profile"></p>
                </div>
                <div class="profile-info-half">

                    <div class="info-item-area">
                        <div class="info-item">
                            <img class="info-item-icon" src="<?= base_url() ?>assets/img/icon/calendar.png" alt="Calendário" title="Data de Nascimento">
                            <p class="info-item-description" name="data_nascimento">
                            
                            </p>
                        </div>
                        
                        <div class="info-item">
                            <img class="info-item-icon" src="<?= base_url() ?>assets/img/icon/mobile-phone.png" alt="Celular" title="Número de Celular">
                            <p class="info-item-description" name="telefone">
                              
                            </p>
                        </div>

                        <div class="info-item">
                            <img class="info-item-icon" src="<?= base_url() ?>assets/img/icon/gender.png" alt="Gênero" title="Gênero Sexual">
                            <p class="info-item-description" name="sexo">

                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bar"></div>

            <div id="user-profile-pet-area">

                    <!-- Loop de Pet -->
                    <!-- Lembrando q cada modal precisa ter o ID específico de cada pet -->
                    <div class="modal fade " id="pet-info" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="pet-info-area" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">


                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Perfil do Pet</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>


                                <div class="modal-body">

                                    <div class="profile-info">
                                        <div class="profile-info-half">
                                            <div class="profile-pic">
                                                    <img data-pet-img>
                                            </div>

                                            <p class="profile-name" id="pet-name"></p>
                                        </div>

                                        <div class="profile-info-half">

                                            <!-- Caso as informações estejam públicas num perfil de terceiro -->
                                            <div class="info-item-area">
                                                <div class="info-item">
                                                    <img class="info-item-icon" src="<?= base_url() ?>assets/img/icon/dices.png" alt="Tipo de Animal" title="Tipo de Animal">
                                                    <p class="info-item-description" id="tipo-pet">

                                                    </p>
                                                </div>
                                                
                                                <div class="info-item">
                                                    <img class="info-item-icon" src="<?= base_url() ?>assets/img/icon/kitty.png" alt="Raça" title="Raça">
                                                    <p class="info-item-description" id="raca-pet">
                                                        
                                                    </p>
                                                </div>

                                                <div class="info-item">
                                                    <img class="info-item-icon" src="<?= base_url() ?>assets/img/icon/gender.png" alt="Gênero" title="Gênero Sexual">
                                                    <p class="info-item-description" id="sexo-animal">
                                                        
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="unit">
                        <button class="card" data-bs-toggle="modal" data-bs-target="#pet-info">
                            <div class="unit-pic-area">
                                <img class="unit-pic" data-pet-img >
                            </div>
                            <p class="unit-name" id="pet-name"></p>
                        </button>
                    </div>
                    <!--  -->

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
                            <a class="post-pic">
                                <img src="https://avatars.githubusercontent.com/u/51789589?v=4" alt="Postagem">
                            </a>

                            <div class="post-info">
                                <p class="post-description">
                                    Descrição feita por João
                                </p>

                                <p class="post-date">
                                    10/04/2021
                                </p>
                            </div>

                            <div class="post-option">
                                <div></div>

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

                        <button class="more" id="btn-exibir-mais" type="button">
                            Mais postagens
                        </button>

                    </div>




                    <!-- Aba Seguindo -->
                    <div class="tab-pane fade" id="menu-following" role="tabpanel" aria-labelledby="menu-following-tab">

                        <div class="follow-area">
                            <!-- Loop de Pessoas Seguindo -->
                            <div class="unit">
                                <a class="card">
                                    <div class="unit-pic-area">
                                        <img class="unit-pic" src="<?= base_url() ?>assets/img/cachorro_login.png" alt="NOME" title="NOME">
                                    </div>
                                    <p class="unit-name">Nome</p>
                                </a>
                            </div>
                            <!--  -->
                        </div>

                    </div>

                    <!-- Aba Seguidores -->
                    <div class="tab-pane fade" id="menu-follower" role="tabpanel" aria-labelledby="menu-follower-tab">
                        
                        <div class="follow-area">
                            <!-- Loop de Seguidores -->
                            <div class="unit">
                                <a class="card">
                                    <div class="unit-pic-area">
                                        <img class="unit-pic" src="<?= base_url() ?>assets/img/cachorro_login.png" alt="NOME" title="NOME">
                                    </div>
                                    <p class="unit-name">Nome</p>
                                </a>
                                <img class="delete-follower" src="<?= base_url() ?>assets/img/icon/delete.png" data-bs-toggle="modal" data-bs-target="#modal-delete-seguidor">
                            </div>
                            <!--  -->
                        </div>

                        <!-- Deletar Seguidor -->
                        <div class="modal fade " id="modal-delete-seguidor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">


                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">
                                            Remover seguidor
                                            <span></span>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>


                                    <div class="modal-body">
                                        <h1 class="modal-description">Tem certeza que deseja remover este seguidor?</h1>
                                        <button id="btn-deletar-seguidor" class="modal-btn">Remover</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </section>
    </main>
</body>
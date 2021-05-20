<?php
    extract($usuario);
?>
<body>
        <main>
            <section id="config">

                <section class="nav" id="config-menu" role="tablist">  
                    <button class="config-option-selected" id="config-dados-tab" data-bs-toggle="tab" data-bs-target="#config-dados" type="button" role="tab" aria-controls="config-dados" aria-selected="true">Alterar dados</button>
                    <button class="config-option" id="config-pet-tab" data-bs-toggle="tab" data-bs-target="#config-pet" type="button" role="tab" aria-controls="config-pet" aria-selected="false">Seus pets</button>
                    <button class="config-option" id="config-excluir-tab" data-bs-toggle="tab" data-bs-target="#config-excluir" type="button" role="tab" aria-controls="config-excluir" aria-selected="false">Excluir conta</button>
                </section>
                
                <section id="config-info" class="tab-content">
                    <!-- dados-view -->
                    <div class="tab-pane fade show active" id="config-dados" role="tabpanel" aria-labelledby="config-dados-tab">
                        <h1 class="info-title">Altere os dados da sua conta</h1>

                        <form class="frm" id="form_alterar">
                            <section id="form-pic-area">
                                <div class="form-pic">
                                    <?php if(empty($foto_usuario)) : ?>
                                        <img class="pic" src="assets/img/user/unknown.jpg" alt="Foto do <?= $nome_usuario ?>" title="<?= $nome_usuario ?>">
                                    <?php else : ?>
                                        <img class="pic" src="assets/img/user/<?= $foto_usuario ?>" alt="Foto do <?= $nome_usuario ?>" title="<?= $nome_usuario ?>">
                                    <?php endif; ?>
                                    
                                    <input type="file" name="foto" enctype="multipart/form-data">
                                </div>
                            </section>

                            <section id="form-data" class="form-data-edit-user">
                                <div id="form-fields" class="form-fields-edit-user">
                                    <!-- <input type="hidden" name="id">??? -->
                                    <input type="hidden" name="email" value="<?=$email?>">

                                    <div class="form-fields-edit-user-data">
                                        <label> Nome de Usuario:</label>
                                        <input type="text" value="<?=$nome_usuario?>" class="form-input" name="nome_usuario" placeholder="Nome" required>
                                    </div>

                                    <div class="form-fields-edit-user-data">
                                        <label> Data de Nascimento:</label>
                                        <input type="date" value="<?=$data_nascimento?>" class="form-input" name="data_nascimento">
                                    </div>

                                    <div class="form-fields-edit-user-data">
                                        <label> Núemro de Telefone</label>
                                        <input type="text" value="<?=$telefone?>" class="form-input" name="telefone" placeholder="Telefone">
                                    </div>
                                </div>

                                <button id="btn-altera-dados-usuario" class="form-btn" type="button">Atualizar</button>
                            </section>
                        </form>
                    </div>

                    
                    <!-- pet-view -->
                     <div class="tab-pane fade" id="config-pet" role="tabpanel" aria-labelledby="config-pet-tab">
                        <?php foreach($pet as $dado_pet):?>
                        <div class="modal fade" id="pet-alterar-modal-<?=$dado_pet->id_animal?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel"><?= $dado_pet->nome_animal ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="modal-pet-item">
                                            <form class="frm" id="form-alterar-pet-<?= $dado_pet->id_animal ?>">
                                                <section id="form-pic-area">
                                                    <div class="form-pic">
                                                        
                                                        
                                                        <?php if(empty($dado_pet->foto_animal)) : ?>
                                                            <img class="form-pet-pic" id="form-pet-pic-alterar" src="<?= base_url() ?>assets/img/pet/unknown.jpg" alt="<?= $dado_pet->nome_animal ?>" title="<?= $dado_pet->nome_animal ?>">
                                                        <?php else : ?>
                                                            <img class="form-pet-pic" id="form-pet-pic-alterar" src="assets/img/pet/<?= $dado_pet->foto_animal ?>" alt="<?= $dado_pet->nome_animal ?>" title="<?= $dado_pet->nome_animal ?>">
                                                        <?php endif; ?>
                                                        <input type="file" name="foto_animal" enctype="multipart/form-data" value="<?=$dado_pet->foto_animal?>">
                                                    </div>
                                                </section>

                                                <section id="form-data">
                                                    <h1 class="form-title">Altere as informações de NOME</h1>

                                                    <div id="form-fields">
                                                        <input id="frm_alterar_id_animal" type="hidden" name="id_animal" value="<?=$dado_pet->id_animal?>">
                                                        <input id="frm_alterar_id_usuario"  type="hidden" name="id_usuario" value="<?=$dado_pet->id_usuario?>">
                                                        <input id="frm_alterar_nome_animal" type="text" class="form-input" name="nome_animal" placeholder="Nome" required value="<?=$dado_pet->nome_animal?>">
                                                        <!-- <select id="frm_alterar_tipo" class="form-input" name="tipo" required>
                                                            <option selected disabled>Tipo de animal</option>
                                                            <option value="1">Cachorros</option>
                                                            <option value="2">Gatos</option>
                                                            <option value="3">Peixes</option>
                                                            <option value="4">Aves</option>
                                                            <option value="5">Roedores</option>
                                                            <option value="6">Coelhos</option>
                                                            <option value="7">Tartarugas</option>
                                                            <option value="8">Bovinos</option>
                                                            <option value="9">Capríneos</option>
                                                            <option value="10">Equídeos</option>
                                                            <option value="11">Suínos</option>
                                                            <option value="12">Cobras</option>
                                                            <option value="13">Lagartos</option>
                                                            <option value="14">Macacos</option>
                                                            <option value="15">Insetos/aracnídeos</option>
                                                            <option value="16">Outros</option>
                                                        </select>
                                                        
                                                        <input id="frm_alterar_raca" type="text" class="form-input" name="raca" placeholder="Raça" required>

                                                        <select id="frm_alterar_sexo_animal" name="sexo_animal" class="form-input" required>
                                                            <option disabled selected>Gênero</option>
                                                            <option value="1">Masculino</option>
                                                            <option value="2">Feminino</option>
                                                            <option value="3">Outros</option>
                                                        </select> -->
                                                    </div>

                                                    <button class="form-btn" id="<?= $dado_pet->id_animal ?>" type="button">
                                                        Alterar
                                                        <p class="btn-type">edit-pet</p>
                                                    </button>
                                                </section>
                                            </form>
                                        </div>


                                    </div>
                                </div>
                            </div> 
                        </div> 
                        

                        <div class="modal fade" id="pet-excluir-modal-<?= $dado_pet->id_animal ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Deletar Pet</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="modal-pet-item">
                                            <form class="frm">
                                                <section id="form-data">
                                                    <h1 class="form-title">Você deseja realmente excluir <strong><?= $dado_pet->nome_animal ?></strong> ? :(</h1>

                                                    <div id="config-terms-modal">
                                                        <p>CUIDADO! Essa ação é irreversível, pense com muito cuidado antes de excluir seu Pet, pois todos os seus dados e postagens relacionadas a ele serão perdidas.</p>

                                                        <img src="<?= base_url() ?>assets/img/icon/sad-cat.png" alt="Gato triste">

                                                        <button id="<?= $dado_pet->id_animal ?>" class="form-btn" data-id="<?= $dado_pet->id_animal ?>" type="button">
                                                            Tenho certeza que quero excluir!
                                                            <p class="btn-type">delete-pet</p>
                                                        </button>
                                                    </div>

                                                </section>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>

                        <div class="modal fade" id="pet-criar-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Novo Pet</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="modal-pet-item">
                                            <form class="frm" id="form-criar-pet">
                                                <section id="form-pic-area">
                                                    <div class="form-pic">
                                                        <p>+</p>
                                                        <input type="file" name="foto_animal" enctype="multipart/form-data">
                                                    </div>
                                                </section>

                                                <section id="form-data">
                                                    <h1 class="form-title">Adicionar novo pet</h1>

                                                    <div id="form-fields">
                                                        <input id="frm_criar_id_usuario" type="hidden" name="id_usuario">
                                                        <input id="frm_criar_nome_animal" type="text" value="" class="form-input" name="nome_animal" placeholder="Nome" required>
                                                        <select id="frm_criar_tipo" class="form-input" name="tipo" required>
                                                            <option option selected disabled>Tipo de animal</option>
                                                            <?php foreach($tipo as $list_tipo) : ?>
                                                                <option value="<?=$list_tipo->id_tipo?>"><?= ucfirst($list_tipo->descricao)?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        
                                                        <input id="frm_criar_raca" type="text" class="form-input" name="raca" placeholder="Raça" required>

                                                        <select id="frm_criar_sexo_animal" name="sexo_animal" class="form-input" required>
                                                            <option disabled selected>Gênero</option>
                                                                <?php foreach($sexo as $list_sexo) : ?>
                                                                    <option value="<?=$list_sexo->id_sexo?>"><?= ucfirst($list_sexo->descricao)?></option>
                                                                <?php endforeach; ?>
                                                        </select>
                                                    </div>

                                                    <button class="form-btn" id="btn-cria-pet" type="button">Adicionar</button>
                                                </section>
                                            </form>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        
                         <!-- <?php if($mensagem == '') : ?> 
                        <div class="modal fade" id="pet-excluir-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Deletar Pet</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="modal-pet-item">
                                            <form class="frm" id="form-alterar-pet">
                                                <section id="form-data">
                                                    <h1 class="form-title">Você deseja realmente excluir <strong></strong> ? :(</h1>

                                                    <div id="config-terms-modal">
                                                        <p>CUIDADO! Essa ação é irreversível, pense com muito cuidado antes de excluir sua conta, pois todas as suas postagens serão perdidas e seus seguidores sentirão sua falta.</p>

                                                        <img src="<?= base_url() ?>assets/img/icon/sad-cat.png" alt="Gato triste">

                                                        <button id="btn-excluir-pet-id" class="form-btn" data-id="" type="button">Tenho certeza que quero excluir!</button>
                                                    </div>

                                                </section>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                          
                        <section id="user-pets">
                            <!-- Loop de pets -->
                            <?php foreach($pet as $dado_pet): ?> 
                            <div class="pet">
                                <div class="pet-config">
                                    <button id="edit-pet-x" class="pet-icon-edit" data-bs-toggle="modal" data-bs-target="#pet-alterar-modal-<?=$dado_pet->id_animal?>">
                                        <img src="<?= base_url() ?>assets/img/icon/edit.png" title="Editar pet">
                                    </button>
                                    <button id="delete-pet-x" class="pet-icon-delete" data-bs-toggle="modal" data-bs-target="#pet-excluir-modal-<?= $dado_pet->id_animal ?>">
                                        <img src="<?= base_url() ?>assets/img/icon/delete.png" title="Deletar pet">
                                    </button>
                                </div>
                                
                                <button class="pet-pic-area" type="button">
                                    <?php if(empty($dado_pet->foto_animal)) : ?>
                                        <img class="pet-pic" src="<?= base_url() ?>assets/img/pet/unknown.jpg">
                                    <?php else : ?>
                                        <img class="pet-pic" src="assets/img/pet/<?= $dado_pet->foto_animal ?>">
                                    <?php endif; ?>
                                </button>
                                <span class="pet-name"><?=$dado_pet->nome_animal?></span>
                               
                            </div>
                            <?php endforeach;?>
                            <!--  -->
                        </section>
                       
                        <?php else : ?>
                            <section id="user-pets">
                                <h2 style="padding:10% 0% 0% 27%;"><?=$mensagem?></h2>
                            </section>
                        <?php endif; ?>
                        <button id="btn-criar-pet" class="form-btn-pet" type="button" data-bs-toggle="modal" data-bs-target="#pet-criar-modal">Adicionar novo pet</button>
                    </div>


                    <!-- excluir-view -->
                    <div class="tab-pane fade" id="config-excluir" role="tabpanel" aria-labelledby="config-excluir-tab">
                        <h1 class="info-title">Excluir conta</h1>

                        <div id="config-terms">
                            <p>CUIDADO! Essa ação é irreversível, pense com muito cuidado antes de excluir sua conta, pois todas as suas postagens serão perdidas e seus seguidores sentirão sua falta.</p>

                            <img src="<?= base_url() ?>assets/img/icon/sad-cat.png" alt="Gato triste">

                            <button id="btn-excluir-usuario" class="form-btn" type="button">Tenho certeza que quero excluir!</button>
                        </div>
                    </div>          
                </section>
        </main>
    </body>
</html>
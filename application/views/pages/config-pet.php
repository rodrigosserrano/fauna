    <body>
        <main>
            <section id="config">
                <section id="config-menu">
                    <a class="config-option" href="<?= base_url()?>usuario-dados">Alterar dados</a>
                    <a class="config-option" href="<?= base_url()?>usuario-pet">Seus pets</a>
                    <a class="config-option" href="<?= base_url()?>usuario-deleta">Excluir conta</a>
                </section>

                <div class="modal fade" id="pet-alterar-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Nome do Pet</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="modal-pet-item">
                                    <form class="frm" id="form-alterar-pet">
                                        <section id="form-pic-area">
                                            <div class="form-pic">
                                                <!-- class="form-pet-pic" id="form-pet-pic-alterar" src="<?= base_url() ?>assets/img/user/" alt="Nome" title="Nome"> -->
                                                <input type="file" name="foto_animal" enctype="multipart/form-data" value="<?=$foto_animal?>">
                                            </div>
                                        </section>

                                        <section id="form-data">
                                            <h1 class="form-title">Altere as informações de NOME</h1>

                                            <div id="form-fields">
                                                <input id="frm_alterar_id_animal" type="hidden" name="id_animal" value="<?=$id_animal?>">
                                                <input id="frm_alterar_id_usuario"  type="hidden" name="id_usuario" value="<?=$id_usuario?>">
                                                <input id="frm_alterar_nome_animal" type="text" class="form-input" name="nome_animal" placeholder="Nome" required value="<?=$nome_animal?>">
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

                                            <button class="form-btn" id="btn-altera-dados-pet" type="button">Alterar</button>
                                        </section>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

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
                                            <h1 class="form-title">Você deseja realmente excluir <strong><?=$nome_animal?></strong> ? :(</h1>

                                            <div id="config-terms">
                                                <p>CUIDADO! Essa ação é irreversível, pense com muito cuidado antes de excluir sua conta, pois todas as suas postagens serão perdidas e seus seguidores sentirão sua falta.</p>

                                                <img src="<?= base_url() ?>assets/img/icon/sad-cat.png" alt="Gato triste">

                                                <button id="btn-excluir-pet-id" class="form-btn" data-id="<?= $id_animal?>" type="button">Tenho certeza que quero excluir!</button>
                                            </div>

                                        </section>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
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
                                                <input id="frm_criar_nome_animal" type="text" value="" class="form-input" name="nome_animal" placeholder="Nome" required>
                                                <select id="frm_criar_tipo" class="form-input" name="tipo" required>
                                                    <option selected disabled>Tipo de animal</option>
                                                    <?php foreach($tipo as $list_tipo) : ?>
                                                        <option value="<?=$list_tipo->id_tipo?>"><?= ucfirst($list_tipo->descricao)?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                
                                                <input id="frm_criar_raca" type="text" value="" class="form-input" name="raca" placeholder="Raça" required>

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
                
                <section id="config-info">

                <?php if($mensagem == '') : ?>
                    <section id="user-pets">
                        <!-- Loop de pets -->
                        <div class="pet">
                            <div class="pet-config">
                                <button id="edit-pet-x" class="pet-icon-edit" data-bs-toggle="modal" data-bs-target="#pet-alterar-modal">
                                    <img src="<?= base_url() ?>assets/img/icon/edit.png" title="Editar pet">
                                </button>
                                <button id="delete-pet-x" class="pet-icon-delete" data-bs-toggle="modal" data-bs-target="#pet-excluir-modal">
                                    <img src="<?= base_url() ?>assets/img/icon/delete.png" title="Deletar pet">
                                </button>
                            </div>
                            
                            <button class="pet-pic-area" type="button">
                                <?php if(isset($foto_animal) || empty($foto_animal)) : ?>
                                    <img class="pet-pic" src="<?= base_url() ?>assets/img/cachorro_login.png">
                                <?php else : ?>
                                    <img class="pet-pic" src="<?= $foto_animal ?>">
                                <?php endif; ?>
                            </button>
                            <span class="pet-name"><?=$nome_animal?></span>
                        </div>
                        <!--  -->
                    </section>
                    <?php else :?>
                        <section id="user-pets">
                            <h2 style="padding:10% 0% 0% 27%;"><?=$mensagem?></h2>
                        </section>
                    <?php endif; ?>
                    <button id="btn-criar-pet" class="form-btn-pet" type="button" data-bs-toggle="modal" data-bs-target="#pet-criar-modal">Adicionar novo pet</button>
                </section>
            </section>
        </main>
    </body>
</html>
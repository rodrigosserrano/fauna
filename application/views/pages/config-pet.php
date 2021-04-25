    <body>
        <main>
            <section id="config">
                <section id="config-menu">
                    <a class="config-option" href="<?= base_url()?>usuario-dados">Alterar dados</a>
                    <a class="config-option-selected">Seus pets</a>
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
                                                    <option selected disabled>Tipo de animal</option>
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
                
                <section id="config-info">

                    <section id="user-pets">
                        <!-- Loop de pets -->
                        <div class="pet">
                            <div class="pet-config">
                                <button id="edit-pet-x" class="pet-icon-edit" data-bs-toggle="modal" data-bs-target="#pet-alterar-modal">
                                    <img src="<?= base_url() ?>assets/img/icon/edit.png" title="Editar pet">
                                </button>
                                <button id="btn-excluir-pet-id" class="pet-icon-delete">
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

                    <button id="btn-criar-pet" class="form-btn-pet" type="button" data-bs-toggle="modal" data-bs-target="#pet-criar-modal">Adicionar novo pet</button>
                </section>
            </section>
        </main>
    </body>
</html>

<script>
    // só pra exemplificar + campos
    
    $(document).ready(function() {
        // document.querySelector('#frm_alterar_nome_animal').value = "teste"
        // $(#frm_alterar_id_animal)
        // $(#frm_alterar_id_usuario)
        // $(#frm_alterar_nome_animal)
        // $(#frm_alterar_raca)
        // $(#frm_alterar_sexo_animal)
        // $(#frm_alterar_tipo)


        // $(#frm_criar_id_usuario)
        // $(#frm_criar_nome_animal)
        // $(#frm_criar_raca)
        // $(#frm_criar_sexo_animal)
        // $(#frm_criar_tipo)
    })
</script>
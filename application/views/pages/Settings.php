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
                                <img class="pic" data-img-user="">
                                <input type="file" name="foto_usuario" enctype="multipart/form-data">
                            </div>
                        </section>

                        <section id="form-data" class="form-data-edit-user">
                            <div id="form-fields" class="form-fields-edit-user">
                                <input id="input-form-email" type="hidden" name="email" value="">

                                <div class="form-fields-edit-user-data">
                                    <label> Nome de Usuario:</label>
                                    <input type="text" value="" class="form-input" name="nome_usuario" placeholder="Nome" required>
                                </div>

                                <div class="form-fields-edit-user-data">
                                    <label> Data de Nascimento:</label>
                                    <input type="date" value="" class="form-input" name="data_nascimento">
                                </div>

                                <div class="form-fields-edit-user-data">
                                    <label> Núemro de Telefone</label>
                                    <input type="text" value="" class="form-input" name="telefone" placeholder="Telefone">
                                </div>
                            </div>

                            <button id="btn-altera-dados-usuario" class="form-btn" type="button">Atualizar</button>
                        </section>
                    </form>
                </div>
                
                <!-- pet-view -->
                    <div class="tab-pane fade" id="config-pet" role="tabpanel" aria-labelledby="config-pet-tab">
        
                    <div class="modal fade" id="pet-alterar-modal" data-id="pet-view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="modal-pet-item">
                                        <form class="frm" id="form-alterar-pet">
                                            <section id="form-pic-area">
                                                <div class="form-pic">       
                                                    <img class="form-pet-pic" id="form-pet-pic-alterar" src="#" alt="#" title="#">
                                                    <input type="file" id="input-foto-animal-com-foto" name="foto_animal" enctype="multipart/form-data">
                                                </div>
                                            </section>

                                            <section id="form-data">
                                                <h1 class="form-title">Altere as informações de NOME</h1>

                                                <div id="form-fields">
                                                    <input id="frm_alterar_id_animal" type="hidden" name="id_animal" value="">
                                                    <input id="frm_alterar_id_usuario"  type="hidden" name="id_usuario" value="">
                                                    <input id="frm_alterar_nome_animal" type="text" class="form-input" name="nome_animal" placeholder="Nome" required value="">
                                                </div>

                                                <button class="form-btn" id="btn-altera-pet" type="button">Alterar</button>
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
                                        <form class="frm">
                                            <section id="form-data">
                                                <h1 id="delete-pet-message" class="form-title"></h1>

                                                <div id="config-terms-modal">
                                                    <p>CUIDADO! Essa ação é irreversível, pense com muito cuidado antes de excluir seu Pet, pois todos os seus dados e postagens relacionadas a ele serão perdidas.</p>

                                                    <img src="<?= base_url() ?>assets/img/icon/sad-cat.png" alt="Gato triste">

                                                    <button id="btn-excluir-pet" class="form-btn del-pet-btn" data-id="" type="button">Tenho certeza que quero excluir!</button>
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
                                                    <input id="frm_criar_id_usuario" type="hidden" name="id_usuario">
                                                    <input id="frm_criar_nome_animal" type="text" value="" class="form-input" name="nome_animal" placeholder="Nome" required>
                                                    <select id="frm_criar_tipo" class="form-input" name="tipo" required>
                                                        <option option selected disabled>Tipo de animal</option>
                                                        <!-- <option id="tipo-animal" value=""></option> -->
                                                    </select>
                                                    
                                                    <input id="frm_criar_raca" type="text" class="form-input" name="raca" placeholder="Raça" required>

                                                    <select id="frm_criar_sexo_animal" name="sexo_animal" class="form-input" required>
                                                        <option disabled selected>Gênero</option>
                                                            <!-- <option value=""></option> -->
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
                        
                    <section id="user-pets">
                        <!-- Loop de pets -->
                            <div class="pet">
                                <div class="pet-config">
                                    <button id="edit-pet" class="pet-icon-edit" data-bs-toggle="modal" data-bs-target="#pet-alterar-modal">
                                        <img src="<?= base_url() ?>assets/img/icon/edit.png" title="Editar pet">
                                    </button>
                                    <button id="delete-pet" class="pet-icon-delete" data-bs-toggle="modal" data-bs-target="#pet-excluir-modal">
                                        <img src="<?= base_url() ?>assets/img/icon/delete.png" title="Deletar pet">
                                    </button>
                                </div>
                                
                                <button class="pet-pic-area" type="button">
                                        <img class="pet-pic" src="#">
                                </button>
                                <span class="pet-name">aa</span>
                            </div>

                            <!-- <h1 class="info-title-pets"></h1> -->
                        <!--  -->
                    </section>       
                    
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
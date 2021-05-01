    <body>
        <main>
            <section id="config">
                <section id="config-menu">
                    <a class="config-option-selected">Alterar dados</a>
                    <a class="config-option" href="<?= base_url()?>usuario-pet">Seus pets</a>
                    <a class="config-option" href="<?= base_url()?>usuario-deleta">Excluir conta</a>
                </section>
                
                <section id="config-info">
                    <h1 class="info-title">Altere os dados da sua conta</h1>

                    <form class="frm" id="form_alterar">
                        <section id="form-pic-area">
                            <div class="form-pic">
                                <!-- <img class="pic" src="<?= base_url() ?>assets/img/user/" alt="Nome" title="Nome"> -->
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
                </section>
            </section>
        </main>
    </body>
</html>
    <body>
        <main>
            <section id="config">
                <section id="config-menu">
                    <a class="config-option-selected">Alterar dados</a>
                    <a class="config-option">Seus pets</a>
                    <a class="config-option" href="<?= base_url()?>usuario-deleta">Excluir conta</a>
                </section>
                
                <section id="config-info">
                    <h1 class="info-title">Altere os dados da sua conta</h1>

                    <form id="form_alterar">
                        <section id="form-user-pic-area">
                            <div class="form-user-pic">
                                <!-- <img id="pic" src="<?= base_url() ?>assets/img/user/" alt="Nome" title="Nome"> -->
                                <input type="file" name="foto" enctype="multipart/form-data">
                            </div>
                        </section>

                        <section id="form-user-data">
                            <div id="form-user-fields">
                                <!-- <input type="hidden" name="id">??? -->
                                <input type="hidden" name="email" value="<?=$dados_usuario[0]->email?>">
                                <input type="text" value="<?=$dados_usuario[0]->nome_usuario?>" class="form-input" name="nome_usuario" placeholder="Nome" required>
                                <input type="date" value="<?=$dados_usuario[0]->data_nascimento?>" class="form-input" name="data_nascimento">
                                <input type="password" class="form-input" name="senha" placeholder="Senha" required>
                                <!--Melhorar ter  senha antiga
                                    <input type="password" class="form-input" name="senha" placeholder="Senha" required> -->
                                <input type="text" value="<?=$dados_usuario[0]->telefone?>" class="form-input" name="telefone" placeholder="Telefone">
                                <!-- 
                                    Melhorar
                                    <select name="sexo_usuario" class="form-input" required>
                                    <option disabled selected>Gênero</option>
                                    <option value="1">Masculino</option>
                                    <option value="2">Feminino</option>
                                    <option value="3">Outros</option>
                                </select> -->
                            </div>

                            <button id="btn-altera-dados-usuario" class="form-btn" type="button">Atualizar</button>
                        </section>
                    </form>
                </section>
            </section>
        </main>
    </body>
</html>
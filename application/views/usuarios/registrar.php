<body>
    <header>
        <div class="logo"><span><a style="text-decoration:none; color: black;" href="<?= base_url() ?>">Fauna</a></span></div>
    </header>
    <main>
        <form id="form-login">
            <div class="sections-container">
                <section class="left-form-container">
                    <div class="description">
                        <span>Registre-se</span><br>
                        <span>Cadastre-se para ter acesso à rede social mais fofa do planeta</span>
                    </div>
                    <div class="inputs-container">
                        <input type="email" name="email" placeholder="E-mail" required>
                        <input type="password" name="senha" placeholder="Senha" required>
                        <input type="password" name="repetir-senha" placeholder="Confirmar senha" required>
                    </div>
                </section>
                <section class="middle-form-container">
                    <div class="cat">
                        <!-- <img src="<?= base_url()?>assets/img/gato_registrar.png" id="pet-login"> -->
                    </div>
                    <div class="description"><span>Cadastre suas informações</span></div>
                    <label for="file-input1" class="file-label">
                        <div>+</div>
                        <span>Adicione sua foto</span>
                    </label>
                    <div id="file-input1" class="file-input-container"><input type="file" name="foto" enctype="multipart/form-data"></div>
                    <!--input file ainda com funcionamento pendente-->
                    <div class="inputs-container">
                        <input type="text" name="nome_usuario" placeholder="Nome" required>
                        <input type="text" name="telefone" placeholder="Telefone" required>
                        <select name="sexo_usuario" required>
                            <option disabled selected>Gênero</option>
                            <option value="1">Masculino</option>
                            <option value="2">Feminino</option>
                            <option value="3">Outros</option>
                        </select>
                        <input type="date" name="data_nascimento" placeholder="Data de nascimento" required>
                    </div>
                </section>
                <section class="right-form-container">
                    <div class="description"><span>Cadastre as informações do seu pet</span></div>
                    <label for="file-input2" class="file-label">
                        <div>+</div>
                        <span>Adicione a foto do seu pet</span>
                    </label>
                    <!--input file ainda com funcionamento pendente-->
                    <div id="file-input2" class="file-input-container"><input type="file" name="foto" enctype="multipart/form-data"></div>
                    <div class="inputs-container">
                        <input type="text" name="nome_animal" placeholder="Nome" required>
                        <select id="animal" name="tipo" required>
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
                        <input type="text" name="raca" placeholder="Raça">
                        <select name="sexo_animal" required>
                            <option selected disabled>Gênero</option>
                            <option value="1">Masculino</option>
                            <option value="2">Feminino</option>
                        </select>
                    </div>
                </section>
            </div>
            <button id="btn-register" type="button" >Cadastrar</button>
        </form>
    </main>
    <footer>

    </footer>
</body>
</html>
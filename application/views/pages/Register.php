<body>
    <header>
        <div class="logo"><span><a style="text-decoration:none; color: #fff;" href="<?= base_url() ?>">Fauna</a></span></div>
    </header>
    <main>
        <form id="form-register">
            <div class="sections-container">
                <section class="left-form-container">
                    <div class="description">
                        <span>Registre-se</span><br>
                        <span>Cadastre-se para ter acesso à rede social mais fofa do planeta</span>
                    </div>
                    <div class="inputs-container">
                        <input type="email" name="email" placeholder="E-mail" required>
                        <input type="password" name="senha" placeholder="Senha" required>
                        <input type="password" name="repetir_senha" placeholder="Confirmar senha" required>
                    </div>
                </section>
                <section class="middle-form-container">
                    <div class="cat"></div>
                    <div class="description"><span>Cadastre suas informações</span></div>
                    <label for="file-input1" class="file-label">
                        <div><span>+</span></div>
                        <span id="user-pic">Adicione sua foto</span>
                    </label>
                    <input id="file-input1" type="file" name="foto_usuario" enctype="multipart/form-data" class="file-input">
                    <div class="inputs-container">
                        <input type="text" name="nome_usuario" placeholder="Nome" required>
                        <input type="text" name="telefone" id="telefone" placeholder="Telefone" required>
                        <select name="sexo_usuario" required>
                            <option disabled selected>Gênero</option>
                            <?php foreach($sexo as $list_sexo) : ?>
                                <option value="<?=$list_sexo->id_sexo?>"><?= ucfirst($list_sexo->descricao)?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" id="birth_date" name="data_nascimento" placeholder="Data de nascimento" required>
                    </div>
                </section>
                <section class="right-form-container">
                    <div class="description"><span>Cadastre as informações do seu pet</span></div>
                    <label for="file-input2" class="file-label">
                        <div><span>+</span></div>
                        <span id="pet-pic">Adicione a foto do seu pet</span>
                    </label>
                    <input id="file-input2" type="file" name="foto_animal" enctype="multipart/form-data" class="file-input">
                    <div class="inputs-container">
                        <input type="text" name="nome_animal" placeholder="Nome" required>
                        <select id="animal" name="tipo" required>
                            <option selected disabled>Tipo de animal</option>    
                            <?php foreach($tipo as $list_tipo) : ?>
                                <option value="<?=$list_tipo->id_tipo?>"><?= ucfirst($list_tipo->descricao)?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="raca" placeholder="Raça">
                        <select name="sexo_animal" required>
                            <option disabled selected>Gênero</option>
                            <?php $sexo = array_slice($sexo, 0, 2);
                             foreach($sexo as $list_sexo) : ?>
                                <option value="<?=$list_sexo->id_sexo?>"><?= ucfirst($list_sexo->descricao)?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </section>
            </div>
            <button id="btn-register" type="button" >Cadastrar</button>
        </form>

        <script>
            const selects = Array.from(document.getElementsByTagName("select"))
            
            selects.forEach(select => {
                let options = Array.from(select.querySelectorAll("option"))
                select.addEventListener("change", e => {
                    options.forEach(opt => {
                        let optText = opt.textContent
                        if(opt.value == e.target.value){
                            if(optText == "Gênero" || optText == "Tipo de animal")
                                e.target.style.color = "#777"
                            else
                                e.target.style.color = "#000"
                        }
                        opt.style.color = "#777"
                    })
                })
            })

            document.querySelector("#birth_date").addEventListener("focus", e => {
                e.target.setAttribute("type", "date")
            })
            document.querySelector("#birth_date").addEventListener("blur", e => {
                if(e.target.value == "")
                    e.target.setAttribute("type", "text")
            })
        </script>
    </main>
    <footer>
    </footer>
</body>

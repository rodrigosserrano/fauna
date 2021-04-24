<!-- Separar essa porra em outro arquivo depois :) -->
<script>
    $(document).ready(function() {

        $("#telefone").mask('(00) 00000-0000');

    });
</script>

<body>
    <header>
        <div class="logo"><span><a style="text-decoration:none; color: black;" href="<?= base_url() ?>">Fauna</a></span></div>
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
                    <div class="cat">
                        <!-- <img src="<?= base_url()?>assets/img/gato_registrar.png" id="pet-login"> -->
                    </div>
                    <div class="description"><span>Cadastre suas informações</span></div>
                    <label for="file-input1" class="file-label">
                        <div><span>+</span></div>
                        <span id="user-pic">Adicione sua foto</span>
                    </label>
                    <input id="file-input1" type="file" name="foto_usuario" enctype="multipart/form-data">
                    <!--input file ainda com funcionamento pendente-->
                    <div class="inputs-container">
                        <input type="text" name="nome_usuario" placeholder="Nome" required>
                        <input type="text" name="telefone" id="telefone" placeholder="Telefone" required>
                        <select name="sexo_usuario" required>
                            <option disabled selected>Gênero</option>
                            <?php 
                            foreach($sexo as $list_sexo)
                             echo "<option value=".$list_sexo->id_sexo.">$list_sexo->descricao</option>";
                            ?>
                        </select>
                        <input type="date" name="data_nascimento" placeholder="Data de nascimento" required>
                    </div>
                </section>
                <section class="right-form-container">
                    <div class="description"><span>Cadastre as informações do seu pet</span></div>
                    <label for="file-input2" class="file-label">
                        <div><span>+</span></div>
                        <span id="pet-pic">Adicione a foto do seu pet</span>
                    </label>
                    <!--input file ainda com funcionamento pendente-->
                    <input id="file-input2" type="file" name="foto_animal" enctype="multipart/form-data">
                    <div class="inputs-container">
                        <input type="text" name="nome_animal" placeholder="Nome" required>
                        <select id="animal" name="tipo" required>
                            <option selected disabled>Tipo de animal</option>    
                            <?php 
                            foreach($tipo as $list_tipo)
                             echo "<option value=".$list_tipo->id_tipo.">$list_tipo->descricao</option>";
                            ?>
                        </select>
                        <input type="text" name="raca" placeholder="Raça">
                        <select name="sexo_animal" required>
                            <option disabled selected>Gênero</option>
                            <?php 
                            foreach($sexo as $list_sexo)
                             echo "<option value=".$list_sexo->id_sexo.">$list_sexo->descricao</option>";
                            ?>
                        </select>
                    </div>
                </section>
            </div>
            <button id="btn-register" type="button" >Cadastrar</button>
        </form>
    </main>
    <footer>
    </footer>

    <script>
        function readImage(file){
            // Check if the file is an image.
            if (file.type && !file.type.startsWith('image/')) {
                console.log('File is not an image.', file.type, file);
                return;
            }

            const reader = new FileReader();
            reader.addEventListener('load', (event) => {
                Array.from(document.querySelectorAll(".file-label")).forEach(el => {
                    let div = el.querySelector("div");
                    div.innerHTML = "";
                    div.style.position = "relative";
                    div.style.overflow = "hidden";

                    div.appendChild(document.createElement("img"));
                    div.querySelector("img").style.relative = "absolute";
                    div.querySelector("img").style.width = "100%";
                    div.querySelector("img").src = event.target.result;
                });
            });
            reader.readAsDataURL(file);
        }

        document.querySelector('#file-input1').addEventListener('input', e => {
            document.querySelector('#user-pic').textContent = e.target.files[0].name;
            readImage(e.target.files[0]);
        });
        document.querySelector('#file-input2').addEventListener('input', e => {
            /*document.querySelector('#pet-pic').style.maxWidth = "150px";
            document.querySelector('#pet-pic').style.overflow = "hidden";*/
            document.querySelector('#pet-pic').textContent = e.target.files[0].name;
            readImage(e.target.files[0]);
        });
    </script>
</body>

    <body>
        <main>
            <section id="config">
                <section id="config-menu">
                    <a id="config-dados" class="config-option-selected">Alterar dados</a>
                    <a id="config-pet" class="config-option">Seus pets</a>
                    <a id="config-excluir" class="config-option">Excluir conta</a>
                </section>
                
                <section id="config-info"></section>

            </section>
        </main>

        <script>
            var viewElement         = document.querySelector('#config-info')
            let btnConfigDados      = document.querySelector('#config-dados')
            let btnConfigPet        = document.querySelector('#config-pet')
            let btnConfigExcluir    = document.querySelector('#config-excluir')

            btnConfigDados.addEventListener('click', () => {
                if(btnConfigDados.className == 'config-option') {
                    document.querySelector('.config-option-selected').className = 'config-option'
                    btnConfigDados.className = 'config-option-selected'
                    setView( loadViewDados() )

                }
            })

            btnConfigPet.addEventListener('click', () => {
                if(btnConfigPet.className == 'config-option') {
                    document.querySelector('.config-option-selected').className = 'config-option'
                    btnConfigPet.className = 'config-option-selected'
                    setView( loadViewPet() )

                }
            })

            btnConfigExcluir.addEventListener('click', () => {
                if(btnConfigExcluir.className == 'config-option') {
                    document.querySelector('.config-option-selected').className = 'config-option'
                    btnConfigExcluir.className = 'config-option-selected'
                    setView( loadViewExcluir() )

                }
            })

            function setView(viewContent) {
                viewElement.innerHTML = viewContent
            }

            function loadViewDados() {
                let viewContent = '' 

                viewContent += "<h1 class='info-title'>Altere os dados da sua conta</h1>"
                viewContent += "<form class='frm' id='form_alterar'>"

                viewContent += "    <section id='form-pic-area'>"
                viewContent += "        <div class='form-pic'>"
                viewContent += "            <!-- <img class='pic' src='<?= base_url() ?>assets/img/user/' alt='Nome' title='Nome'> -->"
                viewContent += "            <input type='file' name='foto' enctype='multipart/form-data'>"
                viewContent += "    </div></section>"

                viewContent += "    <section id='form-data' class='form-data-edit-user'>"
                viewContent += "        <div id='form-fields' class='form-fields-edit-user'>"
                viewContent += "            <!-- <input type='hidden' name='id'>??? -->"
                viewContent += "            <input type='hidden' name='email' value='<?=$email?>'>"

                viewContent += "        <div class='form-fields-edit-user-data'>"
                viewContent += "            <label> Nome de Usuario:</label>"
                viewContent += "            <input type='text' value='<?=$nome_usuario?>' class='form-input' name='nome_usuario' placeholder='Nome' required></div>"

                viewContent += "        <div class='form-fields-edit-user-data'>"
                viewContent += "            <label> Data de Nascimento:</label>"
                viewContent += "            <input type='date' value='<?=$data_nascimento?>' class='form-input' name='data_nascimento'></div>"

                viewContent += "        <div class='form-fields-edit-user-data'>"
                viewContent += "            <label> Núemro de Telefone</label>"
                viewContent += "            <input type='text' value='<?=$telefone?>' class='form-input' name='telefone' placeholder='Telefone'>"
                viewContent += "    </div></div>"
                viewContent += "    <button id='btn-altera-dados-usuario' class='form-btn' type='button'>Atualizar</button>"
                viewContent += "</section></form>"

                return viewContent
            }

            function loadViewPet() {
                let viewContent = ''

                viewContent += "<div class='modal fade' id='pet-alterar-modal' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>"
                viewContent += "    <div class='modal-dialog modal-lg'>"
                viewContent += "        <div class='modal-content'>"
                viewContent += "            <div class='modal-header'>"
                viewContent += "                <h5 class='modal-title' id='staticBackdropLabel'>Nome do Pet</h5>"
                viewContent += "                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button></div>"
                viewContent += "        <div class='modal-body'>"
                viewContent += "            <div class='modal-pet-item'>"
                viewContent += "                <form class='frm' id='form-alterar-pet'>"
                viewContent += "                    <section id='form-pic-area'>"
                viewContent += "                        <div class='form-pic'>"
                viewContent += "                            <!-- class='form-pet-pic' id='form-pet-pic-alterar' src='<?= base_url() ?>assets/img/user/' alt='Nome' title='Nome'> -->"
                viewContent += "                            <input type='file' name='foto_animal' enctype='multipart/form-data' value='<?=$foto_animal?>'>"
                viewContent += "                    </div></section>"
                viewContent += "                    <section id='form-data'>"
                viewContent += "                        <h1 class='form-title'>Altere as informações de NOME</h1>"
                viewContent += "                        <div id='form-fields'>"
                viewContent += "                            <input id='frm_alterar_id_animal' type='hidden' name='id_animal' value='<?=$id_animal?>'>"
                viewContent += "                            <input id='frm_alterar_id_usuario'  type='hidden' name='id_usuario' value='<?=$id_usuario?>'>"
                viewContent += "                            <input id='frm_alterar_nome_animal' type='text' class='form-input' name='nome_animal' placeholder='Nome' required value='<?=$nome_animal?>'>"

                // <select id='frm_alterar_tipo' class='form-input' name='tipo' required>
                //     <option selected disabled>Tipo de animal</option>
                //     <option value='1'>Cachorros</option>
                //     <option value='2'>Gatos</option>
                //     <option value='3'>Peixes</option>
                //     <option value='4'>Aves</option>
                //     <option value='5'>Roedores</option>
                //     <option value='6'>Coelhos</option>
                //     <option value='7'>Tartarugas</option>
                //     <option value='8'>Bovinos</option>
                //     <option value='9'>Capríneos</option>
                //     <option value='10'>Equídeos</option>
                //     <option value='11'>Suínos</option>
                //     <option value='12'>Cobras</option>
                //     <option value='13'>Lagartos</option>
                //     <option value='14'>Macacos</option>
                //     <option value='15'>Insetos/aracnídeos</option>
                //     <option value='16'>Outros</option>
                // </select>
                
                // <input id='frm_alterar_raca' type='text' class='form-input' name='raca' placeholder='Raça' required>

                // <select id='frm_alterar_sexo_animal' name='sexo_animal' class='form-input' required>
                //     <option disabled selected>Gênero</option>
                //     <option value='1'>Masculino</option>
                //     <option value='2'>Feminino</option>
                //     <option value='3'>Outros</option>
                // </select>

                viewContent += "                        </div>"
                viewContent += "                        <button class='form-btn' id='btn-altera-dados-pet' type='button'>Alterar</button>"
                viewContent += "</section></form></div></div></div></div></div>"




                viewContent += "<div class='modal fade' id='pet-criar-modal' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>"
                viewContent += "    <div class='modal-dialog modal-lg'>"
                viewContent += "        <div class='modal-content'>"
                viewContent += "            <div class='modal-header'>"
                viewContent += "                <h5 class='modal-title' id='staticBackdropLabel'>Novo Pet</h5>"
                viewContent += "                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button></div>"
                viewContent += "             <div class='modal-body'>"
                viewContent += "                <div class='modal-pet-item'>"

                viewContent += "                    <form class='frm' id='form-criar-pet'>"
                viewContent += "                        <section id='form-pic-area'>"
                viewContent += "                            <div class='form-pic'>"
                viewContent += "                                <p>+</p>"
                viewContent += "                        <input type='file' name='foto_animal' enctype='multipart/form-data'></div></section>"
                viewContent += "                        <section id='form-data'>"
                viewContent += "                            <h1 class='form-title'>Adicionar novo pet</h1>"
                viewContent += "                            <div id='form-fields'>"
                viewContent += "                                <input id='frm_criar_id_usuario' type='hidden' name='id_usuario'>"
                viewContent += "                                <input id='frm_criar_nome_animal' type='text' value='' class='form-input' name='nome_animal' placeholder='Nome' required>"
                viewContent += "                                <select id='frm_criar_tipo' class='form-input' name='tipo' required>"
                viewContent += "                                    <option selected disabled>Tipo de animal</option>"

                <?php foreach($tipo as $list_tipo) : ?>
                    viewContent += "                                    <option value='<?=$list_tipo->id_tipo?>'><?= ucfirst($list_tipo->descricao)?></option>"
                <?php endforeach; ?>

                viewContent += "                                </select>"
                viewContent += "                                <input id='frm_criar_raca' type='text' class='form-input' name='raca' placeholder='Raça' required>"
                viewContent += "                                <select id='frm_criar_sexo_animal' name='sexo_animal' class='form-input' required>"
                viewContent += "                                    <option disabled selected>Gênero</option>"

                <?php foreach($sexo as $list_sexo) : ?>
                    viewContent += "                                    <option value='<?=$list_sexo->id_sexo?>'><?= ucfirst($list_sexo->descricao)?></option>"
                <?php endforeach; ?>

                viewContent += "                            </select></div>"
                viewContent += "                            <button class='form-btn' id='btn-cria-pet' type='button'>Adicionar</button>"
                viewContent += "</section></form></div></div></div></div></div>"


                
                viewContent += "<section id='user-pets'>"

                // Loop de pets
                viewContent += "    <div class='pet'>"
                viewContent += "        <div class='pet-config'>"
                viewContent += "            <button id='edit-pet-x' class='pet-icon-edit' data-bs-toggle='modal' data-bs-target='#pet-alterar-modal'>"
                viewContent += "                <img src='<?= base_url() ?>assets/img/icon/edit.png' title='Editar pet'>"
                viewContent += "            </button>"
                viewContent += "            <button id='btn-excluir-pet-id' class='pet-icon-delete'>"
                viewContent += "                <img src='<?= base_url() ?>assets/img/icon/delete.png' title='Deletar pet'>"
                viewContent += "        </button></div>"

                viewContent += "        <button class='pet-pic-area' type='button'>"

                <?php if(isset($foto_animal) || empty($foto_animal)) : ?>
                    viewContent += "            <img class='pet-pic' src='<?= base_url() ?>assets/img/cachorro_login.png'>"
                <?php else : ?>
                    viewContent += "            <img class='pet-pic' src='<?= $foto_animal ?>'>"
                <?php endif; ?>

                viewContent += "        </button>"
                viewContent += "        <span class='pet-name'><?=$nome_animal?></span>"
                viewContent += "    </div>"
                // 

                viewContent += "</section>"
                viewContent += "<button id='btn-criar-pet' class='form-btn-pet' type='button' data-bs-toggle='modal' data-bs-target='#pet-criar-modal'>Adicionar novo pet</button>"
                
                return viewContent
            }

            function loadViewExcluir() {
                let viewContent = ''

                viewContent += "<h1 class='info-title'>Excluir conta</h1>"
                viewContent += "<div id='config-terms'>"
                viewContent += "    <p>CUIDADO! Essa ação é irreversível, pense com muito cuidado antes de excluir sua conta, pois todas as suas postagens serão perdidas e seus seguidores sentirão sua falta.</p>"
                viewContent += "    <img src='<?= base_url() ?>assets/img/icon/sad-cat.png' alt='Gato triste'>"
                viewContent += "    <button id='btn-excluir-usuario' class='form-btn' type='button'>Tenho certeza que quero excluir!</button>"
                viewContent += "</div>"
                
                return viewContent
            }
        </script>
    </body>
</html>
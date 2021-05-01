    <body>
        <main>
            <section id="config">
                <section id="config-menu">
                     <a class="config-option" href="<?= base_url()?>usuario-dados">Alterar dados</a>
                    <a class="config-option" href="<?= base_url()?>usuario-pet">Seus pets</a>
                    <a class="config-option-selected">Excluir conta</a>
                </section>
                
                <section id="config-info">
                    <h1 class="info-title">Excluir conta</h1>

                    <div id="config-terms">
                        <p>CUIDADO! Essa ação é irreversível, pense com muito cuidado antes de excluir sua conta, pois todas as suas postagens serão perdidas e seus seguidores sentirão sua falta.</p>

                        <img src="<?= base_url() ?>assets/img/icon/sad-cat.png" alt="Gato triste">

                        <button id="btn-excluir-usuario" class="form-btn" type="button">Tenho certeza que quero excluir!</button>
                    </div>
                    
                </section>
            </section>
        </main>
    </body>
</html>

    <body>
        <div class="w-100 logo-box"><span class="logo">Fauna</span></div>
        <div class="alertArea"></div>
        <main>
            <section id="slogan">
                <p class="slogan-text">
                    Entre e divirta-se em uma comunidade que ama animais de estimação.
                </p>
                <p class="slogan-text">
                    Compartilhe seus momentos preciosos com seus pets!
                </p>
                
            </section>

            <section class="login-box">
                <img src="<?= base_url()?>assets/img/cachorro_login.png" id="pet-login">

                <div class="container">
                    <img class="paw-icon" src="<?= base_url()?>assets/img/paw.png">
                    <p>Entre com sua conta</p>

                    <form id="form-login" class="form-login">
                        <div class="box-mensagem hidden"><p id="mensagem"></p></div>

                        <input class="form-input" type="email" name="email" placeholder="Email" required>
                        <input class="form-input" type="password" name="senha" placeholder="Senha" required>

                        <div class="bar"></div>

                        <button id="btn-login" type="button" class="btn-login">Entrar</button>
                    </form>

                    <a href="<?= base_url()?>forgot" class="link">Esqueci minha senha</a>
                </div>

                <div class="mini-container">
                    <p>
                        Não tem uma conta?
                        <a href="<?= base_url()?>register" class="link">Cadastre-se</a>
                    </p>
                </div>
            </section>
        </main>
    </body>
        
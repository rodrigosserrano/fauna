<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Fauna, rede social de pets"/>
        <meta name="author" content="André, Gabriel, João, Jonatha, Nathan, Rodrigo"/>
        <meta name="generator" content="VS Code"/>
        <meta name="keywords" content="rede social, pets, animais"/>

        <script src="https://kit.fontawesome.com/598f8e27d9.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="<?= base_url()?>/assets/css/styleLogin.css">
        <title>Fauna | Login</title>
    </head>

    <body>
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
                <img src="<?= base_url()?>/assets/img/cachorro_login.png" id="pet-login">

                <div class="container">
                    <img class="paw-icon" src="<?= base_url()?>/assets/img/paw.png">
                    <p>Entre com sua conta</p>

                    <form class="form-login">
                        <input class="form-input" type="email" name="email" placeholder="Email">
                        <input class="form-input" type="password" name="senha" placeholder="Senha">

                        <div class="bar"></div>

                        <button type="submit" class="btn-login">Entrar</button>
                    </form>

                    <a href="" class="link">Esqueci minha senha</a>
                </div>

                <div class="mini-container">
                    <p>
                        Não tem uma conta?
                        <a href="" class="link">Cadastre-se</a>
                    </p>
                </div>
            </section>
        </main>
    </body>
</html>
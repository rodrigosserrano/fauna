<nav id="navbar">
    <a href="<?= base_url() ?>" id="nav-logo">Fauna</a>

    <!-- se o usuário estiver logado aparecer também -->
    <div id="nav-user">
        <a href="<?= base_url() ?>profile" class="nav-userpic-area">
            <img class="nav-userpic" src="assets/img/user/unknown.jpg" title="Nome" alt="Nome">
        </a>

        <a id="config-anchor" href="<?= base_url()?>settings" class="link"><img id="btn-config" src="<?= base_url() ?>assets/img/icon/config.png" alt="Configurações" title="Configurações"></a>
        <!-- da pra rodar um scriptzinho com btn-config pra redirecionar ou colocar dentro de um 'a' -->
        <div class="vertical-bar"></div>
        <a href="" id="btn-logout" class="logout">Sair ➝</a>

    </div>

    <!-- -->
</nav>
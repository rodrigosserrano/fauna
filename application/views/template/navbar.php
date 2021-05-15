<nav id="navbar">
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>

    <a href="<?= base_url() ?>" id="nav-logo">Fauna</a>

    <!-- se o usuário estiver logado aparecer também -->
    <div id="nav-user">
        <div class="nav-userpic-area">
            <!-- <img class="nav-userpic" src="<?= base_url() ?>assets/img/user/foto.png" title="Nome" alt="Nome"> -->
        </div>

        <a id="config-anchor" href="<?= base_url()?>settings" class="link"><img id="btn-config" src="<?= base_url() ?>assets/img/icon/config.png" alt="Configurações" title="Configurações"></a>
        <!-- da pra rodar um scriptzinho com btn-config pra redirecionar ou colocar dentro de um 'a' -->
        <div class="vertical-bar"></div>
        <a href="" id="btn-logout" class="logout">Sair ➝</a>

    </div>

    <!-- -->
</nav>
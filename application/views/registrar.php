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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nothing+You+Could+Do&display=swap" rel="stylesheet"> 
    <title>Fauna | Cadastre-se</title>
</head>
<body>
    <header>
        <div class="logo"><span>Fauna</span></div>
    </header>
    <main>
        <form>
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
                    <div class="cat"></div>
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
            <button type="submit">Cadastrar</button>
        </form>
    </main>
    <footer>

    </footer>
    <style>
        *{
            padding:0;
            margin:0;
            box-sizing: border-box;
        }

        input, button, select{
            outline: none;
        }

        input[type="file"]{
            display: none;
        }

        :root {
            --background-color: #FCF8EC;
            --container-color: #CDB28A;
            --link-color: #0870AB;
            --link-hover-color: #01446b;
            --darker-color: #7A6448;
            --darker-hover-color: #584833;
            --font-color: #3A3A3A;
            --input-color: #F3F3F3;
        }
    
        body{
            font-family: Roboto,sans-serif;
            background-color: var(--background-color);
            color: var(--font-color);
        }

        header{
            background-color: var(--container-color);  
            height: 50px;
            width: 100%;
        }

        header .logo{
            font-family: 'Indie Flower', cursive;
            font-size: 36px;
            margin-left: 2%;
        }

        main form{
            display: flex;
            flex-direction: column;
            align-items: center;
            
        }

        main .sections-container{
            padding: 0 8%;
            margin: 4% 0 2% 0;
            display: flex;
            justify-content: space-between;
        }

        main section{
            background-color: var(--container-color);
            width: calc(97%/3);
            border: none;
            border-radius: 3px;
            position: relative;
            padding: 2% 5% 6% 5%;
        }

        .left-form-container .description{
            text-align: center;
            margin-bottom: 50px;
        }

        .left-form-container .description span{
            display: inline-block;
            margin-bottom: 10px;
        }
        
        .left-form-container .description span:first-of-type{
            font-size: 20px;
            font-weight: 600;
        }

        section input, section select{
            margin-bottom: 10px;
            padding:7px;
            padding-left: 15px;
            width: 100%;
            border-radius: 3px;
            border: 1px #ccc solid;
            background-color: var(--input-color);
        }

        input::placeholder, select, input[type="date"]{
            font-size: 16px;
            opacity: 100%;
            color: #888;
        }

        /*input[type="password"]{
            background-image: url('../assets/img/animals_icons/111646-fauna/png/bulldog-head.png');
            background-size: 20px;
            background-repeat: no-repeat;
            background-position: 95%;
        }*/

        /*select#animal option[value="1"]{
            background-image: url('../assets/img/animals_icons/111646-fauna/png/bulldog-head.png');
            background-size: 20px;
            background-repeat: no-repeat;
            background-position: 95%;
        }*/

        .middle-form-container .description, .right-form-container .description{
            font-size: 14px;
            font-weight: 600;
            text-align: center;
        }

        section label{
            display: flex;
            margin-top: 10px;
            margin-bottom: 50px;
            align-items: center;
            cursor: pointer;
        }

        section label:hover div{
            background-color: var(--darker-hover-color);
            transition: 0.2s;
        }

        section label div{
            font-size: 60px;
            color: var(--input-color);
            font-family: Arial;
            background-color: var(--darker-color);
            padding: 0 10px;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: none;
            margin-right: 8px;
            text-align: center;
        }

        .cat{
            position: absolute;
            width: 100px;
            height: 100px;
            background-image: url("../assets/img/gato_registrar.png");
            background-repeat: no-repeat;
            background-size: cover;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
        }

        main button{
            background-color: var(--darker-color);
            color: var(--input-color);
            width: 270px;
            height: 40px;
            border: none;
            border-radius: 3px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        main button:hover{
            background-color: var(--darker-hover-color);
        }
    </style>

    <script>
    </script>
</body>
</html>
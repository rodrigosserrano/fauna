$(document).ready(function() {
    // Botão Opções do Usuário
    let btnOptionArray = document.getElementsByClassName('btn-option');

    for(let i = 0; i < btnOptionArray.length; i++) {
        btnOptionArray[i].addEventListener('click', () => {

            if(btnOptionArray[i]) {
                let menu = document.getElementsByTagName('ul')[i];
    
                if(menu.className == 'option-dropdown') {
                    menu.className = 'option-dropdown-close';

                } else {
                    checkPopUP();
                    menu.className = 'option-dropdown';
                }
            }

        })
    }

    function checkPopUP() {
        let alreadyPoppedUp = document.querySelector('.option-dropdown');
        if(alreadyPoppedUp) {
            alreadyPoppedUp.className = 'option-dropdown-close';
        }
    }

    // Botões do Menu
    let tabBtns = [];

    tabBtns.push(document.querySelector('#profile-posts'));
    tabBtns.push(document.querySelector('#profile-following'));
    tabBtns.push(document.querySelector('#profile-followers'));
    
    tabBtns.map((tab) => {
        tab.addEventListener('click', () => {
            selectTab(tab)
        })
    })

    function selectTab(tab) {
        if(tab.className == 'profile-option active') {
            document.querySelector('.profile-option-selected').className = 'profile-option';
            tab.className = 'profile-option-selected';
        }
    }

    // Botão Mais Postagens
    let btnMorePosts = document.querySelector('#btn-exibir-mais');
    
    btnMorePosts.addEventListener('click', () => {
        let postArea = document.querySelector('#menu-post');
        postArea.removeChild(btnMorePosts);

        let posts = []
                        // nome                 imagem                           descrição               data           paw-like-set ou unset,              qtd de likes
        posts.push(newPost('home', 'NOME DA POSTAGEM', 'assets/img/cachorro_login.png', 'DESCRIÇÃO DA POSTAGEM', '10/04/2021', 'assets/img/icon/paw-like-unset.png', '10'));
        posts.push(newPost('home', 'NOME DA POSTAGEM', 'assets/img/cachorro_login.png', 'DESCRIÇÃO DA POSTAGEM', '10/04/2021', 'assets/img/icon/paw-like-unset.png', '10'));
        posts.push(newPost('home', 'NOME DA POSTAGEM', 'assets/img/cachorro_login.png', 'DESCRIÇÃO DA POSTAGEM', '10/04/2021', 'assets/img/icon/paw-like-unset.png', '10'));
        
        for(post of posts) {
            postArea.appendChild(post);
        }
        
        postArea.appendChild(btnMorePosts);
    })

    function newPost(link, name, imgSrc, description, date, likeIcon, likeAmount) {
        let cardElement                  = document.createElement('div');
        cardElement.className            = 'post-card';
    
        // Elementos do Post
        let picAreaElement              = document.createElement('a');
        picAreaElement.className        = 'post-pic';

        let picElement                  = document.createElement('img');
        
        let infoAreaElement             = document.createElement('div');
        infoAreaElement.className       = 'post-info';

        let descriptionElement          = document.createElement('p');
        descriptionElement.className    = 'post-description';

        let dateElement                 = document.createElement('p');
        dateElement.className           = 'post-date';


        // Botões
        let optionElement               = document.createElement('post-option');
        optionElement.className         = 'post-option';


        // Botão opção (ainda sem)
        let nada                        = document.createElement('div');
        // 


        // Like
        let likeAreaElement             = document.createElement('div');
        likeAreaElement.className       = 'like-area';

        let btnLikeElement              = document.createElement('button');
        btnLikeElement.id               = 'btn-like';

        let likeIconElement             = document.createElement('img');
        likeIconElement.alt             = 'Curtida';
        likeIconElement.title           = 'Curtida'; 

        let likeAmountElement           = document.createElement('p');
        likeAmountElement.className     = 'like-amount';


        //
        picAreaElement.appendChild(picElement);

        infoAreaElement.appendChild(descriptionElement);
        infoAreaElement.appendChild(dateElement);
        
        optionElement.appendChild(nada);
        optionElement.appendChild(likeAreaElement);

        likeAreaElement.appendChild(btnLikeElement);
        likeAreaElement.appendChild(likeAmountElement);

        btnLikeElement.appendChild(likeIconElement);

        cardElement.appendChild(picAreaElement);
        cardElement.appendChild(infoAreaElement);
        cardElement.appendChild(optionElement);


        // Informações do Post
        picAreaElement.href                = link;
        picElement.alt                  = name;
        picElement.src                  = imgSrc;
        descriptionElement.innerText    = description;
        dateElement.innerText           = date;

        btnLikeElement.className        = 'like-icon';
        likeIconElement.src             = likeIcon;
        likeAmountElement.innerText     = likeAmount;

        return cardElement;
    }
});
$(document).ready(function() {

    // Botão Seguir
    let btnFollowElement = document.querySelector('.btn-follow');

    btnFollowElement.addEventListener('click', () => {

        if(btnFollowElement.id == 'btn-seguir') {
            startFollowing(btnFollowElement);
        } else {
            stopFollowing(btnFollowElement);
        }
    })

    function startFollowing(btn) {
        btn.innerText = 'Seguindo';
        btn.id = 'btn-deixar-seguir';
    }

    function stopFollowing(btn) {
        btn.innerText = 'Seguir';
        btn.id = 'btn-seguir';
    }

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

    // Botão Visibilidade
    let visibilityElement = document.querySelector('.btn-visibility');

    visibilityElement.addEventListener('click', () => {

        if(visibilityElement.id == "btn-ativar-visibilidade") {
            setPrivacyPublic(visibilityElement)
        } else {
            setPrivacyPrivate(visibilityElement)
        }
    })

    function setPrivacyPublic(btn) {
        document.querySelector('#visibility-icon').src = "assets/img/icon/visibility-open.png";
        document.querySelector('#visibility-description').innerText = 'Informações visíveis';
        btn.id = 'btn-desativar-visibilidade';
    }

    function setPrivacyPrivate(btn) {
        document.querySelector('#visibility-icon').src = "assets/img/icon/visibility-close.png";
        document.querySelector('#visibility-description').innerText = 'Informações ocultadas';
        btn.id = 'btn-ativar-visibilidade';
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

    // Botão Opções da Postagem

    // Botão Like
    refreshLikeFunction();

    function refreshLikeFunction() {
        var likeBtnsAll = document.getElementsByClassName('like-icon');
        var likeBtns = [];

        for(btn of likeBtnsAll) {
            likeBtns.push(btn);
        }

        likeBtns.map((btn) => {
            btn.addEventListener('click', () => {
                if(btn.className == 'like-icon') {
                    giveLike(btn);
                } else {
                    removeLike(btn);
                }
            });
        });
    }

    function giveLike(btn) {
        let likeAmountArea;
        let index = [];

        if(btn.childNodes[1]) {
            // Indexes 1-13 e 0-1 representam a ordem de parentesco
            // No post original, a imagem e o número de likes são os filhos 1 e 13 da div
            // Enquanto nos posts adicionados pelo botão tem como filho nas posições 0 e 1
            index = [1, 13];
        } else {
            index = [0, 1];
        }

        // Basicamente isso aumenta o número dos likes em 1
        btn.childNodes[index[0]].src = 'assets/img/icon/paw-like-set.png';
        likeAmountArea = btn.parentNode.childNodes[index[1]];
        likeAmountArea.innerText = Number(likeAmountArea.innerText) + 1;
        
        animateLike(btn, 'like-icon-set');
    }

    function removeLike(btn) {
        if(btn.childNodes[1]) {
            index = [1, 13];
        } else {
            index = [0, 1];
        }

        // Aqui diminui o número de likes em 1
        btn.childNodes[index[0]].src = 'assets/img/icon/paw-like-unset.png';
        likeAmountArea = btn.parentNode.childNodes[index[1]];
        likeAmountArea.innerText = Number(likeAmountArea.innerText) - 1;

        
        animateLike(btn, 'like-icon');
    }

                 // Elemento |  ID  | Classe a ser editada
    function animateLike(btn, btnID) {
        let i;

        if(btn.childNodes[1]) {
            i = 1;
        } else {
            i = 0;
        }

        btn.childNodes[i].style.width = '50%';
        btn.childNodes[i].style.height = '100%';
        setTimeout(function() {
            btn.childNodes[i].style.width = '24px';
            btn.childNodes[i].style.height = '24px';
            btn.className = btnID;
        }, 50);
    }

    // Botão Mais Postagens
    let btnMorePosts = document.querySelector('#btn-exibir-mais');
    
    btnMorePosts.addEventListener('click', () => {
        let postArea = document.querySelector('#menu-post');
        postArea.removeChild(btnMorePosts);

        let posts = []
                        // nome                 imagem                           descrição               data    like-icon ou like-icon-unset    paw-like-set ou unset,  qtd de likes
        posts.push(newPost('NOME DA POSTAGEM', 'assets/img/cachorro_login.png', 'DESCRIÇÃO DA POSTAGEM', '10/04/2021', 'like-icon', 'assets/img/icon/paw-like-unset.png', '10'));
        posts.push(newPost('NOME DA POSTAGEM', 'assets/img/cachorro_login.png', 'DESCRIÇÃO DA POSTAGEM', '10/04/2021', 'like-icon', 'assets/img/icon/paw-like-unset.png', '10'));
        posts.push(newPost('NOME DA POSTAGEM', 'assets/img/cachorro_login.png', 'DESCRIÇÃO DA POSTAGEM', '10/04/2021', 'like-icon', 'assets/img/icon/paw-like-unset.png', '10'));
        
        for(post of posts) {
            postArea.appendChild(post);
        }
        refreshLikeFunction();
        
        postArea.appendChild(btnMorePosts);
    })

    function newPost(name, imgSrc, description, date, btnLikeClass, likeIcon, likeAmount) {
        let cardElement                 = document.createElement('div');
        cardElement.className           = 'post-card';
    
        // Elementos do Post
        let picAreaElement              = document.createElement('div');
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
        picElement.alt                  = name;
        picElement.src                  = imgSrc;
        descriptionElement.innerText    = description;
        dateElement.innerText           = date;

        btnLikeElement.className        = btnLikeClass;
        likeIconElement.src             = likeIcon;
        likeAmountElement.innerText     = likeAmount;

        return cardElement;
    }
});
$(document).ready(function() {

    // Botão Seguir
    let btnFollowElement = document.querySelector('.btn-follow');

    btnFollowElement.addEventListener('click', () => {

        if(btnFollowElement.id == 'btn-seguir') {
            btnFollowElement.innerText = 'Seguindo'
            btnFollowElement.id = 'btn-deixar-seguir'
        } else {
            btnFollowElement.innerText = 'Seguir'
            btnFollowElement.id = 'btn-seguir'
        }
    })

    // Botão Opções do Usuário
    let btnOptionArray = document.getElementsByClassName('btn-option');

    for(let i = 0; i < btnOptionArray.length; i++) {
        btnOptionArray[i].addEventListener('click', () => {

            if(btnOptionArray[i]) {
                let menu = document.getElementsByTagName('ul')[i];
    
                if(menu.className == 'option-dropdown') {
                    menu.className = 'option-dropdown-close';
                } else {
                    let alreadyPoppedUp = document.querySelector('.option-dropdown');
                    if(alreadyPoppedUp) {
                        alreadyPoppedUp.className = 'option-dropdown-close';
                    }
                    menu.className = 'option-dropdown';
                }
            }

        })
    }

    // Botão Visibilidade
    let visibilityElement = document.querySelector('.btn-visibility');

    visibilityElement.addEventListener('click', () => {

        if(visibilityElement.id == "btn-ativar-visibilidade") {
            document.querySelector('#visibility-icon').src = "assets/img/icon/visibility-open.png";
            document.querySelector('#visibility-description').innerText = 'Informações visíveis';
            visibilityElement.id = 'btn-desativar-visibilidade';
        } else {
            document.querySelector('#visibility-icon').src = "assets/img/icon/visibility-close.png";
            document.querySelector('#visibility-description').innerText = 'Informações ocultadas';
            visibilityElement.id = 'btn-ativar-visibilidade';
        }
    })

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
    let likeBtn = document.querySelector('.like-icon');
    
    likeBtn.addEventListener('click', () => {
        if(likeBtn.className == 'like-icon') {
            document.querySelector('.like-icon img').src = 'assets/img/icon/paw-like-set.png';
            document.querySelector('.like-icon img').style.width = '50%';
            document.querySelector('.like-icon img').style.height = '100%';
            setTimeout(function() {
                document.querySelector('.like-icon img').style.width = '24px';
                document.querySelector('.like-icon img').style.height = '24px';
                likeBtn.className = 'like-icon-set'
            }, 50);
            
        } else {
            document.querySelector('.like-icon-set img').src = 'assets/img/icon/paw-like-unset.png';
            document.querySelector('.like-icon-set img').style.width = '50%';
            document.querySelector('.like-icon-set img').style.height = '100%';
            setTimeout(function() {
                document.querySelector('.like-icon-set img').style.width = '24px';
                document.querySelector('.like-icon-set img').style.height = '24px';
                likeBtn.className = 'like-icon'
            }, 50);
        }
    })

    // Botão Mais Postagens
});
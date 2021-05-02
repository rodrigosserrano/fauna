$(document).ready(function() {

    // Botão Seguir
    let btnFollowElement = document.querySelector('.btn-follow');

    btnFollowElement.addEventListener('click', () => {

        if(btnFollowElement.id == 'btn-seguir') {
            btnFollowElement.style.backgroundColor = '#829D6C';
            btnFollowElement.innerText = 'Seguindo'
            btnFollowElement.id = 'btn-deixar-seguir'
        } else {
            btnFollowElement.style.backgroundColor = '#A1C087';
            btnFollowElement.innerText = 'Seguir'
            btnFollowElement.id = 'btn-seguir'
        }
    })

    // Botão Opções do Usuário

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
            document.querySelector('.profile-option-selected').className = 'profile-option'
            tab.className = 'profile-option-selected'
        }
    }

    // Botão Opções da Postagem

    // Botão Like

    // Botão Mais Postagens
});
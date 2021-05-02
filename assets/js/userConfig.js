$(document).ready(function() {

    let configDadosTab      = document.querySelector('#config-dados-tab')
    let configPetTab        = document.querySelector('#config-pet-tab')
    let configExcluirTab    = document.querySelector('#config-excluir-tab')

    configDadosTab.addEventListener('click', () => {
        selectTab(configDadosTab)
    })

    configPetTab.addEventListener('click', () => {
        selectTab(configPetTab)
    })

    configExcluirTab.addEventListener('click', () => {
        selectTab(configExcluirTab)
    })

    function selectTab(tab) {
        if(tab.className == 'config-option active') {
            document.querySelector('.config-option-selected').className = 'config-option'
            tab.className = 'config-option-selected'
        }
    }

    let selectElement = document.getElementsByTagName('select');

    for(let i = 0; i < selectElement.length; i++) {
        selectElement[i].addEventListener('change', function() {
            selectElement[i].style.color = "#000";
        });
    }
});
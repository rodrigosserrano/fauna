$(document).ready(function() {

    // Tabs
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

    // Cores do Select
    let selectElement = document.getElementsByTagName('select');

    for(let i = 0; i < selectElement.length; i++) {
        selectElement[i].addEventListener('change', function() {
            selectElement[i].style.color = "#000";
        });
    }

    // Imagens
    let inputElements = document.getElementsByTagName('input');
    let imageFileElements = []

    for(input of inputElements) {
        if(input.getAttribute('type') == 'file') {
            imageFileElements.push(input);
        }
    }

    // Troca de imagens
    for(let index = 0; index < imageFileElements.length; index++) {
        imageFileElements[index].addEventListener('change', () => {

            if(imageFileElements[index].files[0]) {
                var reader = new FileReader();

                reader.addEventListener('load', (event) => {
                    let imageElement = document.getElementsByClassName('form-pic')[index].childNodes[1];
                    imageElement.src = event.target.result;
                    console.log(imageElement);
                });
                reader.readAsDataURL(imageFileElements[index].files[0]);
            }

        })
    }
});
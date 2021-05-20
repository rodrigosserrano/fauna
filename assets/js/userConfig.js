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
                    let imageAreaElement = document.getElementsByClassName('form-pic')[index];
                    let imageElement = imageAreaElement.childNodes[1];

                    if(imageElement.className == 'form-pet-pic' || imageElement.className == 'pic') {
                        imageElement.src = event.target.result;

                        if(imageAreaElement.childNodes[2].innerText == '+') {
                            imageAreaElement.removeChild( imageAreaElement.childNodes[2] );
                        }
                    } else {
                        imageAreaElement.style.backgroundImage = "url('" + event.target.result + "')";
                        imageAreaElement.style.backgroundSize = 'cover';
                        imageAreaElement.style.backgroundRepeat = 'no-repeat';
                        imageAreaElement.style.backgroundPosition = 'center';
                        
                        if(imageAreaElement.childNodes[1].innerText == '+') {
                            imageAreaElement.removeChild( imageAreaElement.childNodes[1] );
                        }
                    }
                });
                reader.readAsDataURL(imageFileElements[index].files[0]);
            }

        })
    }
});
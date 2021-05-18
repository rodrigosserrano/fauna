window.onload = function(){
    $("#telefone").mask('(00) 00000-0000');

    function readImage(file, origin){
        // Check if the file is an image.
        if (file.type && !file.type.startsWith('image/')) {
            console.log('File is not an image.', file.type, file);
            return;
        }

        const reader = new FileReader();
        reader.addEventListener('load', (event) => {
            Array.from(document.querySelectorAll(".file-label")).forEach(el => {
                if(el.getAttribute("for") == origin.getAttribute("id")){
                    let div = el.querySelector("div");

                    div.innerHTML = "";
                    div.style.position = "relative";
                    div.style.overflow = "hidden";

                    div.appendChild(document.createElement("img"));
                    div.querySelector("img").style.relative = "absolute";
                    div.querySelector("img").style.width = "100%";
                    div.querySelector("img").src = event.target.result;
                }
            });
        });
        reader.readAsDataURL(file);
    }

    document.querySelector('#file-input1').addEventListener('input', e => {
        document.querySelector('#user-pic').textContent = e.target.files[0].name;
        readImage(e.target.files[0], e.target);
    });
    document.querySelector('#file-input2').addEventListener('input', e => {
        document.querySelector('#pet-pic').textContent = e.target.files[0].name;
        readImage(e.target.files[0], e.target);
    }); 

    // Forma que achei pra "arrumar" (Seiki)
    // Não é a melhor forma mas foi oq veio na cabeça
    let selectElement = document.getElementsByTagName('select');

    // Usei for assim pois ele consegue diferenciar cada item
    for(let i = 0; i < selectElement.length; i++) {
        selectElement[i].addEventListener('change', function() {
            selectElement[i].style.color = "#000";
        });
    }
}
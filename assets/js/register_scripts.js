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
                    div.querySelector("img").style.height = "100%";
                    div.querySelector("img").style.objectFit = "cover";
                    div.querySelector("img").src = event.target.result;
                }
            });
        });
        reader.readAsDataURL(file);
    }

    document.querySelector('#file-input1').addEventListener('input', e => {
        if(e.target.files[0].name.length > 24) {
            document.querySelector('#user-pic').textContent = `${e.target.files[0].name.substring(0, 24)}...`;
        } else {
            document.querySelector('#user-pic').textContent = e.target.files[0].name;
        }
        readImage(e.target.files[0], e.target);
    });
    document.querySelector('#file-input2').addEventListener('input', e => {
        if(e.target.files[0].name.length > 24) {
            document.querySelector('#pet-pic').textContent = `${e.target.files[0].name.substring(0, 24)}...`;
        } else {
            document.querySelector('#pet-pic').textContent = e.target.files[0].name;
        }
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

    const selects = Array.from(document.getElementsByTagName("select"))
            
    selects.forEach(select => {
        let options = Array.from(select.querySelectorAll("option"))
        select.addEventListener("change", e => {
            options.forEach(opt => {
                let optText = opt.textContent
                if(opt.value == e.target.value){
                    if(optText == "Gênero" || optText == "Tipo de animal")
                        e.target.style.color = "#777"
                    else
                        e.target.style.color = "#000"
                }
                opt.style.color = "#777"
            })
        })
    })

    const dateElement = document.querySelector('#birth_date');

    dateElement.addEventListener("focus", e => {
        e.target.setAttribute("type", "date")
    })
    dateElement.addEventListener("blur", e => {
        if(e.target.value == "")
            e.target.setAttribute("type", "text")
    })

    dateElement.addEventListener('input', e => {
        e.target.style.color = 'black';
    })
}
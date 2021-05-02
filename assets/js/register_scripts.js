window.onload = function(){
$("#telefone").mask('(00) 00000-0000');

function readImage(file){
    // Check if the file is an image.
    if (file.type && !file.type.startsWith('image/')) {
        console.log('File is not an image.', file.type, file);
        return;
    }

    const reader = new FileReader();
    reader.addEventListener('load', (event) => {
        Array.from(document.querySelectorAll(".file-label")).forEach(el => {
            let div = el.querySelector("div");
            div.innerHTML = "";
            div.style.position = "relative";
            div.style.overflow = "hidden";

            div.appendChild(document.createElement("img"));
            div.querySelector("img").style.relative = "absolute";
            div.querySelector("img").style.width = "100%";
            div.querySelector("img").src = event.target.result;
        });
    });
    reader.readAsDataURL(file);
}

document.querySelector('#file-input1').addEventListener('input', e => {
    document.querySelector('#user-pic').textContent = e.target.files[0].name;
    readImage(e.target.files[0]);
});
document.querySelector('#file-input2').addEventListener('input', e => {
    /*document.querySelector('#pet-pic').style.maxWidth = "150px";
    document.querySelector('#pet-pic').style.overflow = "hidden";*/
    document.querySelector('#pet-pic').textContent = e.target.files[0].name;
    readImage(e.target.files[0]);
}); 
}
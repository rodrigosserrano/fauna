$(document).ready(function() {

    // Testem dps
    function alertFunc(message) {
        var alertBox = document.createElement('div')
        alertBox.setAttribute('class', 'alertMsg')
        alertBox.appendChild(document.createTextNode(message))
        document.querySelector('.alertArea').appendChild(alertBox);
        setTimeout(function() { document.querySelector('.alertArea').removeChild(alertBox) }, 4000)
    }

    // document.querySelector('#btn-login').addEventListener('click', () => {
    //     alertFunc('Testem ae dps')
    // })
    // 
});
// COOKIES
function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
}

// CHANGEMENT DE THÈME
window.onload = function () { fetchColorTheme(); };

// event listeners
document.getElementById("btn_r").addEventListener("click", redTheme);
document.getElementById("btn_g").addEventListener("click", greenTheme);
document.getElementById("btn_b").addEventListener("click", blueTheme);
document.getElementById("email").addEventListener("change", removeErrorEmail);

if (document.getElementById("f_inscription"))
    window.addEventListener("load",errorFormInscription);

let form = document.getElementById("f_inscription").querySelectorAll('input[type=password]');
for (let i = 0; i < form.length; i++) {
    form[i].addEventListener("change", removeErrorPassword);
}

function removeErrorEmail() {
    document.getElementById('email').classList.remove("red_text_Form");
    document.getElementById('email').placeholder = "Adresse electronique";
}

function removeErrorPassword(){
    let form = document.getElementById("f_inscription").querySelectorAll('input[type=password]');
    for (let i = 0; i < form.length; i++) {
        if (i == 0)
            form[i].placeholder = 'Mot de passe';
        else if (i == 1)
            form[i].placeholder = 'Confirmer le mot de passe';
        form[i].classList.remove('red_text_Form');
    }
}

function redTheme() {
    let bodyTag = document.getElementsByTagName("body")[0];

    bodyTag.classList.remove("blue_theme");
    bodyTag.classList.remove("green_theme");

    setCookie("colorTheme", 0, 365);
}

function greenTheme() {
    let bodyTag = document.getElementsByTagName("body")[0];

    bodyTag.classList.remove("blue_theme");
    bodyTag.classList.add("green_theme");
    setCookie("colorTheme", 1, 365);
}

function blueTheme() {
    let bodyTag = document.getElementsByTagName("body")[0];

    bodyTag.classList.add("blue_theme");
    bodyTag.classList.remove("green_theme");

    setCookie("colorTheme", 2, 365);

}

function fetchColorTheme() {
    let cookie = getCookie("colorTheme");

    if (cookie == 1) {
        greenTheme();
    } 
    else if (cookie == 2) {
        blueTheme();
    }
    else {
        redTheme();
    }
}

function errorFormInscription() {
    
   if(document.getElementById("f_inscription")){
        if (document.getElementById("f_inscription").classList.contains("error1"))
        {
            document.getElementById('email').placeholder = 'Le courriel que vous avez entrée est déjà utilisé';
            document.getElementById('email').classList.add('red_text_Form');
        } 
        else if (document.getElementById("f_inscription").classList.contains("error2")){
           
            let form = document.getElementById("f_inscription").querySelectorAll('input[type=password]');
            for (let i = 0; i < form.length; i++) {
                form[i].placeholder = 'Erreur lors de la confirmation du mot de passe';
                form[i].classList.add('red_text_Form');
            }
        }
        else {
            let form = document.getElementById("f_inscription").querySelectorAll('input[type=password]');
            for (let i = 0; i < form.length; i++) {
                form[i].placeholder = 'Erreur lors de la confirmation du mot de passe';
                form[i].classList.remove('red_text_Form');
            }
            document.getElementById('email').classList.remove('red_text_Form');
        }
    }
}


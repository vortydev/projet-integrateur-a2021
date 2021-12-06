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


function redTheme() {
    let bodyTag = document.getElementsByTagName("body")[0];
    document.getElementById("csLogo").src='./img/logoR.png';

    bodyTag.classList.remove("blue_theme");
    bodyTag.classList.remove("green_theme");

    setCookie("colorTheme", 0, 365);
}

function greenTheme() {
    let bodyTag = document.getElementsByTagName("body")[0];
    document.getElementById("csLogo").src='./img/logoG.png';

    bodyTag.classList.remove("blue_theme");
    bodyTag.classList.add("green_theme");

    setCookie("colorTheme", 1, 365);
}

function blueTheme() {
    let bodyTag = document.getElementsByTagName("body")[0];
    document.getElementById("csLogo").src='./img/logoB.png';

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

//Event listener des elements relier au form d'inscription et au form de connexion 

if (document.getElementById("f_connexion")) {
    window.addEventListener("load", errorFormConnexion);

    let input = document.getElementsByTagName('input');
    for (let i = 0; i < input.length; i++ )
        input[i].addEventListener("mouseover",removeErrorConnexion);
}

if (document.getElementById("f_inscription")) {
    
    window.addEventListener("load",errorFormInscription);

    document.getElementById("email").addEventListener("mouseover", removeErrorEmail);
    
    let form = document.getElementById("f_inscription").querySelectorAll('input[type=password]');
    for (let i = 0; i < form.length; i++) {
        form[i].addEventListener("mouseover", removeErrorPassword);
    }
}

//Fonction d'erreur pour le form inscription
 
function errorFormInscription() {
    
    let form = document.getElementById("f_inscription").querySelectorAll('input[type=password]');

   if(document.getElementById("f_inscription")){
        
    if (document.getElementById("f_inscription").classList.contains("error1"))
        {
            document.getElementById('email').placeholder = 'Le courriel que vous avez entrée est déjà utilisé';
            document.getElementById('email').classList.add('red_text_Form');
        } 
        else if (document.getElementById("f_inscription").classList.contains("error2")){
           
            for (let i = 0; i < form.length; i++) {
                form[i].placeholder = 'Erreur lors de la confirmation du mot de passe';
                form[i].classList.add('red_text_Form');
            }
        }
        else if(document.getElementById("f_inscription").classList.contains("error3")){
            
            for (let i = 0; i < form.length; i++) {

                form[i].placeholder = 'Le mot de passe doit posseder 8 caracteres';
                form[i].classList.add('red_text_Form');
            }

        }
    }
}



function removeErrorPassword(){
    let form = document.getElementById("f_inscription").querySelectorAll('input[type=password]');

    if(document.getElementById("f_inscription").classList.contains('error2'))
        document.getElementById("f_inscription").classList.contains('error2');

    if(document.getElementById("f_inscription").classList.contains('error3'))
        document.getElementById("f_inscription").classList.contains('error3');

    for (let i = 0; i < form.length; i++) {
        if (i == 0)
            form[i].placeholder = 'Mot de passe';
        else if (i == 1)
            form[i].placeholder = 'Confirmer le mot de passe';
        form[i].classList.remove('red_text_Form');
    }
}

function removeErrorEmail() {
    document.getElementById('email').classList.remove("red_text_Form");

    if (document.getElementById('email').classList.contains('error1'))
        document.getElementById('email').classList.remove('error1');

    document.getElementById('email').placeholder = "Adresse electronique";
}


//fonction relier au erreur de connexion 

function errorFormConnexion() {
  
    let input = document.getElementsByTagName("input");


    if (document.getElementById("f_connexion").classList.contains("error")){
    
        for (let i = 0; i < input.length; i++) {
           input[i].classList.add("red_text_Form");
           input[i].placeholder = "Veuillez essayez de nouveau";
        }
    }
}


function removeErrorConnexion() {
    let input = document.getElementsByTagName('input');
    for (let i = 0; i < input.length; i++) {
        input[i].classList.remove("red_text_Form");
        if (i == 1)
            input[i].placeholder = 'Votre adresse electronique';
        else if (i == 2)
            input[i].placeholder = 'Mot de passe'; 
    }
}


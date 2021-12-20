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

//event listener relier a la page de creation de configuration

if(document.getElementById("creationConfig")) {
   let btn = document.getElementsByTagName('button');
   
   for (let i = 0 ; i < btn.length;i++)
    {
        btn[i].addEventListener("click",printChoice);
    }
}

//fonction relier a la page de creation

function printChoice(event) { 
   
  let choice = event.target.nextElementSibling;
  choice.classList.toggle('hidden');
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

    document.getElementById('email').placeholder = "Adresse électronique";
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
            input[i].placeholder = 'Votre adresse électronique';
        else if (i == 2)
            input[i].placeholder = 'Mot de passe'; 
    }
}

// BOUTON DE SUPRESSION DE CONFIGURATION CLIENT
annuleBtn = document.querySelectorAll(".btn_delete_config");
annuleBtn.forEach(btn => {
    btn.addEventListener("click", function(e) {
        e.preventDefault();
        if (confirm("Êtes-vous certain de vouloir supprimer cette configuration?")) {;
            e.target.parentElement.submit(); 
        }
    });
})

// ANIMATION DES CONFIGURATIONS
let config = document.querySelectorAll(".config");
updateConfigsShown();

window.addEventListener("scroll", function() {  updateConfigsShown(); }, false);

function updateConfigsShown() {
    for (let i = 0; i < config.length; i++) {
        if (elementInView(config[i])) {
            appearRes(config[i], i);
        }
        else {
            disappearRes(config[i]);
        }
    }
}

function elementInView(e) {
    return (e.getBoundingClientRect().top <= window.screen.height) && (e.getBoundingClientRect().bottom > 0);
}

function disappearRes(r) {
    r.classList.add("disappear");
    r.classList.remove("appear");
}

function appearRes(r, i) {
    r.classList.remove("disappear");
    r.classList.add("appear");
}

/*fonction et event listener relie a au choix du chef */


let btn_CDC = document.getElementsByClassName("btn_CDC");
for (let i = 0;i < btn_CDC.length;i++) {
    btn_CDC[i].addEventListener('click', changementDescription);
}

function changementDescription(e) {
    let divAside = document.getElementsByClassName('CDC')[0].getElementsByTagName('aside')[0].getElementsByTagName('div');
    for (let i = 0 ; i < divAside.length;i++) {
        if(!divAside[i].classList.contains('hidden'))
            divAside[i].classList.add('hidden');
    }

    if(e.target.classList.contains("btn_cooler")) {
        document.getElementsByClassName('cooler')[0].classList.remove('hidden');
    }
    else if(e.target.classList.contains("btn_memoirevive")) {
        document.getElementsByClassName('memoirevive')[0].classList.remove('hidden');
    }
    else if(e.target.classList.contains("btn_processeur")) {
        document.getElementsByClassName('processeur')[0].classList.remove('hidden');
    }
    else if(e.target.classList.contains("btn_supportstockage1")) {
        document.getElementsByClassName('support1')[0].classList.remove('hidden');
    }
    else if(e.target.classList.contains("btn_supportstockage2")) {
        document.getElementsByClassName('support2')[0].classList.remove('hidden');
    }
    else if(e.target.classList.contains("btn_boitier")) {
        document.getElementsByClassName('boitier')[0].classList.remove('hidden');
    }
    else if(e.target.classList.contains("btn_cartegraphique")) {
        document.getElementsByClassName('cartegraphique')[0].classList.remove('hidden');
    }
    else if(e.target.classList.contains("btn_cartemere")) {
        document.getElementsByClassName('cartemere')[0].classList.remove('hidden');
    }
}
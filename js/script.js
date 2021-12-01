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
document.getElementById("error1").addEventListener("load", error1);
document.getElementById("error2").addEventListener("load",error2);

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

function error1() {
    document.getElementById('email').insertAdjacentHTML("afterend",'<p style="color:white" >Le courriel que vous avez entree est deja utilise</p>')
}

function error2() {
    document.getElementsByName('password').insertAdjacentHTML("afterend",'<p style="color:white" >Le mot de passe de confirmation n est pas le meme que celui choisie initialement</p>');
}
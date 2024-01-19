let mostrador = document.getElementById("mostrador");
let seleccion = document.getElementById("seleccion");
let imgS = document.getElementById("img");
let modeloS = document.getElementById("modelo");
let descripcionS = document.getElementById("descripcion");
let precioS = document.getElementById("precio");

function cargar(item){
    quitarBorde();
    mostrador.style.width = "75%";
    seleccion.style.width = "25%";
    seleccion.style.height = "95%";
    seleccion.style.opacity = "1";
    item.style.border = ".25em solid gold";

    imgS.src = item.getElementsByTagName("img") [0].src;
    modeloS.innerHTML = item.getElementsByTagName("h2")[0].innerHTML;
    descripcionS.innerHTML = item.getElementsByTagName("p")[0].innerHTML;
    precioS.innerHTML = item.getElementsByTagName("span")[0].innerHTML;
}

function quitarBorde(){
    var items = document.getElementsByClassName("item");
    for(i=0; i<items.length; i++){
        items[i].style.border = "none";
    }
}

function cerrar(){
    mostrador.style.width = "100%";
    seleccion.style.width = "0";
    seleccion.style.height = "0";
    seleccion.style.opacity = "0";
    quitarBorde();
}
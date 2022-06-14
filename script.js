function PosmotretDannye() {
    if("savedData" in localStorage) { // Вывод сохраненных данных, если они есть
        document.getElementById("savedContent").innerHTML = decodeURI(localStorage.getItem("savedData"));
        localStorage.setItem("savedData", document.getElementById("content").innerHTML); 
    }
    else {
        document.getElementById("savedContent").innerHTML = "No saved content";

    }
}
function SaveDannye() {
    localStorage.setItem("savedData", document.getElementById("content").innerHTML);
}
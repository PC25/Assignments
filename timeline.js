function loadDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("button").innerHTML = this.responseText;
    }
    };
    xhttp.open("GET", "available.php", true);
    xhttp.send();
}
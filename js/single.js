let komentar=document.querySelector("#komentar");
let informacija=document.querySelector("#informacija");
function prikaziFormu(){
    let a=document.querySelector("#toggle");
    let forma=document.querySelector("#forma");
    if(a.checked) {
        forma.style.display="";
        komentar.value="";
        informacija.innerHTML="";
    }
    else forma.style.display="none";
}

function proveriFormu() {
    if(komentar.value=="") {
        informacija.innerHTML="Unesite komentar";
        komentar.focus();
        return false;
    }
    informacija.innerHTML="";
}
function kupi(idProizvoda){
    $.post("ajax/ajax_proizvodi.php", {idProizvoda:idProizvoda}, function(response){
        korpabroj();
        alert(response);
    })
}

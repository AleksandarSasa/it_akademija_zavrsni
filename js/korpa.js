$(document).ready(function () {
    napraviKorpu();
    napraviKupljene();
  });

function napraviKorpu(){
    $.get("ajax/ajax_korpa.php?funkcija=napraviKorpu", function(response){
        $("#korpa").html(response);
    })
}
function napraviKupljene(){
    $.get("ajax/ajax_korpa.php?funkcija=napraviKupljene", function(response){
        $("#kupljeni").html(response);
    })
}

function kupi(id){
    $.get("ajax/ajax_korpa.php?funkcija=kupi", {id:id}, function(response){
        napraviKorpu();
        napraviKupljene();
        korpabroj();
        alert(response);
    })
}

function obrisi(id){
    $.get("ajax/ajax_korpa.php?funkcija=obrisi", {id:id}, function(response){
        napraviKorpu();
        korpabroj();
        alert(response);
    })
}

function kupiSve(){
    $.get("ajax/ajax_korpa.php?funkcija=kupiSve", function(response){
        napraviKorpu();
        napraviKupljene();
        korpabroj();
        alert(response);
    })
}
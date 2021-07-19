function korpabroj(){
    $.get("ajax/ajax_korpa.php?funkcija=korpabroj", function(response){
        $("#korpabroj").html(response);
    })
}
korpabroj();
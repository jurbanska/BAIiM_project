// API

function login(){
    var uname = document.getElementById("uname").value;
    var passw = document.getElementById("passw").value;

    var dat = {'username':uname, 'password':passw};

    $.ajax('/api/v1.0/storeLoginAPI/',{
        method: 'POST',
        data: JSON.stringify(dat),
        dataType: "json",
        contentType: "application/json",
    }).done(function(res){

      if (res['status'] == 'success'){
        $("#stat").html('<b>Pomyślnie zalogowano<b>');
      }
      else{
        $("#stat").html('<b>Logowanie nie powiodło się</b>');
      }

    }).fail(function(err){
        $("#stat").html('<b>Coś poszło nie tak..</b>\n' + err);
    });
}

function search(){
    var item = document.getElementById("searchItem").value;

    $.ajax('/api/v1.0/storeAPI/'+item,{
        method: 'GET',
    }).done(function(res){

        $(".res").remove(); //remove previous results

        $(res).each(function(){
            var r = "<tr class='res'><td>"+this['name']+"</td>";
            r += "<td>"+this['quantity']+"</td>";
            r += "<td>"+this['price']+"</td></tr>";
            $("#results").append(r);
        });

    }).fail(function(err){
        $("#stat").html(err);
    });
}

function addItem(){
    var name = document.getElementById("itemName").value;
    var quan = document.getElementById("itemQuantity").value;
    var price = document.getElementById("itemPrice").value;

    var dat = {'name':name, 'quantity':quan, 'price':price};

    $.ajax('/api/v1.0/storeAPI',{
        method: 'POST',
        data: JSON.stringify(dat),
        dataType: "json",
        contentType: "application/json",
    }).done(function(res){
        $("#stat").html("Pomyślnie dodano");
    }).fail(function(err){
        $("#stat").html("Błąd przy wysyłaniu żądania");
    });
}

$(document).ready(function(){

    $("#navbar ul li a").on('click', function(event){
        event.preventDefault();
        var page = $(this).attr("href");

        $("#main").load(page);
    });
});

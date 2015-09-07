/**
 * IMPORTANTE
 * Esto hay que mergearlo en main.js MANUALMENTE
 * Hecho aparte para evitar conflictos si alguien estuvo modificando main.js
 */

$(document).ready(function(){

    $('#modifyConfigurationBtn').click(modifyWallConfiguration);
    $('#addItemList-1').click(addItemList1);
    $('#addItemList-2').click(addItemList2);

});

function addItemList1(event){
    event.preventDefault();
    var user = $("#item-opt-1").val();

    $(".list-1").append("<li class='list-group-item'>"+ user +"</li>");
}

function addItemList2(event){
    event.preventDefault();
    var user = $("#item-opt-2").val();

    $(".list-2").append("<li class='list-group-item'>"+ user +"</li>");
}

function modifyWallConfiguration(event){
    event.preventDefault();
    var data = {};
    var user;
    var users = [];

    data.opt = $('input:radio[name="optradio"]:checked').val();

    if(data.opt == "opt-1")
    {
        $( ".list-1 li" ).each(function(){
            user = $(this).text();
            users.push(user);
        });

        data.users = users;
    }else if(data.opt == "opt-2")
    {
        $( ".list-2 li" ).each(function(){
            user = $(this).text();
            users.push(user);
        });

        data.users = users;
    };

    var dataJSON = JSON.stringify(data);

    $.post( "php/controllers/configWallCtrl.php",
        { data : dataJSON },
        function(data){
            console.log(data);
        } );
}

/**
 * IMPORTANTE
 * Esto hay que mergearlo en main.js MANUALMENTE
 * Hecho aparte para evitar conflictos si alguien estuvo modificando main.js
 */

$(document).ready(function(){

    $('#modifyConfigurationBtn').click(modifyWallConfiguration);
    $('#addItemList-1').click(addItemList1);
    $('#addItemList-2').click(addItemList2);

    $('#modalMessages').modal({
        show: false
    });

});

function addItemList1(event){
    event.preventDefault();
    var user = $("#item-opt-1").val();

    $.post( "php/controllers/verifyUserCtrl.php",
        { userName : user },
        function(data){
            console.log(data);
            var data = JSON.parse(data);

            if(data.valid == true){
                $(".list-1").append("<li class='list-group-item'>"+ user +
                    "<button type='button' class='btn btn-default btn-sm'>" +
                "<span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button>" +
                    "</li>");
            }
            else{
                console.log(data.errorMsg);
                $('#modalMessages').find('.modal-body').html(data.errorMsg);
                $('#modalMessages').modal('toggle');
            };
        } );
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
            location.reload();
        } );
}

/**
 * IMPORTANTE
 * Esto hay que mergearlo en main.js MANUALMENTE
 * Hecho aparte para evitar conflictos si alguien estuvo modificando main.js
 */

$(document).ready(function(){

    $('#modifyConfigurationBtn').click(modifyWallConfiguration);
    $('#addItemList-1').click(addItemList1);
    $('.removeItemList-1').click(removeItemList1);
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
                    "<button type='button' class='btn btn-danger btn-sm pull-right removeItemList-1' id=''>" +
                "<span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button>" +
                    "</li>");

                $('.removeItemList-1').click(removeItemList1);
            }
            else{
                console.log(data.errorMsg);
                $('#modalMessages').find('.modal-title').html("OH NO!");
                $('#modalMessages').find('.modal-body').html(data.errorMsg)
                $('#modalMessages').find('.modal-footer').html("");
                $('#modalMessages').modal('toggle');
            };
        } );
}

function removeItemList1() {
    var li = $(this).parent();
    var user = li.text();
    $('#modalMessages').find('.modal-title').html("ATENCIÓN!!!");
    $('#modalMessages').find('.modal-body').html("¿Está seguro de que desea eliminar a <span id='"+user+"'>" + user + "</span> de su lista?");
    $('#modalMessages').find('.modal-footer').html("<button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>" +
                                                    "<button type='button' class='btn btn-primary' id='confirmRemoveUserBtn'>Aceptar</button>");
    $('#modalMessages').modal('toggle');

    $("#confirmRemoveUserBtn").click(function(){
        var modal = $(this).parent().parent();
        var span = modal.find(".modal-body").find("span");
        var userNameRemove = span.attr("id").trim();


        $.post( "php/controllers/wallCtrl.php",
            { action : "remove", userNameRemove : userNameRemove},
            function(data){
                console.log(data);

                var data = JSON.parse(data);

                if(data.valid == true){
                    location.reload();
                }
                else{
                    $('#modalMessages').find('.modal-title').html("OH NO!");
                    $('#modalMessages').find('.modal-body').html(data.errorMsg)
                    $('#modalMessages').find('.modal-footer').html("");
                    $('#modalMessages').modal('show');
                };
            } );
    });
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

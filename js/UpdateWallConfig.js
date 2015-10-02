/**
 * IMPORTANTE
 * Esto hay que mergearlo en main.js MANUALMENTE
 * Hecho aparte para evitar conflictos si alguien estuvo modificando main.js
 */

$(document).ready(function(){

    $('#modifyConfigurationBtn').click(modifyWallConfiguration);
    $('#addItemList-private').click(addItemListPrivate);
    $('.removeItemList-1').click(removeItemList1);
    
    $('#addItemList-semiPrivate').click(addItemListSemiPrivate);
    // $('#privacidad').click(changePrivacity);

    $('#modalMessages').modal({
        show: false
    });

});

function addItemListPrivate(event){
    event.preventDefault();
    var user = $("#item-private").val();

    $.post( "php/controllers/verifyUserCtrl.php",
        { userName : user },
        function(data){
            console.log(data);
            var data = JSON.parse(data);

            if(data.valid == true){
                $(".list-private").append("<li class='list-group-item'>"+ user +
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

function addItemListSemiPrivate(event){
    event.preventDefault();
    var user = $("#item-semiPrivate").val();

    $.post( "php/controllers/verifyUserCtrl.php",
        { userName : user },
        function(data){
            console.log(data);
            var data = JSON.parse(data);

            if(data.valid == true){
                $(".list-semiPrivate").append("<li class='list-group-item'>"+ user +
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

function modifyWallConfiguration(event){
    event.preventDefault();
    var data = {};
    var user;
    var users = [];

    data.opt = $('input:radio[name="optradio"]:checked').val();

    if(data.opt == "private") {
        $( ".list-private li" ).each(function(){
            user = $(this).text();
            users.push(user);
        });

        data.users = users;
    }else if(data.opt == "semiprivate") {
        $( ".list-semiPrivate li" ).each(function(){
            user = $(this).text();
            users.push(user);
        });

        data.users = users;
    };

    var dataJSON = JSON.stringify(data);

    console.log(data);
    $.post( "php/controllers/configWallCtrl.php",
        { data : dataJSON },
        function(data){
            console.log(data);
            location.reload();
        } );
}

// function changePrivacity() {
//     $.post("php/views/userConfigView.php", {change: $(this).val()},
//         function (data)
//         {
//             console.log(data);
//         });
// }
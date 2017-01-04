/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {

    $("#supplier").autocomplete("customer1.php", {
        width: 160,
        autoFill: true,
        mustMatch: true,
        selectFirst: true
    });
    $("#item").autocomplete("stock.php", {
        width: 160,
        autoFill: true,
        mustMatch: true,
        selectFirst: true
    });
    /*$("#item").blur(function () {
        document.getElementById('total').value = document.getElementById('sell').value * document.getElementById('quty').value
    });*/
    $("#item").blur(function() {});
    $("#numLot").focus(function() {
        if ($("#item").val() == "") {
            $("#item").focus();
            $("#numLot").val("");
        }
        if ($("#quty").val() != "") {
           alert('Si vous voulez changer le numéro de lot, Merci de supprimer la quantité déja indiqué');
           $("#quty").focus();
        }
    });
    $("#numLot").blur(function() {
        if ($("#numLot").val() == "") {
            return false;
        }
        $.post('check_numlot.php', {
                numlot: $(this).val(),
                item: $("#item").val()
            },
            function(data) {
                if (!data.exists) {
                    alert("ATTENTION! Aucun(e)(s) " + $("#item").val() + " n'a été ajouté à la base avec ce numéro de lot !!");
                    $("#numLot").val("");
                    $("#stock").val("");
                }
                /*if (data.sell != undefined)
                    $("#0").focus();*/
            }, 'json');
        $.post('check_item_details_numlot.php', {
                stock_name1: $("#item").val(),
                numlot: $(this).val()
            },
            function(data) {
                if (data.stock==0 ) {
                    alert("Stock insuffisant");
                    return false;
                }
                $("#stock").val(data.stock);
                $('#guid').val(data.guid);
                /*if (data.sell != undefined)
                    $("#0").focus();*/
            }, 'json');
        //stock_size();
    });
    /*  $("#supplier").blur(function () {
          $.post('check_customer_details.php', {stock_name1: $(this).val()},
                  function (data) {
                      $("#address").val(data.address);
                      $("#contact1").val(data.contact1);
                      if (data.address != undefined)
                          $("#0").focus();
                  }, 'json');
      });*/
    $('#test1').jdPicker();
    $('#test2').jdPicker();
    var hauteur = 0;
    $('.code').each(function() {
        if ($(this).height() > hauteur)
            hauteur = $(this).height();
    });
    $('.code').each(function() {
        $(this).height(hauteur);
    });
});

//Reset form
$(document).ready(function() {
    $('#Reset').click(function() {
        location.reload();
    });
});

//Press Enter key using cursor focus to next textbox
$(document).ready(function() {
    $('#item').keypress(function(e) {
        if (e.keyCode == 13) {
            $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();
            return false;
        }
    });
});

/*$.validator.setDefaults({
 submitHandler: function() { alert("submitted!"); }
 });*/
$(document).ready(function() {
    document.getElementById('item').focus();
    // validate signup form on keyup and submit
    $("#form1").validate({
        rules: {
            stockid: {
                required: true
            },
            supplier: {
                required: true,
            },
            date: {
                required: true,
            }
        },
        messages: {
            supplier: {
                required: "Veuillez indiquez le fournisseur !"
            },
            stockid: {
                required: "Veuillez entrer l'ID du stock"
            },
            date: {
                required: "Veuillez indiquez la date",
            }
        }
    });

});

function numbersonly(e) {
    var unicode = e.charCode ? e.charCode : e.keyCode
    if (unicode != 8 && unicode != 46 && unicode != 37 && unicode != 27 && unicode != 38 && unicode != 39 && unicode != 40 && unicode != 9) { //if the key isn't the backspace key (which we should allow)
        if (unicode < 48 || unicode > 57)
            return false
    }
}



function remove_row(o) {
    var p = o.parentNode.parentNode;
    p.parentNode.removeChild(p);
}

function add_values() {
    if (unique_check()) {

        if (document.getElementById('edit_guid').value == "") {
            if (document.getElementById('item').value != "" && document.getElementById('quty').value != "" && document.getElementById('numLot').value != "") {

                if (document.getElementById('quty').value != 0) {
                    code = document.getElementById('item').value;
                    quty = document.getElementById('quty').value;
                    disc = document.getElementById('stock').value;
                    item = document.getElementById('guid').value;
                    numLt = document.getElementById('numLot').value;

                    $('<tr id=' + item + '><td><input type=hidden value="' + item + '" id=' + item + 'id ><input type=text name="stock_name[]" value="' + code + '" id=' + item + 'st style="width: 150px" class="round  my_with" readonly="readonly"></td><td><input type=text name=numLot[] readonly="readonly" value="' + numLt + '" id=' + item + 'n class="round  my_with" style="text-align:right;" ></td><td><input type=text name=quty[] readonly="readonly" value="' + quty + '" id=' + item + 'q class="round  my_with" style="text-align:right;" ></td><td><input type=text name=stock[] readonly="readonly" value="' + disc + '" id=' + item + 'p class="round  my_with" style="text-align:right;" ></td><td><input type=button value="" id=' + item + ' style="width:30px;border:none;height:30px;background:url(images/edit_new.png)" class="round" onclick="edit_stock_details(this.id)"  ></td><td><input type=button value="" id=' + item + ' style="width:30px;border:none;height:30px;background:url(images/close_new.png)" class="round" onclick=reduce_balance("' + item + '");$(this).closest("tr").remove(); ></td></tr>').fadeIn("slow").appendTo('#item_copy_final');
                    document.getElementById('quty').value = "";
                    document.getElementById('stock').value = "";
                    document.getElementById('item').value = "";
                    document.getElementById('guid').value = "";
                    document.getElementById('numLot').value = "";
                    document.getElementById('item').focus();
                } else {
                    alert('Veuillez Entrer la Quantité');
                }
            } else {
                alert('Veuillez remplir tout les champs !');
            }
        } else {
            id = document.getElementById('edit_guid').value;
            document.getElementById(id + 'st').value = document.getElementById('item').value;
            document.getElementById(id + 'q').value = document.getElementById('quty').value;
            document.getElementById(id + 'p').value = document.getElementById('stock').value;
            document.getElementById(id + 'n').value = document.getElementById('numLot').value;
            document.getElementById(id + 'id').value = id;
            document.getElementById('quty').value = "";
            document.getElementById('stock').value = "";
            document.getElementById('item').value = "";
            document.getElementById('guid').value = "";
            document.getElementById('edit_guid').value = "";
            document.getElementById('numLot').value = "";
            document.getElementById('item').focus();
        }
    }
}

function edit_stock_details(id) {
    document.getElementById('item').value = document.getElementById(id + 'st').value;
    document.getElementById('quty').value = document.getElementById(id + 'q').value;
    document.getElementById('stock').value = document.getElementById(id + 'p').value;
    document.getElementById('numLot').value = document.getElementById(id + 'n').value;
    document.getElementById('guid').value = id;
    document.getElementById('edit_guid').value = id;

}

function unique_check() {
    var stock_name_values = $("input[name='stock_name[]']").map(function() {
        return $(this).val();
    }).get();
    var numLot_values = $("input[name='numLot[]']").map(function() {
        return $(this).val();
    }).get();
    if (document.getElementById('edit_guid').value == document.getElementById('guid').value) {
        return true;
    } else {
        for (var i = 0; i < stock_name_values.length; i++) {
            if ($("#item").val() == stock_name_values[i] && $("#numLot").val() == numLot_values[i]) {
                alert("Cet Article a été déja ajouté !");
                document.getElementById('item').focus();
                document.getElementById('quty').value = "";
                document.getElementById('stock').value = "";
                document.getElementById('item').value = "";
                document.getElementById('numLot').value = "";
                document.getElementById('guid').value = "";
                document.getElementById('edit_guid').value = "";
                return false;
            }
        }
    }
    return true;
}

function quantity_chnage(e) {
    var unicode = e.charCode ? e.charCode : e.keyCode
    if (unicode != 13 && unicode != 9) {} else {
        add_values();
        document.getElementById("item").focus();
    }
    if (unicode != 27) {} else {
        document.getElementById("item").focus();
    }
}

function stock_size() {
    if (parseFloat(document.getElementById('quty').value) > parseFloat(document.getElementById('stock').value)) {
        document.getElementById('quty').value = parseFloat(document.getElementById('stock').value);
        alert("La quantité que vous avez entré dépasse le stock disponible\nLa quantité a été réduite à " + $("#stock").val() + "KG")
    }
}

function checkValid(form) {
    if ($('#item_copy_final tr').length < 1) {
        alert("Veuillez ajouter un article !");
        document.form1.item.focus();
        return false;
    }
    var r = confirm("Etes-vous sur de vouloir ajouté cette sortie !");
    if (!r) {
        return false;
    }
}

function addValues2() {
    if (document.getElementById('item').value == "") {
        document.getElementById('item').focus();
    } else {
        add_values();
        document.getElementById("item").focus();
    }
}
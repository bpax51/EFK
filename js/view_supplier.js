/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* function deleteall()
{

//var info = 'id=' + movies2;
//var jsonString = JSON.stringify(movies2);
//alert(movies2[0]);
var file1="viewsupplier";
if(confirm("Are you sure you want to delete all records...?"))
{
 $.ajax({
   type: "POST",
   url: "deleteall.php",
   data: {data : file1},
   cache: false,
   success: function(){
sessionStorage.removeItem('checked-checkboxesviewsupplier');
//sessionStorage.removeItem('checked-checkboxesviewsales');
 window.location.href = "view_supplier.php";
 }
});
  $(this).parents(".show").animate({ backgroundColor: "#003" }, "slow")
  .animate({ opacity: "hide" }, "slow");
 }
return false;	 

}*/



var arrCheckedCheckboxes1viewsupplier = [];



function rowselection() {

    if (sessionStorage.getItem('checked-checkboxesviewsupplier') && $.parseJSON(sessionStorage.getItem('checked-checkboxesviewsupplier')).length !== 0) {
        arrCheckedCheckboxes1viewsupplier = $.parseJSON(sessionStorage.getItem('checked-checkboxesviewsupplier'));
        //Convert checked checkboxes array to comma seprated id
        $(arrCheckedCheckboxes1viewsupplier.toString()).prop('checked', true);
    }
}

$(document).ready(function() {

    rowselection();

    $("input:checkbox").change(function() {
        // i++;
        //	var arrCheckedCheckboxes1viewsupplier = [];
        //alert(arrCheckedCheckboxes);
        // Get all checked checkboxes
        var currentId = $(this).attr('id');
        if ($(this).is(':checked')) {
            arrCheckedCheckboxes1viewsupplier.push("#" + currentId);
        } else {
            console.log('came to else condition');
            arrCheckedCheckboxes1viewsupplier = jQuery.grep(arrCheckedCheckboxes1viewsupplier, function(value) {
                return value != "#" + currentId;
            });

        }
        sessionStorage.setItem('checked-checkboxesviewsupplier', JSON.stringify(arrCheckedCheckboxes1viewsupplier));

        // Convert checked checkboxes array to JSON ans store it in session storage
    });
});

<!--
// Nannette Thacker http://www.shiningstar.net
function confirmSubmit() {
    var agree = confirm("Voulez-vous vraiment supprimer ce fournisseur?");
    if (agree)
        return true;
    else
        return false;
}

function confirmDeleteSubmit() {
    var retrievedData = sessionStorage.getItem("checked-checkboxesviewsupplier");
    var movies2 = JSON.parse(retrievedData);
    var flag = movies2.length;

    // alert(flag);
    /*var field = document.forms.deletefiles;
    for (i = 0; i < field.length; i++) {
        if (field[i].checked == true) {
            flag = flag + 1;

        }

    }*/
    if (flag == 0) {
        alert("Vous devez selectionner un fournisseur !");
        return false;
    } else {
        var agree = confirm("Voulez-vous vraiment supprimer les fournisseurs selectionnés ?");
        if (agree) {
            var file1 = "viewsupplier";
            $.ajax({
                type: "POST",
                url: "deleterecords.php",
                data: {
                    data: movies2,
                    file: file1
                },
                cache: false,
                success: function() {
                    sessionStorage.removeItem('checked-checkboxesviewsupplier');
                    window.location.href = "view_supplier.php";
                }
            });
            $(this).parents(".show").animate({
                    backgroundColor: "#003"
                }, "slow")
                .animate({
                    opacity: "hide"
                }, "slow");
        }
        return false;
    }
}

function confirmLimitSubmit() {
    if (document.getElementById('search_limit').value != "") {
        document.limit_go.submit();
    } else {
        return false;
    }
}


/*function checkAll() {

    var field = document.forms.deletefiles;
    for (i = 0; i < field.length; i++)
        field[i].checked = true;
}*/

/*function uncheckAll() {
    var field = document.forms.deletefiles;
    for (i = 0; i < field.length; i++)
        field[i].checked = false;
}*/
// -->



/*$.validator.setDefaults({
 submitHandler: function() { alert("submitted!"); }
 });*/
/*$(document).ready(function () {

    // validate signup form on keyup and submit
    $("#form1").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 200
            },
            address: {
                minlength: 3,
                maxlength: 500
            },
            contact1: {
                minlength: 3,
                maxlength: 20
            },
            contact2: {
                minlength: 3,
                maxlength: 20
            }
        },
        messages: {
            name: {
                required: "Please enter a supplier Name",
                minlength: "supplier must consist of at least 3 characters"
            },
            address: {
                minlength: "supplier Address must be at least 3 characters long",
                maxlength: "supplier Address must be at least 3 characters long"
            }
        }
    });

});*/
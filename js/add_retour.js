$(document).ready(function() {
    $('#dateRetour').jdPicker();
    $("#search").validate({
        rules: {
            searchtxt: {
                required: true
            }
        },
        messages: {
            searchtxt: {
                required: "Veuillez entrer le numéro de sortie !"
            }
        }
    });

    $('#Reset').click(function() {
        location.reload();
    });

    $("#form1").validate({
        rules: {
            sortieId: {
                required: true
            },
            dateRetour: {
                required: true,
            }
        },
        messages: {
            sortieId: {
                required: "Veuillez indiquez l'id !"
            },
            dateRetour: {
                required: "Veuillez entrer la date du retour"
            }
        }
    });
})

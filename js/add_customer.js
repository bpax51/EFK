/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/

        $(document).ready(function () {

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
                        required: true,
                        minlength: 10,
                        maxlength: 14
                    },
                    contact2: {
                        minlength: 3,
                        maxlength: 14
                    }
                },
                messages: {
                    name: {
                        required: "Veuillez entrer le nom du commercial",
                        minlength: "Le nom du commercial doit contenir 3 characteres"
                    },
                    contact1: {
                        required: "Merci d'entrer un numéro de téléphone",
                        minlength: "Numéro de tel en 10 et 14 chiffres",
                        maxlength: "Numéro de tel en 10 et 14 chiffres"
                    },
                    address: {
                        minlength: "Adresse trés courte",
                        maxlength: "Adresse !!!"
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

function lettersOnly(evt) {
       evt = (evt) ? evt : event;
       var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
          ((evt.which) ? evt.which : 0));
       if (charCode > 31 && (charCode < 65 || charCode > 90) &&
          (charCode < 97 || charCode > 122)) {
          return false;
       }
       return true;
     }
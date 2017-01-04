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
                        minlength: 3,
                        maxlength: 13
                    },
                    contact2: {
                        minlength: 3,
                        maxlength: 13
                    }
                },
                messages: {
                    name: {
                        required: "Merci de fournir le nom du fournisseur",
                        minlength: "Le nom du fournisseur doit contenir au moin 3 characteres !",
                        maxlength: "Le Nom fournisseur contient beaucoup de characteres, Merci d'entrer un nom plus court !"
                    },
                    contact1: {
                        required: "Merci d'entrer le numéro de téléphone",
                        minlength: "Contact Entre 10 et 14 Chiffres",
                        maxlength: "Contact Entre 10 et 14 Chiffres"
                    },
                    address: {
                        minlength: "Adresse Doit contenir au moin 3 characteres",
                        maxlength: "Adresse trés large !"
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

function ValidateAlpha(evt) {
       evt = (evt) ? evt : event;
       var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
          ((evt.which) ? evt.which : 0));
       if (charCode > 31 && (charCode < 65 || charCode > 90) &&
          (charCode < 97 || charCode > 122)) {
          return false;
       }
       return true;
     }
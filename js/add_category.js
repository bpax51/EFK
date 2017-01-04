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
                    description: {
                        minlength: 3,
                        maxlength: 500
                    }
                },
                messages: {
                    name: {
                        required: "Veuillez entrer le nom de la  catégorie",
                        minlength: "Le nom doit contenir au moin characteres"
                    },
                    description: {
                        minlength: "La déscriptions doit contenir au moins 3 characteres",
                        maxlength: "La déscriptions doit contenir au max 500 characteres"
                    }
                }
            });

        });

   


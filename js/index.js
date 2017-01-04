
  
        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/

        $(document).ready(function () {

            // validate signup form on keyup and submit
            $("#login-form").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 3
                    },
                    password: {
                        required: true,
                        minlength: 3
                    }
                },
                messages: {
                    username: {
                        required: "Veuillez entrez le nom d'utilisateur",
                        minlength: "Votre nom d'utilisateur doit contenir au moin 3 characteres"
                    },
                    password: {
                        required: "Veuillez entrez votre mot de passe",
                        minlength: "Le mot de passe doit contenir au moin 3 characteres"
                    }
                }
            });

        });


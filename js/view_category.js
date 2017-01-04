/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

   
        // Nannette Thacker http://www.shiningstar.net
        function confirmSubmit() {
            var agree = confirm("Voulez-vous vraiment supprimer cette catégorie ?");
            if (agree)
                return true;
            else
                return false;
        }

        function confirmDeleteSubmit() {
            var flag = 0;
            var field = document.forms.deletefiles;
            for (i = 0; i < field.length; i++) {
                if (field[i].checked == true) {
                    flag = flag + 1;

                }

            }
            if (flag < 1) {
                alert("Vous devez selection une catégorie !");
                return false;
            } else {
                var agree = confirm("Voulez-vous vraiment supprimer les catégories selectionnées ?");
                if (agree)

                    document.deletefiles.submit();
                else
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


        function checkAll() {

            var field = document.forms.deletefiles;
            for (i = 0; i < field.length; i++)
                field[i].checked = true;
        }

        function uncheckAll() {
            var field = document.forms.deletefiles;
            for (i = 0; i < field.length; i++)
                field[i].checked = false;
        }
        // -->
    

        /*$.validator.setDefaults({
         submitHandler: function() { alert("submitted!"); }
         });*/

  


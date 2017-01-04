/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//partically working coding

        function confirmLimitSubmit() {
            if (document.getElementById('search_limit').value != "") {
                document.limit_go.submit();
            } else {
                return false;
            }
        }

$(function() {
    $('#date1,#date2').jdPicker();
    $("#commercial").autocomplete("customer1.php", {
        width: 160,
        autoFill: true,
        mustMatch: true,
        selectFirst: true
    });
    $("#form1").submit(function(event) {
        if ($("#commercial").val() == "" && $("#date1").val() == "") {
        alert("Veuillez entrer au moin un critère de recherche !");
        return false;
    }
    });
});
function printData()
{
   var divToPrint=document.getElementById("tableDetails");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

/*$('#printTable').on('click',function(){
printData();
});*/
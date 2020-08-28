<script>

    function addCommas(nStr){
       nStr += '';
       x = nStr.split('.');
       x1 = x[0];
       x2 = x.length > 1 ? '.' + x[1] : '';
       var rgx = /(\d+)(\d{3})/;
       while (rgx.test(x1)) {
         x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
      return x1 + x2;
    }

    function calculate(){
      var SetAmount = document.getElementById('Budgetamount').value;
      var Amount = SetAmount.replace(",","").replace(",","");
      var SetTechnique = document.getElementById('Budgettecnique').value;
      var Technique = SetTechnique.replace(",","");
      var SetReceipt = document.getElementById('Budgetreceipt').value;
      var Receipt = SetReceipt.replace(",","").replace(",","");
      var SetCopy = document.getElementById('Budgetcopy').value;
      var Copy = SetCopy.replace(",","");

      var Remain = parseFloat(Amount) - parseFloat(Technique) - parseFloat(Receipt) - parseFloat(Copy);
      
      document.form1.Budgetamount.value = addCommas(Amount);
      document.form1.Budgettecnique.value = addCommas(Technique);
      document.form1.Budgetreceipt.value = addCommas(Receipt);
      document.form1.Budgetcopy.value = addCommas(Copy);

      document.form1.Remainfee.value = addCommas(Remain.toFixed(2));

    }

</script>
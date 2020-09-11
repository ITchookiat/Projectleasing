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
      var Amount = SetAmount.replace(",","");
      var SetTechnique = document.getElementById('Budgettecnique').value;
      var Technique = SetTechnique.replace(",","");
      var SetReceipt = document.getElementById('Budgetreceipt').value;
      var Receipt = SetReceipt.replace(",","");
      var SetCopy = document.getElementById('Budgetcopy').value;
      var Copy = SetCopy.replace(",","");
      var SetTransferinExtra = document.getElementById('TransferinExtra').value;
      var TransferinExtra = SetTransferinExtra.replace(",","");
      var SetTransferextra = document.getElementById('Transferextra').value;
      var Transferextra = SetTransferextra.replace(",","");
      var SetNewcarextra = document.getElementById('Newcarextra').value;
      var Newcarextra = SetNewcarextra.replace(",","");
      var SetTaxextra = document.getElementById('Taxextra').value;
      var Taxextra = SetTaxextra.replace(",","");
      var SetRegisextra = document.getElementById('Regisextra').value;
      var Regisextra = SetRegisextra.replace(",","");
      var SetDocextra = document.getElementById('Docextra').value;
      var Docextra = SetDocextra.replace(",","");
      var SetEditextra = document.getElementById('Editextra').value;
      var Editextra = SetEditextra.replace(",","");
      var SetCancelextra = document.getElementById('Cancelextra').value;
      var Cancelextra = SetCancelextra.replace(",","");
      var SetOtherextra = document.getElementById('Otherextra').value;
      var Otherextra = SetOtherextra.replace(",","");
      var SetEMSfee = document.getElementById('EMSfee').value;
      var EMSfee = SetEMSfee.replace(",","");
      
      var Remain = parseFloat(Amount) - parseFloat(Technique) - parseFloat(Receipt) - parseFloat(Copy) -
                   parseFloat(TransferinExtra) - parseFloat(Transferextra) - parseFloat(Newcarextra) -
                   parseFloat(Taxextra) - parseFloat(Regisextra) - parseFloat(Docextra) - parseFloat(Editextra) -
                   parseFloat(Cancelextra) - parseFloat(Otherextra) - parseFloat(EMSfee);
      
      document.form1.Budgetamount.value = addCommas(Amount);
      document.form1.Budgettecnique.value = addCommas(Technique);
      document.form1.Budgetreceipt.value = addCommas(Receipt);
      document.form1.Budgetcopy.value = addCommas(Copy);
      document.form1.TransferinExtra.value = addCommas(TransferinExtra);
      document.form1.Transferextra.value = addCommas(Transferextra);
      document.form1.Newcarextra.value = addCommas(Newcarextra);
      document.form1.Taxextra.value = addCommas(Taxextra);
      document.form1.Regisextra.value = addCommas(Regisextra);
      document.form1.Docextra.value = addCommas(Docextra);
      document.form1.Editextra.value = addCommas(Editextra);
      document.form1.Cancelextra.value = addCommas(Cancelextra);
      document.form1.Otherextra.value = addCommas(Otherextra);
      document.form1.EMSfee.value = addCommas(EMSfee);

      document.form1.Remainfee.value = addCommas(Remain.toFixed(2));

    }

</script>

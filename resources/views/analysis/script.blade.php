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

    function income(){
      var num11 = document.getElementById('Beforeincome').value;
      var num1 = num11.replace(",","");
      var num22 = document.getElementById('Afterincome').value;
      var num2 = num22.replace(",","");
      document.form1.Beforeincome.value = addCommas(num1);
      document.form1.Afterincome.value = addCommas(num2);
    }

    function mile(){
      var num11 = document.getElementById('Milecar').value;
      var num1 = num11.replace(",","");
      var num22 = document.getElementById('Midpricecar').value;
      var num2 = num22.replace(",","");
      document.form1.Milecar.value = addCommas(num1);
      document.form1.Midpricecar.value = addCommas(num2);
    }

    function calculate(){
      var typedetail = document.getElementById('Typecardetail').value;
      var year = document.getElementById('Yearcar').value;

        if(year >= 2015 && year <= 2020){
          var groupyear = '2015 - 2020';
        }
        else if(year >= 2013 && year <= 2014){
          if(typedetail == 'รถกระบะ' || typedetail == 'รถเก๋ง/7ที่นั่ง'){
            var groupyear = '2012 - 2014';
          }else{
            var groupyear = '2013 - 2014';
          }
        }
        else if(year == 2012){
          if(typedetail == 'รถกระบะ' || typedetail == 'รถเก๋ง/7ที่นั่ง'){
            var groupyear = '2012 - 2014';
          }else{
            var groupyear = '2010 - 2012';
          }
        }
        else if(year >= 2010 && year <= 2011){
          if(typedetail == 'รถกระบะ' || typedetail == 'รถเก๋ง/7ที่นั่ง'){
            var groupyear = '2010 - 2011';
          }else{
            var groupyear = '2010 - 2012';
          }
        }
        else if(year >= 2009){
          if(typedetail == 'รถกระบะ' || typedetail == 'รถเก๋ง/7ที่นั่ง'){
            var groupyear = '2009';
          }else{
            var groupyear = '2008 - 2009';
          }
        }
        else if(year >= 2008){
          if(typedetail == 'รถกระบะ' || typedetail == 'รถเก๋ง/7ที่นั่ง'){
            var groupyear = '2008';
          }else{
            var groupyear = '2008 - 2009';
          }
        }
        else if(year >= 2007){
          if(typedetail == 'รถกระบะ' || typedetail == 'รถเก๋ง/7ที่นั่ง'){
            var groupyear = '2007';
          }else{
            var groupyear = '2006 - 2007';
          }
        }
        else if(year >= 2006){
          if(typedetail == 'รถกระบะ' || typedetail == 'รถเก๋ง/7ที่นั่ง'){
            var groupyear = '2006';
          }else{
            var groupyear = '2006 - 2007';
          }
        }
        else if(year >= 2005){
          if(typedetail == 'รถกระบะ'){
            var groupyear = '2003 - 2005';
          }else if(typedetail == 'รถเก๋ง/7ที่นั่ง'){
            var groupyear = '2005';
          }else{
            var groupyear = '2004 - 2005';
          }
        }
        else if(year >= 2004){
          if(typedetail == 'รถกระบะ'){
            var groupyear = '2003 - 2005';
          }else if(typedetail == 'รถเก๋ง/7ที่นั่ง'){
            var groupyear = '2004';
          }else{
            var groupyear = '2004 - 2005';
          }
        }
        else if(year >= 2003){
          if(typedetail == 'รถกระบะ'){
            var groupyear = '2003 - 2005';
          }else{
            var groupyear = '2003';
          }
        }
        else{
              groupyear = '-';
        }

      document.form1.Groupyearcar.value = groupyear;
      var timelack = document.getElementById('Timeslackencar').value;
        if(typedetail == 'รถกระบะ' && groupyear == '2015 - 2020'){
          // $("#Timeslackencar").append("<option value='1'>12</option><option value='1.5'>18</option><option value='2'>24</option><option value='2.5'>30</option><option value='3'>36</option><option value='3.5'>42</option><option value='4'>48</option><option value='4.5'>54</option><option value='5'>60</option><option value='5.5'>66</option><option value='6'>72</option><option value='6.5'>78</option><option value='7'>84</option>");
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '5.55';
          }else if(timelack > 4 && timelack <= 5){
            document.form1.Interestcar.value = '6.00';
          }else if(timelack > 5 && timelack <= 6){
            document.form1.Interestcar.value = '6.45';
          }else{
            document.form1.Interestcar.value = '7.15';
          }
        }
        else if(typedetail == 'รถกระบะ' && groupyear == '2012 - 2014'){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '9.45';
          }else if(timelack > 4 && timelack <= 5){
            document.form1.Interestcar.value = '9.55';
          }else if(timelack > 5 && timelack <= 6){
            document.form1.Interestcar.value = '9.65';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถกระบะ' && groupyear == '2010 - 2011'){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '10.80';
          }else if(timelack > 4 && timelack <= 5){
            document.form1.Interestcar.value = '10.90';
          }else if(timelack > 5 && timelack <= 6){
            document.form1.Interestcar.value = '11';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถกระบะ' && groupyear == '2009'){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '12.45';
          }else if(timelack > 4 && timelack <= 5){
            document.form1.Interestcar.value = '12.55';
          }else if(timelack > 5 && timelack <= 6){
            document.form1.Interestcar.value = '12.65';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถกระบะ' && groupyear == '2008'){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '14.35';
          }else if(timelack > 4 && timelack <= 5){
            document.form1.Interestcar.value = '14.45';
          }else if(timelack > 5 && timelack <= 6){
            document.form1.Interestcar.value = '14.55';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถกระบะ' && groupyear == '2007'){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '14.45';
          }else if(timelack > 4 && timelack <= 5){
            document.form1.Interestcar.value = '14.55';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถกระบะ' && groupyear == '2006'){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '14.55';
          }else if(timelack > 4 && timelack <= 5){
            document.form1.Interestcar.value = '14.75';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถกระบะ' && groupyear == '2005'){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '18.65';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถกระบะ' && groupyear == '2004'){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '18.65';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถกระบะ' && groupyear == '2003'){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '18.65';
          }else{
            document.form1.Interestcar.value = '';
          }
        }

        if(typedetail == 'รถตอนเดียว' && year > 2014 && year <= 2020){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 5){
            document.form1.Interestcar.value = '10.80';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถตอนเดียว' && year > 2012 && year <= 2014){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 5){
            document.form1.Interestcar.value = '12.60';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถตอนเดียว' && year > 2009 && year <= 2012){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 5){
            document.form1.Interestcar.value = '14.40';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถตอนเดียว' && year > 2007 && year <= 2009){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '16.80';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถตอนเดียว' && year > 2005 && year <= 2007){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '18.60';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถตอนเดียว' && year > 2003 && year <= 2005){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 3){
            document.form1.Interestcar.value = '20.40';
          }else{
            document.form1.Interestcar.value = '';
          }
        }

        if(typedetail == 'รถเก๋ง/7ที่นั่ง' && groupyear == '2015 - 2020'){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '6.05';
          }else if(timelack > 4 && timelack <= 5){
            document.form1.Interestcar.value = '6.50';
          }else if(timelack > 5 && timelack <= 6){
            document.form1.Interestcar.value = '6.95';
          }else{
            document.form1.Interestcar.value = '7.65';
          }
        }
        else if(typedetail == 'รถเก๋ง/7ที่นั่ง' && groupyear == '2012 - 2014'){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '9.60';
          }else if(timelack > 4 && timelack <= 5){
            document.form1.Interestcar.value = '9.70';
          }else if(timelack > 5 && timelack <= 6){
            document.form1.Interestcar.value = '9.80';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถเก๋ง/7ที่นั่ง' && groupyear == '2010 - 2011'){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '10.95';
          }else if(timelack > 4 && timelack <= 5){
            document.form1.Interestcar.value = '11.05';
          }else if(timelack > 5 && timelack <= 6){
            document.form1.Interestcar.value = '11.15';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถเก๋ง/7ที่นั่ง' && groupyear == '2009'){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '12.60';
          }else if(timelack > 4 && timelack <= 5){
            document.form1.Interestcar.value = '12.70';
          }else if(timelack > 5 && timelack <= 6){
            document.form1.Interestcar.value = '12.80';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถเก๋ง/7ที่นั่ง' && groupyear == '2008'){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '14.50';
          }else if(timelack > 4 && timelack <= 5){
            document.form1.Interestcar.value = '14.60';
          }else if(timelack > 5 && timelack <= 6){
            document.form1.Interestcar.value = '14.70';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถเก๋ง/7ที่นั่ง' && groupyear == '2007'){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '14.60';
          }else if(timelack > 4 && timelack <= 5){
            document.form1.Interestcar.value = '14.70';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถเก๋ง/7ที่นั่ง' && groupyear == '2006'){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '14.70';
          }else if(timelack > 4 && timelack <= 5){
            document.form1.Interestcar.value = '14.90';
          }else{
            document.form1.Interestcar.value = '';
          }
        }
        else if(typedetail == 'รถเก๋ง/7ที่นั่ง' && groupyear == '2005'){
          if(timelack == ''){
            document.form1.Interestcar.value = '';
          }else if(timelack <= 4){
            document.form1.Interestcar.value = '19.00';
          }else{
            document.form1.Interestcar.value = '';
          }
        }

        var num11 = document.getElementById('Topcar').value;
        var num1 = num11.replace(",","");
        var num4 = document.getElementById('Timeslackencar').value;
        var num2 = document.getElementById('Interestcar').value;
        var num3 = document.getElementById('Vatcar').value;
        var num55 = document.getElementById('P2Price').value;
        var num5 = num55.replace(",","");
        var num66 = document.getElementById('P2PriceOri').value;
        var num6 = num66.replace(",","");

          // $('#Topcar').change(function(){
          //   if(num1 >= 150000){
          //    $('#P2Price').val('6,700');
          //  }else{
          //    $('#P2Price').val('0');
          //  }
          // });

            if(num1 >= 200000 && num1 <= 300000){
               var num5 = '6900';
               // var num5 = '6500';
             }else if(num1 > 300000){
               var num5 ='0'
             }
             else{
               var num5 ='0';
             }
           // console.log(num5);

          $('#Typecardetail,#Yearcar').change(function(){
            $('#Year').hide();
            $('#Timeslackencar').show();
            if(year > 2014 && year <= 2020 ){
              if(typedetail == 'รถตอนเดียว'){
                $("#Timeslackencar option[value='1']").show();
                $("#Timeslackencar option[value='1.5']").show();
                $("#Timeslackencar option[value='2']").show();
                $("#Timeslackencar option[value='2.5']").show();
                $("#Timeslackencar option[value='3']").show();
                $("#Timeslackencar option[value='3.5']").show();
                $("#Timeslackencar option[value='4']").show();
                $("#Timeslackencar option[value='4.5']").show();
                $("#Timeslackencar option[value='5']").show();
                $("#Timeslackencar option[value='5.5']").hide();
                $("#Timeslackencar option[value='6']").hide();
                $("#Timeslackencar option[value='6.5']").hide();
                $("#Timeslackencar option[value='7']").hide();
              }else{
                $("#Timeslackencar option[value='1']").show();
                $("#Timeslackencar option[value='1.5']").show();
                $("#Timeslackencar option[value='2']").show();
                $("#Timeslackencar option[value='2.5']").show();
                $("#Timeslackencar option[value='3']").show();
                $("#Timeslackencar option[value='3.5']").show();
                $("#Timeslackencar option[value='4']").show();
                $("#Timeslackencar option[value='4.5']").show();
                $("#Timeslackencar option[value='5']").show();
                $("#Timeslackencar option[value='5.5']").show();
                $("#Timeslackencar option[value='6']").show();
                $("#Timeslackencar option[value='6.5']").show();
                $("#Timeslackencar option[value='7']").show();
              }
             }
            else if(year > 2009 && year <= 2014 ){
              if(typedetail == 'รถตอนเดียว'){
                $("#Timeslackencar option[value='1']").show();
                $("#Timeslackencar option[value='1.5']").show();
                $("#Timeslackencar option[value='2']").show();
                $("#Timeslackencar option[value='2.5']").show();
                $("#Timeslackencar option[value='3']").show();
                $("#Timeslackencar option[value='3.5']").show();
                $("#Timeslackencar option[value='4']").show();
                $("#Timeslackencar option[value='4.5']").show();
                $("#Timeslackencar option[value='5']").show();
                $("#Timeslackencar option[value='5.5']").hide();
                $("#Timeslackencar option[value='6']").hide();
                $("#Timeslackencar option[value='6.5']").hide();
                $("#Timeslackencar option[value='7']").hide();
              }else{
                $("#Timeslackencar option[value='1']").show();
                $("#Timeslackencar option[value='1.5']").show();
                $("#Timeslackencar option[value='2']").show();
                $("#Timeslackencar option[value='2.5']").show();
                $("#Timeslackencar option[value='3']").show();
                $("#Timeslackencar option[value='3.5']").show();
                $("#Timeslackencar option[value='4']").show();
                $("#Timeslackencar option[value='4.5']").show();
                $("#Timeslackencar option[value='5']").show();
                $("#Timeslackencar option[value='5.5']").show();
                $("#Timeslackencar option[value='6']").show();
                $("#Timeslackencar option[value='6.5']").hide();
                $("#Timeslackencar option[value='7']").hide();
              }
             }
            else if(year > 2007 && year <= 2009 ){
               if(typedetail == 'รถตอนเดียว'){
                 $("#Timeslackencar option[value='1']").show();
                 $("#Timeslackencar option[value='1.5']").show();
                 $("#Timeslackencar option[value='2']").show();
                 $("#Timeslackencar option[value='2.5']").show();
                 $("#Timeslackencar option[value='3']").show();
                 $("#Timeslackencar option[value='3.5']").show();
                 $("#Timeslackencar option[value='4']").show();
                 $("#Timeslackencar option[value='4.5']").hide();
                 $("#Timeslackencar option[value='5']").hide();
                 $("#Timeslackencar option[value='5.5']").hide();
                 $("#Timeslackencar option[value='6']").hide();
                 $("#Timeslackencar option[value='6.5']").hide();
                 $("#Timeslackencar option[value='7']").hide();
               }else{
                 $("#Timeslackencar option[value='1']").show();
                 $("#Timeslackencar option[value='1.5']").show();
                 $("#Timeslackencar option[value='2']").show();
                 $("#Timeslackencar option[value='2.5']").show();
                 $("#Timeslackencar option[value='3']").show();
                 $("#Timeslackencar option[value='3.5']").show();
                 $("#Timeslackencar option[value='4']").show();
                 $("#Timeslackencar option[value='4.5']").show();
                 $("#Timeslackencar option[value='5']").show();
                 $("#Timeslackencar option[value='5.5']").show();
                 $("#Timeslackencar option[value='6']").show();
                 $("#Timeslackencar option[value='6.5']").hide();
                 $("#Timeslackencar option[value='7']").hide();
               }
              }
            else if(year > 2005 && year <= 2007 ){
               if(typedetail == 'รถตอนเดียว'){
                 $("#Timeslackencar option[value='1']").show();
                 $("#Timeslackencar option[value='1.5']").show();
                 $("#Timeslackencar option[value='2']").show();
                 $("#Timeslackencar option[value='2.5']").show();
                 $("#Timeslackencar option[value='3']").show();
                 $("#Timeslackencar option[value='3.5']").show();
                 $("#Timeslackencar option[value='4']").show();
                 $("#Timeslackencar option[value='4.5']").hide();
                 $("#Timeslackencar option[value='5']").hide();
                 $("#Timeslackencar option[value='5.5']").hide();
                 $("#Timeslackencar option[value='6']").hide();
                 $("#Timeslackencar option[value='6.5']").hide();
                 $("#Timeslackencar option[value='7']").hide();
               }else{
                 $("#Timeslackencar option[value='1']").show();
                 $("#Timeslackencar option[value='1.5']").show();
                 $("#Timeslackencar option[value='2']").show();
                 $("#Timeslackencar option[value='2.5']").show();
                 $("#Timeslackencar option[value='3']").show();
                 $("#Timeslackencar option[value='3.5']").show();
                 $("#Timeslackencar option[value='4']").show();
                 $("#Timeslackencar option[value='4.5']").show();
                 $("#Timeslackencar option[value='5']").show();
                 $("#Timeslackencar option[value='5.5']").hide();
                 $("#Timeslackencar option[value='6']").hide();
                 $("#Timeslackencar option[value='6.5']").hide();
                 $("#Timeslackencar option[value='7']").hide();
               }
              }
            else if(year > 2003 && year <= 2005 ){
               if(typedetail == 'รถตอนเดียว'){
                 $("#Timeslackencar option[value='1']").show();
                 $("#Timeslackencar option[value='1.5']").show();
                 $("#Timeslackencar option[value='2']").show();
                 $("#Timeslackencar option[value='2.5']").show();
                 $("#Timeslackencar option[value='3']").show();
                 $("#Timeslackencar option[value='3.5']").hide();
                 $("#Timeslackencar option[value='4']").hide();
                 $("#Timeslackencar option[value='4.5']").hide();
                 $("#Timeslackencar option[value='5']").hide();
                 $("#Timeslackencar option[value='5.5']").hide();
                 $("#Timeslackencar option[value='6']").hide();
                 $("#Timeslackencar option[value='6.5']").hide();
                 $("#Timeslackencar option[value='7']").hide();
               }else{
                 $("#Timeslackencar option[value='1']").show();
                 $("#Timeslackencar option[value='1.5']").show();
                 $("#Timeslackencar option[value='2']").show();
                 $("#Timeslackencar option[value='2.5']").show();
                 $("#Timeslackencar option[value='3']").show();
                 $("#Timeslackencar option[value='3.5']").show();
                 $("#Timeslackencar option[value='4']").show();
                 $("#Timeslackencar option[value='4.5']").hide();
                 $("#Timeslackencar option[value='5']").hide();
                 $("#Timeslackencar option[value='5.5']").hide();
                 $("#Timeslackencar option[value='6']").hide();
                 $("#Timeslackencar option[value='6.5']").hide();
                 $("#Timeslackencar option[value='7']").hide();
               }
              }
            else if(year > 2003 && year <= 2005 ){
               if(typedetail == 'รถตอนเดียว'){
                 $("#Timeslackencar option[value='1']").show();
                 $("#Timeslackencar option[value='1.5']").show();
                 $("#Timeslackencar option[value='2']").show();
                 $("#Timeslackencar option[value='2.5']").show();
                 $("#Timeslackencar option[value='3']").show();
                 $("#Timeslackencar option[value='3.5']").hide();
                 $("#Timeslackencar option[value='4']").hide();
                 $("#Timeslackencar option[value='4.5']").hide();
                 $("#Timeslackencar option[value='5']").hide();
                 $("#Timeslackencar option[value='5.5']").hide();
                 $("#Timeslackencar option[value='6']").hide();
                 $("#Timeslackencar option[value='6.5']").hide();
                 $("#Timeslackencar option[value='7']").hide();
               }else{
                 $("#Timeslackencar option[value='1']").show();
                 $("#Timeslackencar option[value='1.5']").show();
                 $("#Timeslackencar option[value='2']").show();
                 $("#Timeslackencar option[value='2.5']").show();
                 $("#Timeslackencar option[value='3']").show();
                 $("#Timeslackencar option[value='3.5']").show();
                 $("#Timeslackencar option[value='4']").show();
                 $("#Timeslackencar option[value='4.5']").hide();
                 $("#Timeslackencar option[value='5']").hide();
                 $("#Timeslackencar option[value='5.5']").hide();
                 $("#Timeslackencar option[value='6']").hide();
                 $("#Timeslackencar option[value='6.5']").hide();
                 $("#Timeslackencar option[value='7']").hide();
               }
              }
            else if(year > 2002 && year <= 2003 ){
               if(typedetail == 'รถตอนเดียว'){
                 $("#Timeslackencar option[value='1']").hide();
                 $("#Timeslackencar option[value='1.5']").hide();
                 $("#Timeslackencar option[value='2']").hide();
                 $("#Timeslackencar option[value='2.5']").hide();
                 $("#Timeslackencar option[value='3']").hide();
                 $("#Timeslackencar option[value='3.5']").hide();
                 $("#Timeslackencar option[value='4']").hide();
                 $("#Timeslackencar option[value='4.5']").hide();
                 $("#Timeslackencar option[value='5']").hide();
                 $("#Timeslackencar option[value='5.5']").hide();
                 $("#Timeslackencar option[value='6']").hide();
                 $("#Timeslackencar option[value='6.5']").hide();
                 $("#Timeslackencar option[value='7']").hide();
               }else{
                 $("#Timeslackencar option[value='1']").show();
                 $("#Timeslackencar option[value='1.5']").show();
                 $("#Timeslackencar option[value='2']").show();
                 $("#Timeslackencar option[value='2.5']").show();
                 $("#Timeslackencar option[value='3']").show();
                 $("#Timeslackencar option[value='3.5']").show();
                 $("#Timeslackencar option[value='4']").show();
                 $("#Timeslackencar option[value='4.5']").hide();
                 $("#Timeslackencar option[value='5']").hide();
                 $("#Timeslackencar option[value='5.5']").hide();
                 $("#Timeslackencar option[value='6']").hide();
                 $("#Timeslackencar option[value='6.5']").hide();
                 $("#Timeslackencar option[value='7']").hide();
               }
              }
            else{
              $("#Timeslackencar option[value='1']").hide();
              $("#Timeslackencar option[value='1.5']").hide();
              $("#Timeslackencar option[value='2']").hide();
              $("#Timeslackencar option[value='2.5']").hide();
              $("#Timeslackencar option[value='3']").hide();
              $("#Timeslackencar option[value='3.5']").hide();
              $("#Timeslackencar option[value='4']").hide();
              $("#Timeslackencar option[value='4.5']").hide();
              $("#Timeslackencar option[value='5']").hide();
              $("#Timeslackencar option[value='5.5']").hide();
              $("#Timeslackencar option[value='6']").hide();
              $("#Timeslackencar option[value='6.5']").hide();
              $("#Timeslackencar option[value='7']").hide();
            }
          });

          if(num4 == '1'){
             var period = '12';
           }else if(num4 == '1.5'){
             var period = '18';
           }else if(num4 == '2'){
             var period = '24';
           }else if(num4 == '2.5'){
             var period = '30';
           }else if(num4 == '3'){
             var period = '36';
           }else if(num4 == '3.5'){
             var period = '42';
           }else if(num4 == '4'){
             var period = '48';
           }else if(num4 == '4.5'){
             var period = '54';
           }else if(num4 == '5'){
             var period = '60';
           }else if(num4 == '5.5'){
             var period = '66';
           }else if(num4 == '6'){
             var period = '72';
           }else if(num4 == '6.5'){
             var period = '78';
           }else if(num4 == '7'){
             var period = '84';
          }

          var totaltopcar = parseFloat(num1);
          var a = (num2*num4)+100;
          var b = (((totaltopcar*a)/100)*1.07)/period;
          var result = Math.ceil(b/10)*10;
          var durate = result/1.07;
          var durate2 = durate.toFixed(2)*period;
          var tax = result-durate;
          var tax2 = tax.toFixed(2)*period;
          var total = result*period;
          var total2 = durate2+tax2;
          document.form1.P2Price.value = addCommas(num5);
        if(!isNaN(result)){
            document.form1.Paycar.value = addCommas(result.toFixed(2));
            document.form1.Topcar.value = addCommas(totaltopcar);
            document.form1.TopcarOri.value = addCommas(num1);
            document.form1.Paymemtcar.value = addCommas(durate.toFixed(2));
            document.form1.Timepaymentcar.value = addCommas(durate2.toFixed(2));
            document.form1.Taxcar.value = addCommas(tax.toFixed(2));
            document.form1.Taxpaycar.value = addCommas(tax2.toFixed(2));
            document.form1.Totalpay1car.value = addCommas(total.toFixed(2));
            document.form1.Totalpay2car.value = addCommas(total2.toFixed(2));
            document.form1.P2Price.value = addCommas(num5);
            document.form1.tempTopcar.value = addCommas(totaltopcar);
            // document.form1.P2PriceOri.value = addCommas(num5);
        }
    }

    function commission(){
          var num11 = document.getElementById('Commissioncar').value;
          var num1 = num11.replace(",","");
          var input = document.getElementById('Agentcar').value;
          var Subtstr = input.split("");
          var Setstr = Subtstr[0];
          if (Setstr[0] == "*") {
          var result = num1;
          }else {
          if(num1 > 999){
          if(num11 == ''){
          var num11 = 0;
          }
          else{
          var sumCom = (num1*0.03);
          var result = num1 - sumCom;
          }
          }else{
          var result = num1;
          }
          }
          if(!isNaN(num1)){
          document.form1.Commissioncar.value = addCommas(num1);
          document.form1.commitPrice.value =  addCommas(result);
          }
        }

    function balance(){
          var num11 = document.getElementById('tranPrice').value;
          var num1 = num11.replace(",","");
          var num22 = document.getElementById('otherPrice').value;
          var num2 = num22.replace(",","");
          var num33 = document.getElementById('evaluetionPrice').value;
          var num3 = num33.replace(",","");
          if(num33 == ''){
          var num3 = 0;
          }
          var num44 = document.getElementById('dutyPrice').value;
          var num4 = num44.replace(",","");
          var num55 = document.getElementById('marketingPrice').value;
          var num5 = num55.replace(",","");
          var num66 = document.getElementById('actPrice').value;
          var num6 = num66.replace(",","");
          var num77 = document.getElementById('closeAccountPrice').value;
          var num7 = num77.replace(",","");
          var num88 = document.getElementById('P2Price').value;
          var num8 = num88.replace(",","");
          var temp = document.getElementById('Topcar').value;
          var toptemp = temp.replace(",","");
          var ori = document.getElementById('Topcar').value;
          var Topori = ori.replace(",","");
          if(num8 > 6700){
          var tempresult = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6)+parseFloat(num8);
          }else{
          var tempresult = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6)+parseFloat(num8);
          }
          if(num8 > 6700){
          var result = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6)+parseFloat(num7)+parseFloat(num8);
          }else {
          var result = parseFloat(num1)+parseFloat(num2)+parseFloat(num3)+parseFloat(num4)+parseFloat(num5)+parseFloat(num6)+parseFloat(num7)+parseFloat(num8);
          }
          if(num88 == 0){
          var TotalBalance = parseFloat(toptemp)-result;
          }
          else if(num8 > 6700){
          var TotalBalance = parseFloat(toptemp)-result;
          }
          else{
          var TotalBalance = parseFloat(toptemp)-result;
          }
          if(!isNaN(result)){
          document.form1.totalkPrice.value = addCommas(tempresult);
          document.form1.temptotalkPrice.value = addCommas(result);
          document.form1.tranPrice.value = addCommas(num1);
          document.form1.otherPrice.value = addCommas(num2);
          document.form1.dutyPrice.value = addCommas(num4);
          document.form1.marketingPrice.value = addCommas(num5);
          document.form1.actPrice.value = addCommas(num6);
          document.form1.closeAccountPrice.value = addCommas(num7);
          document.form1.balancePrice.value = addCommas(TotalBalance);
          document.form1.P2Price.value = addCommas(num8);
          }
                }

    function percent(){
          var num11 = document.getElementById('Midpricecar').value;
          var num1 = num11.replace(",","").replace(",","");
          var num22 = document.getElementById('Topcar').value;
          var num2 = num22.replace(",","");
          var percentt = (num2/num1) * 100;
          var result1 = percentt;
            if(!isNaN(result1)){
                  document.form1.Percentcar.value = result1.toFixed(0);
                  document.form1.Topcar.value = addCommas(num2);
            }
          }

</script>
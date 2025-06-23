  
           

             // Get loan script //
             /////////////////////

             function isInputOk(){

                if($('#loanExist').val() == '1'){
                  var outstanding = $('#loan_outstanding').val();
                  document.getElementById('submit_loan').removeAttribute('data-target');
                  $('#amount_').val('');
                  swalert('Oustanding Loan', 'error', 'Please, clear you outstanding of NGN '+ outstanding);
                  return false;
                }
                if(parseFloat($('#amount_').val()) < parseFloat($('#min_loan').val())){
                  $('#amount_').val('');
                  swalert('Invalid Amount', 'error', 'Minimum loan is NGN '+ $('#min_loan').val());
                  return false;
                }
                if(parseFloat($('#amount_').val()) > parseFloat($('#max_loan').val())){
                  $('#amount_').val('');
                  swalert('Invalid Amount', 'error', 'Maximum loan is NGN '+ $('#max_loan').val());
                  return false;
                }
               /*
                bvn = ($('#bvn_').val()).trim();
                if(bvn.length < 11 || bvn.length > 11) {
                  swalert('BVN Error', 'error', 'Check your BVN for any error.');
                  document.getElementById('submit_loan').removeAttribute('data-target');
                  return false;
                }
  
                charact = ' abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                for(i = bvn.length; i > 0; i--){
                  if(charact.indexOf(bvn[i]) != -1){ 
                  swalert('BVN Error', 'error', 'Check your BVN for any error.');
                  document.getElementById('submit_loan').removeAttribute('data-target');
                  return false;
                  }
                }  
                */
                // data-target="#loanConfirmation"
  
                document.getElementById('submit_loan').setAttribute('data-target', '#loanConfirmation');
                 
                amount_ = Number($('#amount_').val()).toFixed(2);
                reg_id_ = $('#reg_id_').val();
                interest_ = Number(amount_ ) * 0.1;
                expected_payment_ =  Number(Number(amount_) - interest_).toFixed(2);
                today = new Date();
                startDate = today.getFullYear()+'-'+getMonthDate(today, 'month')+'-'+getMonthDate(today, 'day');
                nextDate = new Date();
                nextDate = new Date(nextDate.setDate(nextDate.getDate() + 29));
                endDate = nextDate.getFullYear()+'-'+getMonthDate(nextDate, 'month')+'-'+getMonthDate(nextDate, 'day');
  
                $('#view_loan_amount').html(amount_);
                $('#view_loan_interest').html(Number(interest_).toFixed(2));
                $('#view_loan_expected_payment').html(expected_payment_);
                $('#view_loan_start_date').html(startDate);
                $('#view_loan_end_date').html(endDate);
  
                $('#loan_reg_id').val(reg_id_);
                $('#loan_amount').val(amount_);
                $('#loan_interest').val(interest_);
                $('#loan_expected_payment').val(expected_payment_);
               // $('#loan_bvn').val(bvn);
                $('#loan_start_date').val(startDate);
                $('#loan_end_date').val(endDate);
                  
                return true;
               }
  
  
               
               //// for the investment section  /////
               /////////////////////////////////////
  
               function startInvestment(){
              
                let amount_ = parseFloat($('#amount_').val());
                let min_inv = parseFloat($('#min_investment').val());
                let max_inv = parseFloat($('#max_investment').val());
  
                if(amount_ < min_inv){
                  swalert('Invalid Amount', 'error', 'Aminimum amount: '+ min_inv );
                  return false;
                }
                
                if(amount_ > max_inv){
                    swalert('Invalid Amount', 'error', 'Maximum amount: '+ max_inv );
                  return false;
                }
  
  
                let duration = $('#duration').val();
                let start_date = ($('#start_date').val()).trim();
  
                let d = $('#duration_'+duration).html();
                let duration_rate = (d.slice(0, d.length-1)).trim();
                duration_rate = duration_rate.split(" ");
                let d_number = duration_rate[0];
                let d_name = duration_rate[1];
                let rate = duration_rate[2];
  
                /////  +++   mm/dd/yyyy
                s_date = start_date.split('/');
  
                m = s_date[0];
                d = s_date[1];
                y = s_date[2]; 
                m_r = ['00', '01', '02','03','04','05','06','07','08','09','10','11','12'];
                d_r = ['00', '01', '02','03','04','05','06','07','08','09','10','11','12',
                       '13', '14', '15','16','17','18','19','20','21','22','23','24','25',
                       '26', '27', '28','29','30','31'];
  
                let today_date = new Date();
                today_year = today_date.getFullYear();
                y_r = [today_year, today_year+1, today_year+2, today_year+3, today_year+4];
               
                if((m_r.indexOf(m) === -1) || (d_r.indexOf(d) === -1) || (y_r.indexOf(parseInt(y)) === -1)){
                  document.getElementById('submit_investment').removeAttribute('data-target');
                  swalert('Date format error', 'error', 'The date format entered is invalid.');
                  return false;
                }
   
                let t_m = getMonthDate(today_date, 'month');
                let t_d = getMonthDate(today_date, 'day');
  
                if((m <= t_m ) && (d < t_d))  {
                  document.getElementById('submit_investment').removeAttribute('data-target');
                  swalert('Date format error', 'error', 'The date format entered is invalid. Check the month or day of your startiing date.');
                  return false;
                }
  
                let start_Date = new Date(y+'-'+m+'-'+d);
                let end_Date = null;
                amount_ = parseInt(amount_); rate = parseInt(rate); 
  
          
                let send_start_date = y+'-'+m+'-'+d;
                let interest_ = 0;
                let expected_total_ = 0;
                let duration_ = d_number+" "+d_name;
  
                if(d_number === '3' &&  d_name === 'months'){
                     interest_ = amount_ * rate / 100; 
                     expected_total_ = amount_ + interest_;
                     end_Date = new Date(start_Date.setDate(start_Date.getDate() + (30 * 3)));
                }
  
                if(d_number === '6' && d_name === 'months'){
                  interest_ = amount_ * rate / 100; 
                  expected_total_ = amount_ + interest_; 
                  end_Date = new Date(start_Date.setDate(start_Date.getDate() + (30 * 6)));    
                }
  
                if(d_number === '1' && d_name === 'year'){
                  interest_ = amount_ * rate / 100; 
                  expected_total_ = amount_ + interest_; 
                  end_Date = new Date(start_Date.setDate(start_Date.getDate() + (365)));
                }
  
                endDate = end_Date.getFullYear()+'-'+getMonthDate(end_Date, 'month')+'-'+getMonthDate(end_Date, 'day');
                
                expected_total = amount_ + interest_ ;
              
                // amount, start_date, end_date, duration, rate, interest, expected_total 
                // data-target="#loanConfirmation"
  
                document.getElementById('submit_investment').setAttribute('data-target', '#startInvestment');
            
                 
                $('#view_in_amount').html(Number(amount_).toFixed(2));
                $('#view_in_interest').html(Number(interest_).toFixed(2));
                $('#view_in_expected_total').html(Number(expected_total_).toFixed(2));
                $('#view_in_rate').html(rate);
                $('#view_in_duration').html(duration_);
                $('#view_in_start_date').html(send_start_date);
                $('#view_in_end_date').html(endDate);
  
               
                $('#in_amount').val(amount_);
                $('#in_interest').val(interest_);
                $('#in_rate').val(rate);
                $('#in_expected_total').val(expected_total_);
                $('#in_duration').val(duration_);
                $('#in_start_date').val(send_start_date);
                $('#in_end_date').val(endDate);
                $('#in_id').val($('#duration').val());
                  
                return true;
               }
  
               /// the end of the investment script ///
               ////////////////////////////////////////
                
  
               function getMonthDate(dateObj, moment){
                   var num = '';
                     if(moment == "month"){
                      num = dateObj.getMonth() >= 10 ? (dateObj.getMonth() + 1) : '0'+(dateObj.getMonth()+1);
                     }else{
                      num = dateObj.getDate() >= 10 ? dateObj.getDate() : '0'+(dateObj.getDate());
                     }
                     return num;
               }
  
  
  
  
  
  
  
  
  
  
        
  
  
              /// SWEET ALERT FUNCTION DEFINITION ///
              //////////////////////////////////////
              function swalert(titl, status , msg ){
              swal({
                  title: titl,
                  text: msg,
                  icon: status,
                  button: "Ok",
                  });
            }
  
  
          // THE BEGINNING OF THE INTERSWITCH INTEGRATION ///
          /////////////////////////////////////////////////
  
     
  
          function checkoutWithQuickTeller(){
              let merchantCode = 'MX96879';
               let payItemId = 'Default_Payable_MX96879';
  
               var feeder_wallet_id = $('#feeder_wallet_id').val();
               var transRef = randomReference();
               let  amt = $('#amount').val();
               if(amt >= 2000){
                amt = (amt * 1.5/100) + amt;
               }
               amt = amt * 100;
               let email = $('#email').val();
               if(!(email.includes("@") && email.includes(".com"))) email = email+"@gmail.com"
              
              var paymentRequest = {
                          merchant_code: merchantCode,
                          pay_item_id: payItemId,
                          txn_ref: transRef,
                          amount:  amt,
                          cust_email : email,   // added recently
                          cust_id: feeder_wallet_id,
                          currency:  566,
                          site_redirect_url: window.location.origin,
                          onComplete: paymentCallBack,
                          mode: 'LIVE'
                        };
    
                 window.webpayCheckout(paymentRequest);
            }
    
  
            //generate a random transaction ref
            function randomReference() {
                var length = 10;
                var chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                var result = '';
                for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
                return result;
            }
  
    
            //callback function that gets triggered on payment success or failure
            function paymentCallBack(response){
              var reg_id = $('#reg_id').val();
              var amt = $('#amount').val();
              var post_url = $('#post_url').val();
              var feeder_wallet_id = $('#feeder_wallet_id').val();
              console.log(response);
              statuscode = ['11', '10', '00', '09'];
              if(statuscode.indexOf(response.resp) === -1){
                swalert('Payment Fail', 'error', 'We could not conclude the payment. Please, try again later.');
                return ;
              }
              
                amt = $('#amount').val();
                transref = response.txnref;
                if(response.resp === '09'){
                  sendFeederData(amt, transref, feeder_wallet_id, reg_id, post_url, "Pending "+response.desc);
                 }
                else if(statuscode.indexOf(response.resp) != -1){
                  sendFeederData(amt, transref, feeder_wallet_id, reg_id, post_url, "Success "+response.desc);
                }
          }
  
    
  
            function sendFeederData_old(amt_cash, txn_ref_, w_feeder_id, m_reg_id,  p_url, res){
              document.getElementById('overlay').style.display = 'block';
                    if(amt_cash <= 0) return ;
                    url = p_url;
                    data = {
                        'amount' : amt_cash,
                        'ref' : txn_ref_,
                        'response' : res,
                        'feeder_wallet_id': w_feeder_id,
                        'reg_id': m_reg_id,
                        '_token' : $('#csrf_token').val(),
                    };
                   $.post(url, data, (result, status)=>{
                    document.getElementById('overlay').style.display = 'none';
                     if(status == 'success'){
                        if(result.status == 'Pending')
                        swalert('Pending', 'warning', 'The transaction is pending.');
                        if(result.status == 'Success'){ 
                           swalert('Success', 'success', 'The transaction was successfully completed and the database updated.');
                            window.location.reload();
                          }
                           else 
                          swalert('Timeout', 'error', 'The transaction was not updated into the database.'); 
                     }else{
                         swalert('Error', 'error', status); 
                     }
                  });   
              }
  
            // THE END OF INTERSWITCH QUICKTELLER INTEGRATION ///
            /////////////////////////////////////////////////////
  
  
            /// The function that is used to handle the contribution deposit
            //////////////////////////////////////////////////////////////////
            function confirmContribution(){
       
              // ConfirmPaystack();
               let amount = $('#user-input').val();
               let contribution_id = $('#contribution_id').val();
               if(!contribution_id || contribution_id == undefined){ 
                 swalert('Error', 'error', 'Select a contribution or Start one before crediting it.');
                 return ;
               }
               let wallet_id = $('#wallet_id').val();
               if(amount != undefined && contribution_id != undefined && wallet_id != undefined){
                 document.getElementById('overlay').style.display = 'block';
       
                   url = "{{ url('member/check/contribution') }}";
                   data = {
                       'amount' : amount,
                       'contribution_id' : contribution_id,
                       'wallet_id' : wallet_id,
                       '_token' : "{{ csrf_token() }}",
                   };
               
                  $.post(url, data, (result, status)=>{
                    if(status == 'success' && result.status == 'success'){
                      ConfirmPaystack();
                      document.getElementById('overlay').style.display = 'none';
                    }else{  
                     document.getElementById('overlay').style.display = 'none';
                     swalert('Error', 'error', 'Contribution validation failed');
                    }
                 });
               }else{
                 document.getElementById('overlay').style.display = 'none';
                 swalert('Error', 'error', 'There was a problem in your contribution selection. Please, restart the app and try again.');
               }
           }
      
  
          /// Confirm your option
  
          function confirmPayment(){ 
         
          swal({
           title: "Are you sure?",
           text: "You are about to initiate the payment. This process is not reversible.",
           icon: "warning",
           buttons: true,
           dangerMode: true,
         })
         .then((willContinue) => {
               if (willContinue) {
                 try{
                 // payWithPaystack();
                 //return true;
                 }catch(e){
                   console.log(e);
                   // swalert('Error', 'error', 'Internet Connection problem. Please, connect to the internet');
                   // return false;
                 }
                } else {
                  swalert('Cancel', 'error', 'You have cancelled the investment saving initiation.');
                  return false;
              }
            });
         }
  
         // The Section deals with the cash out and transfer of money.. 
         //////////////////////////////////////////////////////////////
  
    
          // Script to fetch the user contributions id and name user name
      function getUser(){
        let bank_code = $('#bank_code').val();
          if(!bank_code || bank_code.trim() === '' || bank_code === undefined) {
            swalert('Error', 'error', 'Select Bank Name first');
            $('#account_number').val('');
            return ;
          };
        let account_number = $('#account_number').val();
         checkIt(account_number, 'account_number');
        if(account_number.length == 10){
     
           document.getElementById('overlay').style.display = 'block';
           let url = $('#resolve_url').val();
            data = {
                'bank_code' : bank_code,
                'account_number' : account_number,
                '_token' : $('#csrf_token').val(),
            };
           
           $.post(url, data, (result, status)=>{
             if(status == 'success'){
                if(!result){
                    document.getElementById('account_name').innerHTML = "<span style='color: red'>There was a problem resolving your account name.</span>";
                    document.getElementById('account_number').innerHTML = '';
                    document.getElementById('submit').setAttribute('disabled','true');
                    document.getElementById('overlay').style.display = 'none';
                }else{
                 res = JSON.parse(result);
                    if(res.status){
                      document.getElementById('account_name').innerHTML = "<span style='color: green'>" + res.data.account_name + "</span>";
                      document.getElementById('h_account_name').value = res.data.account_name;
                      document.getElementById('submit').removeAttribute('disabled');
                      document.getElementById('amount').removeAttribute('disabled');
                      document.getElementById('overlay').style.display = 'none';
                    }else{
                      document.getElementById('account_name').innerHTML = "<span style='color: green'>  Account Name Unresolved</span>";
                      document.getElementById('amount').setAttribute('disabled', 'true');
                      document.getElementById('overlay').style.display = 'none';
                   }
                }
             }else{
                alert("Fail to retreive");
                document.getElementById('overlay').style.display = 'none';
             }
          });
        }
    }
  
    function setMax(){
      var t = document.getElementById('contribution').value;
      max = 0;
      total = (t.split("|"))[1];
      cont_type = (t.split("|"))[0]; 
      if (total === undefined) max = 0;
      else max = total;
  
      document.getElementById('amount').setAttribute('max', max);
      document.getElementById('contributionType').setAttribute('value', cont_type);
      }
  
      function submit(){
      var amount = parseFloat(document.getElementById('amount').value);
      if(amount > 0) return true;
      else{ 
          alert("The amount to withdraw must be greater than 0.");
          return false;
          } 
      }
  
  
       // Script to fetch the user contributions id and name user name
       function sendData(amount, ref, contribution_id, response){
        document.getElementById('overlay').style.display = 'block';
              if(amount <= 0) return ;
              url = "{{ url('member/topup/credit') }}";
              data = {
                  'amount' : amount,
                  'ref' : ref,
                  'response' : response,
                  'wallet_id': $('#wallet_id').val(),
                  'contribution_id': contribution_id,
                  '_token' : "{{ csrf_token() }}",
              };
             $.post(url, data, (result, status)=>{
              document.getElementById('overlay').style.display = 'none';
               if(status == 'success'){
                  if(result.status == 'success') 
                     swalert('Success', 'success', 'The transaction was successfully completed and the database updated.');
                  else 
                    swalert('Timeout', 'error', 'The transaction was not updated into the database.'); 
               }else{
                   swalert('Error', 'error', status); 
               }
            }); 
             
            
                  function indicator(tag, message){
                    $(tag).html(message).css("background-color","#196F4A");
                  }
                  
                   function restore(tag, message){
                     $(tag).html(message).css("background-color",""); 
                  }
      }
  
  
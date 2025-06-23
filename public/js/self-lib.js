        

         function load_subCategory(){
            catg_id = document.getElementById('category').value;
            catg_id = catg_id.split('/');
            $.get("get/subCategory/"+catg_id,
            function(data, status){
          // alert("Data: " + JSON.parse(data) + "\nStatus: " + status);
            if(status && data){
                sub_catg = document.getElementById('sub_category');
                while(sub = document.getElementById('sub_catg')){
                    sub_catg.removeChild(sub);
                }
                data = JSON.parse(data);
               sub_catg = document.getElementById('sub_category');
           
              }
             });
         }
    

  function calculate(obj, opr){
    var f = document.forms[obj];
    var qty = parseInt(f.itemQty.value);
    var maxQty = parseInt(f.maxQty.value);
    var price = parseInt(f.price.value);
    var itp = parseInt(f.itemTotalPrice.value);
    var item_id = f.product_id.value;
    var session_id = f.session_id.value;d
   
 
     if(opr == '-'){
     if( (qty = qty -1) <= 1)
      qty = 1;
      f.itemQty.value = qty;
      amnt = qty * price;
      f.itemTotalPrice.value = amnt;
    
     document.getElementById("total1").innerHTML = '';
     document.getElementById("total1").innerHTML = addTotal();
     
     }    

     if(opr == '+'){
      if(qty < maxQty) qty = qty +1;
      else qty = maxQty;
      f.itemQty.value = qty;
      amnt = qty * price;
      f.itemTotalPrice.value =  amnt;
     
     document.getElementById("total1").innerHTML = '';
     document.getElementById("total1").innerHTML = addTotal();
  }
  updateCart(item_id, qty, session_id);
}


function updateCart(item_id, quantity, session_id){

   $.get("updatecart/"+item_id+"/"+quantity+"/"+session_id,
            function(data, status){
          // alert("Data: " + JSON.parse(data) + "\nStatus: " + status);
            if(status && data){
               // data = JSON.parse(data);
               //alert(data);
              }
         });
     }




function addTotal(){
  var total = 0;
   var totalobj = document.getElementsByClassName("itemTotal");
   for(var i=0; i < totalobj.length ; i++){
    if(isNaN(parseInt(totalobj[i].value))) continue;
    total += parseInt(totalobj[i].value);
   }
   return total;
 }

  function onloadTotal(){
    document.getElementById("total1").innerHTML = '';
document.getElementById("total1").innerHTML = addTotal(); 
 }


 function saveform(){
  

   var cash = parseInt(document.getElementById("cash").value);
   if(cash < addTotal()){
    alert("You do not have enough cash for these transactions.");
    return ;
   }
 var parform = document.getElementById("hiddenform");
  var totalobj = document.getElementsByClassName("itemTotal");


   for(var i=0; i < totalobj.length ; i++){
    if(isNaN(parseInt(totalobj[i].value))) continue;
    else{
           var myform = 'mform'+i;
            
           var f = document.forms[myform];

           var quantity = parseInt(f.itemQty.value);    
           var id = parseInt(f.product_id.value);
           var price = parseInt(f.price.value);
           var itemtotalprice = parseInt(f.itemTotalPrice.value);


           var imageName = f.image_name.value;
           var productName = f.product_name.value;

           

      //these are the inputs that will be inserted into the form created for the 
      //items to be submited.

           var tproduct_id = document.createElement('input');
           tproduct_id.name = String('id_'+i);
           tproduct_id.value = String(id)+'_'+(String(i));
           tproduct_id.type = 'hidden';


 
            var tproduct_image = document.createElement('input');
           tproduct_image.name = String('imageName_'+i);
           tproduct_image.value = String(imageName)+'_'+(String(i));
           tproduct_image.type = 'hidden';



           var tproduct_name = document.createElement('input');
           tproduct_name.name = String('productName_'+i);
           tproduct_name.value = String(productName)+'_'+(String(i));
           tproduct_name.type = 'hidden';

         

           var tquantity = document.createElement('input');
           tquantity.name = String('quantity_'+i);
           tquantity.value = String(quantity)+'_'+String(i);
           tquantity.type = 'hidden';
           

        
           var tprice = document.createElement('input');
           tprice.name = String('price_'+i);
           tprice.value = String(price)+'_'+String(i);
           tprice.type = 'hidden';

           var titemTotalPrice = document.createElement('input');
           titemTotalPrice.name = String('itemTotalPrice_'+i);
           titemTotalPrice.value = String(itemtotalprice)+'_'+(String(i));
           titemTotalPrice.type = 'hidden';
      

          

          parform.appendChild(tproduct_id);
          parform.appendChild(tproduct_image);
          parform.appendChild(tproduct_name);
          parform.appendChild(tquantity);
          parform.appendChild(tprice);
          parform.appendChild(titemTotalPrice);

        alert("Good, You can now click on submit button.");
        return ;
    }
 }
}


  
window.onload = function() {

  document.getElementById('send').setAttribute('disabled', 'true');
  rndstr();
}


function rndstr(){
     var chr = " 123456789ABCDEFGHJKLMNPQRSTUVXYZ";
     var str = '';
     for(var i = 0; i < 9; i++){
       var n = Math.floor(Math.random()*100);
       while((n = Math.floor(Math.random()*100)) > 32 ||  n == 0); 
       str += chr[n];  
     }
   document.getElementById('crypt').innerHTML = str;
}

function activate(url, action="action"){

let crypt = (document.getElementById('crypt').innerHTML).trim();
let data = document.getElementById('data').value;
var dt = '';
for(i =0; i < data.length; i++){
  if(data[i] !== ' ') dt += data[i];
}
if(crypt == dt && crypt !== ""){
 
 document.getElementById('send').removeAttribute('disabled');
 document.getElementById('form').setAttribute(action, url)
    }else{
 document.getElementById('send').setAttribute('disabled', 'true');
}
}

function setProduct(prd){

  url = document.getElementById("prd_id_"+prd.id).value
  img = document.getElementById("prd_img_id_"+prd.id).value
  document.getElementById('selected_prd_name').innerHTML = prd.name;
  if(prd.old_price)
      document.getElementById('selected_prd_old_price').innerHTML = "NGN "+prd.old_price;
  else
    document.getElementById('selected_prd_old_price').innerHTML = "";
  document.getElementById('selected_prd_new_price').innerHTML = "NGN" + prd.new_price;
  document.getElementById('selected_prd_image').setAttribute('src', img);
  document.getElementById('selected_prd_description').innerHTML = prd.description;
  document.getElementById('selected_prd_add_to_cart').setAttribute('href',  url);
 
}

function createAccount(e){
  email = document.getElementById('input-email');
  password = document.getElementById('input-password');
  div = document.getElementById('create-account');
  input = document.getElementById('createAccount');
 if(e.target.checked){
      input.setAttribute('name', 'create-account');
      email.setAttribute('type', 'email');
      password.setAttribute('type', 'password');
      div.style.display = 'block';
      }else{
    email.setAttribute('type', 'hidden');
    password.setAttribute('type', 'hidden');
    email.setAttribute('name', '');
    password.setAttribute('name', '');
    email.setAttribute('required', 'false');
    password.setAttribute('required', 'false');
    div.style.display = 'none';
    input.setAttribute('name', '');
 }
}



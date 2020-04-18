function emailValidate() {
    var email = document.getElementById('email');
    var spanemail = document.getElementById('spanemail');


    if (email.value == "") {
        email.style.border = '1px solid red';
        spanemail.style.color = 'red';
        spanemail.innerHTML = '&times; Field Is Empty';
        // alert('The fields must be filled');
        return false;
    } else {
        if ((email.value).indexOf('@') <= 0) {
            email.style.border = '1px solid red';
            spanemail.style.color = 'red';
            spanemail.innerHTML = '&times; Incorrect Format';
            return false;
        } else {
            if (((email.value).charAt((email.value).length - 4) != '.') && ((email.value).charAt((email.value).length - 3) != '.')) {
                email.style.border = '1px solid red';
                spanemail.style.color = 'red';
                spanemail.innerHTML = '&times; Incorrect Format';
                return false;

            } else {
                email.style.border = '1px solid green';
                spanemail.style.color = 'green';
                spanemail.innerHTML = '&check; Email Valid';

                return false;

            }
        }
    }

}
function emptyCheck(){
    var email = document.getElementById('email');
    if(email.value == ""){
        alert('The Fileds Must Be Filled');
        //window.location='../index.php';
    }
}

// password
function passwordValidate(){
    var password = document.getElementById('password');
    var spanpassword = document.getElementById('spanpassword');
    if(password.value == "") {
        password.style.border=" 1px solid red";
        spanpassword.style.color='red';
        spanpassword.innerHTML="&times; Filed empty";
        return false;
    }
    else
    {
        if(((password.value).length<=5)||((password.value).length>20)) {
            password.style.border= " 1px solid red";
            spanpassword.innerHTML=" &times; Password should be between 5 and 20";
            return false;
        } else {

            password.style.border=" 1px solid green";
            spanpassword.style.color = 'green';
            spanpassword.innerHTML='&check; Password Format correct';
            return false;
        }

    }


}

//amount validation
function moneyValidate(){
    var amount = document.getElementById('amount');
    var errorMessage = document.getElementById("errorAmount");

    if(amount.value == ""){
        amount.style.border="1px solid red";
        errorMessage.style.color='red';
        errorMessage.innerHTML='&times; Amount invalid';
        return false;
    } else {
        if(isNaN(amount.value)){
            amount.style.border="1px solid red";
            errorMessage.style.color='red';
            errorMessage.innerHTML='&times; NaN';
            return false;
        }else{
            if(amount.value <= 0) {
                amount.style.border="1px solid red";
                errorMessage.style.color='red';
                errorMessage.innerHTML='&times; amount invalid';
                return false;

            } else {

                amount.style.border=" 1px solid green";
                errorMessage.style.color='green';
                errorMessage.innerHTML='&check; Valid Amount';
                return false;
            }
        }

    }

}
// select field validation

function selectValidation(){
    var field = document.getElementById('selection');
    var errorMessage = document.getElementById('errorMessage');
    if(field.value == 'none'){
        field.style.border="1px solid red";
        errorMessage.style.color='red';
        errorMessage.innerHTML='&times; Please select Valid Value';
        return false;

    } else {
        field.style.border="1px solid green";
        errorMessage.style.display='none';
        return false;

    }

}


//name validate

function nameValidate() {
    var name = document.getElementById('name');
    errorMessage = document.getElementById('errorMessageName');
    if (name.value == "") {
        name.style.border = "1px solid red";
        errorMessage.style.color = 'orange';
        errorMessage.innerHTML = '&times; Name Invalid';
        return false
    } else {
        if (!isNaN(name.value)) {
            name.style.border = "1px solid red";
            errorMessage.style.color = 'orange';
            errorMessage.innerHTML = '&times; Name Must not Be Numerals';

        }
        else {
            if ((name.value).length < 3 || (name.value).length > 14) {
                name.style.border = "1px solid orange";
                errorMessage.style.color = 'red';
                errorMessage.innerHTML = '&times; Name Must Be Between 3 and 14';
                return false
            } else {
                name.style.border = "2px solid green";
            }

        }
    }

}
//confirm password

function cpasswordValidate(){
    var password = document.getElementById('txtcpswd');
    var errorMessageCPass = document.getElementById('errorMessageCPass');

    if(password.value == "") {
        password.style.border=" 1px solid red";
        errorMessageCPass.style.color='red';
        errorMessageCPass.innerHTML="&times; Filed empty";
        return false;
    }
    else
    {
        if(((password.value).length<=5)||((password.value).length>20)) {
            password.style.border= " 1px solid red";
            errorMessageCPass.innerHTML=" &times; Password should be between 5 and 20";
            return false;
        } else {

            password.style.border=" 1px solid green";
            errorMessageCPass.style.color = 'green';
            errorMessageCPass.innerHTML='&check; Password Format correct';
            return false;
        }

    }


}

// function validate_txn_num()
// {
//   var txnId = document.getElementById('txnId').value;
//   var spantxnId = document.getElementById('spantxnId');
//
//   if(txnId == "")
// 	{
// 		document.getElementById('txnId').style.border=" 1px solid red";
// 		spantxnId.innerHTML=" **Please fill the field";
// 		return false;
// 	}
// 	 else
//    {
//         spantxnId .style.display='none';
//          document.getElementById('txnId').style.border=" 1px solid green";
//    }
//     if((txnId.length<=3)||(txnId.length>20))
//     {
//     	document.getElementById('txnId').style.border= " 1px solid red";
// 		spantxnId.innerHTML=" ** please enter at least 3 characters";
// 		return false;
//     }
//      else
//    {
//          spantxnId.style.display='none';
//          document.getElementById('txnId').style.border=" 1px solid green";
//     }
// }
// function validate_date()
// {
// 	var from = document.getElementById('from').value;
// 	var spanfrom = document.getElementById('spanfrom');
// 	var to = document.getElementById('to').value;
// 	var spanto = document.getElementById('spanto');
// 	if(from =="")
// 	{
// 		document.getElementById('from').style.border=" 1px solid red";
// 		spanfrom.innerHTML=" **Please fill the field";
// 		return false;
// 	}
// 	 else
//    {
//         spanfrom .style.display='none';
//          document.getElementById('from').style.border=" 1px solid green";
//    }
//    if(to =="")
// 	{
// 		document.getElementById('to').style.border=" 1px solid red";
// 		spanto.innerHTML=" **Please fill the field";
// 		return false;
// 	}
// 	 else
//    {
//         spanto .style.display='none';
//          document.getElementById('to').style.border=" 1px solid green";
//    }
// }
// function validate_name()
// {
//   var name = document.getElementById('name').value;
//   var spanname = document.getElementById('spanname');
//
//   if(name == "")
//   {
//     document.getElementById('name').style.border=" 1px solid red";
//     spanname.innerHTML=" **Please fill the field";
//     return false;
//   }
//    else
//    {
//         spanname .style.display='none';
//          document.getElementById('name').style.border=" 1px solid green";
//    }
//     if((name.length<=3)||(name.length>20))
//     {
//       document.getElementById('name').style.border= " 1px solid red";
//     spantxnId.innerHTML=" ** please enter at least 3 characters";
//     return false;
//     }
//      else
//    {
//          spanname.style.display='none';
//          document.getElementById('name').style.border=" 1px solid green";
//     }
// }
// function add_money()
//     {
//         var add_ = document.getElementById('add_').value;
//         var spanadd_ = document.getElementById('add_').value;
//
//
//          if(add_ == "")
//             {
//                  document.getElementById('add_').style.border=" 1px solid red";
//                  spanadd_.innerHTML=" **Please fill the field";
//                  return false;
//              }
//     	 else
//    		{
//          spanadd_.style.display='none';
//          document.getElementById('add_').style.border=" 1px solid green";
//    		}
//    		if(add_ <=0)
//             {
//                  document.getElementById('add_').style.border=" 1px solid red";
//                  spanadd_.innerHTML=" **Please enter valid field";
//                  return false;
//              }
//    		  else
//    			{
//         	 spanadd_.style.display='none';
//          	document.getElementById('add_').style.border=" 1px solid green";
//   			 }
//    			 if(add_ >=100000)
//             {
//                  document.getElementById('add_').style.border=" 1px solid red";
//                  spanadd_.innerHTML=" **Please enter amount b/w 1-100000";
//                  return false;
//              }
//    			  else
//    			{
//          spanadd_.style.display='none';
//          document.getElementById('add_').style.border=" 1px solid green";
//   		 }
//         if(isNaN(add_))
//             {
//                  document.getElementById('add_').style.border=" 1px solid red";
//                  spanadd_.innerHTML=" **Please enter amount b/w 1-100000";
//                  return false;
//              }
//           else
//         {
//          spanadd_.style.display='none';
//          document.getElementById('add_').style.border=" 1px solid green";
//        }
//
//     }
//     function student_dashboard()
//     {
//     	var selection = document.getElementById('selection').value;
//       var add_ = document.getElementById('add_').value;
//         var spanadd_ = document.getElementById('add_').value;
//
//
//          if(add_ == "")
//             {
//                  document.getElementById('add_').style.border=" 1px solid red";
//                  spanadd_.innerHTML=" **Please fill the field";
//                  return false;
//              }
//        else
//       {
//          spanadd_.style.display='none';
//          document.getElementById('add_').style.border=" 1px solid green";
//       }
//       if(add_ <=0)
//             {
//                  document.getElementById('add_').style.border=" 1px solid red";
//                  spanadd_.innerHTML=" **Please enter valid field";
//                  return false;
//              }
//         else
//         {
//            spanadd_.style.display='none';
//           document.getElementById('add_').style.border=" 1px solid green";
//          }
//          if(add_ >=100000)
//             {
//                  document.getElementById('add_').style.border=" 1px solid red";
//                  spanadd_.innerHTML=" **Please enter amount b/w 1-100000";
//                  return false;
//              }
//           else
//         {
//          spanadd_.style.display='none';
//          document.getElementById('add_').style.border=" 1px solid green";
//        }
//        // if(isNaN(add_))
//        //      {
//        //           document.getElementById('add_').style.border=" 1px solid red";
//        //           spanadd_.innerHTML=" **";
//        //           return false;
//        //       }
//        //    else
//        //  {
//        //   spanadd_.style.display='none';
//        //   document.getElementById('add_').style.border=" 1px solid green";
//        // }
//
//     	  if(selection=="select")
//             {
//                  document.getElementById('selection').style.border=" 1px solid red";
//                  // spanselect.innerHTML=" **";
//                  return false;
//              }
//    			  else
//    			{
//          // spanselect.style.display='none';
//          document.getElementById('selection').style.border=" 1px solid green";
//   		 }
//
//     }
//     function validate_addadmin()
//     {
//       var name=document.getElementById('name').value;
//       var email=document.getElementById('email').value;
//       var password=document.getElementById('password').value;
//       var cpassword=document.getElementById('cpassword').value;
//       var dob=document.getElementById('dob').value;
//       var selection=document.getElementById('selection').value;
//       var spanemail = document.getElementById('spanemail');
//       var spanpassword = document.getElementById('spanpassword');
//       var spanname = document.getElementById('spanname');
//       var spandob = document.getElementById('spandob');
//       var spanselect = document.getElementById('spanselect');
//       var cspanpassword = document.getElementById('cspanpassword');
//
//     if(name == "")
//   {
//     document.getElementById('name').style.border=" 1px solid red";
//     spanname.innerHTML=" **Please fill the name field";
//     return false;
//   }
//    else
//    {
//          spanname.style.display='none';
//          document.getElementById('name').style.border=" 1px solid green";
//     }
//     if((name.length<=3)||(name.length>20))
//     {
//       document.getElementById('name').style.border= " 1px solid red";
//     spanname.innerHTML=" ** name length must be between 3 and 20";
//     return false;
//     }
//      else
//    {
//          spanname.style.display='none';
//          document.getElementById('name').style.border=" 1px solid green";
//     }
//     if(!isNaN(name))
//   {
//     document.getElementById('name').style.border=" 1px solid red";
//     spanname.innerHTML=" ** only characters are allowed";
//     return false;
//   }
//    else
//    {
//          spanname.style.display='none';
//          document.getElementById('name').style.border=" 1px solid green";
//     }
//
//
//       if(email == "")
//   {
//     document.getElementById('email').style.border=" 1px solid red";
//     spanemail.innerHTML=" **Please fill the email id field";
//     return false;
//   }
//    else
//    {
//          spanemail.style.display='none';
//          document.getElementById('email').style.border=" 1px solid green";
//    }
//      if(email.indexOf('@')<=0)
//   {
//     document.getElementById('email').style.border=" 1px solid red";
//     spanemail.innerHTML=" **incorrect position of @";
//     return false;
//   }
//       else
//    {
//          spanemail.style.display='none';
//          document.getElementById('email').style.border=" 1px solid green";
//      }
//      if((email.charAt(email.length-4)!='.') && (email.charAt(email.length-3)!='.'))
//   {
//     document.getElementById('email').style.border=" 1px solid red";
//     spanemail.innerHTML=" **incorrect position of .";
//     return false;
//   }
//       else
//    {
//          spanemail.style.display='none';
//          document.getElementById('email').style.border=" 1px solid green";
//      }
//   if(password == "")
//   {
//     document.getElementById('password').style.border=" 1px solid red";
//     spanpassword.innerHTML=" **Please fill the password field";
//     return false;
//   }
//    else
//    {
//          spanpassword.style.display='none';
//          document.getElementById('password').style.border=" 1px solid green";
//     }
//     if((password.length<=5)||(password.length>20))
//     {
//       document.getElementById('password').style.border= " 1px solid red";
//     spanpassword.innerHTML=" ** password length must be between 5 and 20";
//     return false;
//     }
//      else
//    {
//          spanpassword.style.display='none';
//          document.getElementById('password').style.border=" 1px solid green";
//     }
//      if(cpassword == "")
//   {
//     document.getElementById('cpassword').style.border=" 1px solid red";
//     cspanpassword.innerHTML=" **Please fill the password field";
//     return false;
//   }
//    else
//    {
//          spanpassword.style.display='none';
//          document.getElementById('password').style.border=" 1px solid green";
//     }
//     if((cpassword.length<=5)||(cpassword.length>20))
//     {
//       document.getElementById('cpassword').style.border= " 1px solid red";
//     cspanpassword.innerHTML=" ** password length must be between 5 and 20";
//     return false;
//     }
//      else
//    {
//          cspanpassword.style.display='none';
//          document.getElementById('cpassword').style.border=" 1px solid green";
//     }
//     if(password != cpassword)
//     {
//       document.getElementById('cpassword').style.border= " 1px solid red";
//     cspanpassword.innerHTML=" ** conform password and password must be same";
//     return false;
//     }
//      else
//    {
//          cspanpassword.style.display='none';
//          document.getElementById('cpassword').style.border=" 1px solid green";
//     }
//
//     if(selection=="select")
//             {
//                  document.getElementById('selection').style.border=" 1px solid red";
//                  spanselect.innerHTML=" ** please make a selection ";
//                  return false;
//              }
//           else
//         {
//          spanselect.style.display='none';
//          document.getElementById('selection').style.border=" 1px solid green";
//        }
//        if(dob=="")
//             {
//                  document.getElementById('dob').style.border=" 1px solid red";
//                  spandob.innerHTML=" ** please select a date";
//                  return false;
//              }
//           else
//         {
//          spandob.style.display='none';
//          document.getElementById('dob').style.border=" 1px solid green";
//        }
//     }
//     function validate_canteen()
//     {
//       var name=document.getElementById('name').value;
//       var cname=document.getElementById('cname').value;
//       var email=document.getElementById('email').value;
//       var password=document.getElementById('password').value;
//
//       var phone=document.getElementById('phone').value;
//       var user=document.getElementById('user').value;
//       var startdate=document.getElementById('startdate').value;
//       var expirydate=document.getElementById('expirydate').value;
//       var spanemail = document.getElementById('spanemail');
//       var spanpassword = document.getElementById('spanpassword');
//       var spanname = document.getElementById('spanname');
//       var spancname = document.getElementById('spancname');
//       var spansd = document.getElementById('spansd');
//        var spaned = document.getElementById('spaned');
//       var spanphone = document.getElementById('spanphone');
//        var spanuser = document.getElementById('spanuser');
//
//
//
//   if(name == "")
//   {
//     document.getElementById('name').style.border=" 1px solid red";
//     spanname.innerHTML=" **Please fill the name field";
//     return false;
//   }
//    else
//    {
//          spanname.style.display='none';
//          document.getElementById('name').style.border=" 1px solid green";
//     }
//     if((name.length<=3)||(name.length>20))
//     {
//       document.getElementById('name').style.border= " 1px solid red";
//     spanname.innerHTML=" ** name length must be between 3 and 20";
//     return false;
//     }
//      else
//    {
//          spanname.style.display='none';
//          document.getElementById('name').style.border=" 1px solid green";
//     }
//     if(!isNaN(name))
//   {
//     document.getElementById('name').style.border=" 1px solid red";
//     spanname.innerHTML=" ** only characters are allowed";
//     return false;
//   }
//    if(cname == "")
//   {
//     document.getElementById('cname').style.border=" 1px solid red";
//     spancname.innerHTML=" **Please fill the name field";
//     return false;
//   }
//    else
//    {
//          spancname.style.display='none';
//          document.getElementById('cname').style.border=" 1px solid green";
//     }
//     if((cname.length<=3)||(cname.length>20))
//     {
//       document.getElementById('cname').style.border= " 1px solid red";
//     spancname.innerHTML=" ** contractor name length must be between 3 and 20";
//     return false;
//     }
//      else
//    {
//          spancname.style.display='none';
//          document.getElementById('cname').style.border=" 1px solid green";
//     }
//     if(!isNaN(cname))
//   {
//     document.getElementById('cname').style.border=" 1px solid red";
//     spancname.innerHTML=" ** only characters are allowed";
//     return false;
//   }
//    else
//    {
//          spancname.style.display='none';
//          document.getElementById('cname').style.border=" 1px solid green";
//     }
//
//
//       if(email == "")
//   {
//     document.getElementById('email').style.border=" 1px solid red";
//     spanemail.innerHTML=" **Please fill the email id field";
//     return false;
//   }
//    else
//    {
//          spanemail.style.display='none';
//          document.getElementById('email').style.border=" 1px solid green";
//    }
//      if(email.indexOf('@')<=0)
//   {
//     document.getElementById('email').style.border=" 1px solid red";
//     spanemail.innerHTML=" **incorrect position of @";
//     return false;
//   }
//       else
//    {
//          spanemail.style.display='none';
//          document.getElementById('email').style.border=" 1px solid green";
//      }
//      if((email.charAt(email.length-4)!='.') && (email.charAt(email.length-3)!='.'))
//   {
//     document.getElementById('email').style.border=" 1px solid red";
//     spanemail.innerHTML=" **incorrect position of .";
//     return false;
//   }
//       else
//    {
//          spanemail.style.display='none';
//          document.getElementById('email').style.border=" 1px solid green";
//      }
//   if(password == "")
//   {
//     document.getElementById('password').style.border=" 1px solid red";
//     spanpassword.innerHTML=" **Please fill the password field";
//     return false;
//   }
//    else
//    {
//          spanpassword.style.display='none';
//          document.getElementById('password').style.border=" 1px solid green";
//     }
//     if((password.length<=5)||(password.length>20))
//     {
//       document.getElementById('password').style.border= " 1px solid red";
//     spanpassword.innerHTML=" ** password length must be between 5 and 20";
//     return false;
//     }
//      else
//    {
//          spanpassword.style.display='none';
//          document.getElementById('password').style.border=" 1px solid green";
//     }
//
//    if(user == "")
//   {
//     document.getElementById('user').style.border=" 1px solid red";
//     spanuser.innerHTML=" **Please fill the name field";
//     return false;
//   }
//    else
//    {
//          spanuser.style.display='none';
//          document.getElementById('user').style.border=" 1px solid green";
//     }
//     if((user.length<=3)||(user.length>20))
//     {
//       document.getElementById('user').style.border= " 1px solid red";
//     spanname.innerHTML=" ** username length must be between 3 and 20";
//     return false;
//     }
//      else
//    {
//          spanname.style.display='none';
//          document.getElementById('user').style.border=" 1px solid green";
//     }
//     if(phone == "")
//   {
//     document.getElementById('phone').style.border=" 1px solid red";
//     spanphone.innerHTML=" **Please fill the name field";
//     return false;
//   }
//    else
//    {
//          spanphone.style.display='none';
//          document.getElementById('phone').style.border=" 1px solid green";
//     }
//      if(isNaN(phone))
//   {
//     document.getElementById('phone').style.border=" 1px solid red";
//     spanphone.innerHTML=" **only numbers are allowed";
//     return false;
//   }
//    else
//    {
//          spanphone.style.display='none';
//          document.getElementById('phone').style.border=" 1px solid green";
//     }
//     if(phone.length!=10)
//   {
//     document.getElementById('phone').style.border=" 1px solid red";
//     spanphone.innerHTML=" **mobile number must be 10 digit only";
//     return false;
//   }
//    else
//    {
//          spanphone.style.display='none';
//          document.getElementById('phone').style.border=" 1px solid green";
//     }
//    if(startdate=="")
//             {
//                  document.getElementById('startdate').style.border=" 1px solid red";
//                  spansd.innerHTML=" ** please select a date";
//                  return false;
//              }
//           else
//         {
//          spansd.style.display='none';
//          document.getElementById('startdate').style.border=" 1px solid green";
//        }
//        if(expirydate=="")
//             {
//                  document.getElementById('expirydate').style.border=" 1px solid red";
//                  spaned.innerHTML=" ** please select a date";
//                  return false;
//              }
//           else
//         {
//          spaned.style.display='none';
//          document.getElementById('expirydate').style.border=" 1px solid green";
//        }
//
//
//     }
//
//
//   function  validate_addstock()
//   {
//     var date=document.getElementById('date').value;
//     var spandate = document.getElementById('spandate');
//      var quantity=document.getElementById('quantity').value;
//     var spanquantity = document.getElementById('spanquantity');
//     var name=document.getElementById('name').value;
//     var spanname = document.getElementById('spanname');
//     var number=document.getElementById('number').value;
//     var spannumber = document.getElementById('spannumber');
//      var sp=document.getElementById('sp').value;
//     var spansp = document.getElementById('spansp');
//      var cp=document.getElementById('cp').value;
//     var spancp = document.getElementById('spancp');
//     if(date=="")
//             {
//                  document.getElementById('date').style.border=" 1px solid red";
//                  spandate.innerHTML=" ** please select a date";
//                  return false;
//              }
//           else
//         {
//          spandate.style.display='none';
//          document.getElementById('date').style.border=" 1px solid green";
//        }
//        if(quantity=="")
//             {
//                  document.getElementById('quantity').style.border=" 1px solid red";
//                  spanquantity.innerHTML=" ** please select a date";
//                  return false;
//              }
//           else
//         {
//          spanquantity.style.display='none';
//          document.getElementById('quantity').style.border=" 1px solid green";
//        }
//        if(name == "")
//   {
//     document.getElementById('name').style.border=" 1px solid red";
//     spanname.innerHTML=" **Please fill the name field";
//     return false;
//   }
//    else
//    {
//          spanname.style.display='none';
//          document.getElementById('name').style.border=" 1px solid green";
//     }
//     if((name.length<=2   )||(name.length>20))
//     {
//       document.getElementById('name').style.border= " 1px solid red";
//     spanname.innerHTML=" ** name length must be between 3 and 20";
//     return false;
//     }
//      else
//    {
//          spanname.style.display='none';
//          document.getElementById('name').style.border=" 1px solid green";
//     }
//     if(!isNaN(name))
//   {
//     document.getElementById('name').style.border=" 1px solid red";
//     spanname.innerHTML=" ** only characters are allowed";
//     return false;
//   }
//    if(number == "")
//   {
//     document.getElementById('number').style.border=" 1px solid red";
//     spannumber.innerHTML=" **Please fill the name field";
//     return false;
//   }
//    else
//    {
//          spannumber.style.display='none';
//          document.getElementById('number').style.border=" 1px solid green";
//     }
//     if((number.length<=1)||(number.length>20))
//     {
//       document.getElementById('number').style.border= " 1px solid red";
//     spannumber.innerHTML=" ** name length must be between 3 and 20";
//     return false;
//     }
//      else
//    {
//          spannumber.style.display='none';
//          document.getElementById('number').style.border=" 1px solid green";
//     }
//      if(cp == "")
//   {
//     document.getElementById('cp').style.border=" 1px solid red";
//     spancp.innerHTML=" **Please fill the name field";
//     return false;
//   }
//    else
//    {
//          spancp.style.display='none';
//          document.getElementById('cp').style.border=" 1px solid green";
//     }
//
//     if(isNaN(cp))
//   {
//     document.getElementById('cp').style.border=" 1px solid red";
//     spancp.innerHTML=" ** only characters are allowed";
//     return false;
//   }
//   else
//    {
//          spancp.style.display='none';
//          document.getElementById('cp').style.border=" 1px solid green";
//     }
//    if(sp == "")
//   {
//     document.getElementById('sp').style.border=" 1px solid red";
//     spansp.innerHTML=" **Please fill the name field";
//     return false;
//   }
//    else
//    {
//          spansp.style.display='none';
//          document.getElementById('sp').style.border=" 1px solid green";
//     }
//
//     if(!isNaN(sp))
//   {
//     document.getElementById('sp').style.border=" 1px solid red";
//     spansp.innerHTML=" ** only characters are allowed";
//     return false;
//   }
//    else
//    {
//          spansp.style.display='none';
//          document.getElementById('sp').style.border=" 1px solid green";
//     }
//   }
<?php

if (!isset($_SESSION)) {
    session_start();
}

?>
<script type="text/javascript">
    //ask delete confirmation
    function ask_delete(deletable) {
        var x = confirm("Do you want to delete " + deletable + " record?");
        if (x) {
            return true;
        } else {
            return false;
        }
    }


    //this is for number validation
    function isNumberKey(evt) // only numbers to allow the input field
    {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }

    //this is for text validation
    function isTextKey(evt) // only text to allow the input field
    {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8 || charCode == 127 || charCode == 32 || charCode == 46) && (!(evt.ctrlKey && (charCode == 118 || charCode == 86))))
            return true;

        return false;
    }

    //mobile number validation
    function phonenumber(txtmobile) // Mobile No 
    {
        var phoneno = /^\d{10}$/;
        if (document.getElementById(txtmobile).value == "") {} else {
            if (document.getElementById(txtmobile).value.match(phoneno)) {
                hand(txtmobile);
            } else {
                alert("Enter 10 digit Mobile Number");
                document.getElementById(txtmobile).value = "";
                document.getElementById(txtmobile).focus() = true;
                return false;
            }
        }
    }

    function hand(txtmobile) {
        var str = document.getElementById(txtmobile).value;
        var res = str.substring(0, 2);
        if (res == "07") {
            return true;
        } else {
            alert("Enter 10 digit of Mobile Number start with 07xxxxxxxx");
            document.getElementById(txtmobile).value = "";
            document.getElementById(txtmobile).focus() = true;
            return false;
        }
    }


    //check email validation format
    function emailvalidation() {
        var email = document.getElementById("txtemail").value;
        var emailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (email.match(emailformat)) {

        } else if (email.length == 0) {

        } else {
            alert("Email Address is Invalid");
            document.getElementById("txtemail").value = "";
            document.getElementById("txtemail").focus() = true;
        }
    }

     //check email validation format
     function lgemailvalidation() {
        var lgemail = document.getElementById("txtusername").value;
        var emailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (lgemail.match(emailformat)) {

        } else if (lgemail.length == 0) {

        } else {
            alert("Email Address is Invalid");
            document.getElementById("txtusername").value = "";
            document.getElementById("txtusername").focus() = true;
        }
    }
</script>
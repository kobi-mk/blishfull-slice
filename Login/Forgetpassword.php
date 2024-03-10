<?php

if (!isset($_SESSION)) {
    session_start();
}

include("db_connection.php");

if (isset($_POST["btnrecover"])) {
    $enterusername = $_POST["txtusername"];
    $entermobilenumber = $_POST["txtmobilenumber"];

    $sqlusername = "SELECT * FROM user WHERE user_name = '$enterusername'";
    $resultusername = mysqli_query($connect, $sqlusername) or die("sql error in sqlusername" . mysqli_error($connect));
    if (mysqli_num_rows($resultusername) == 1) {   //USERNAME CORRECT
        $rowusername = mysqli_fetch_assoc($resultusername);

        if ($rowusername["user_type"] == "Customer") {
            $sqlmobile = "SELECT mobile FROM customer WHERE email ='$enterusername'";
        } 
        else {
            $sqlmobile = "SELECT mobile FROM staff WHERE email ='$enterusername'";
        }

        $resultmobile = mysqli_query($connect, $sqlmobile) or die("sql error in sqlmobile" . mysqli_error($connect));
        $rowmobile = mysqli_fetch_assoc($resultmobile);

        if ($rowmobile["mobile"] == $entermobilenumber) { //IF MOBILE NUMBER IS CORRECT
            //Random code generate
            $verificationcode = rand(1000, 9999);
            //UPDATE to database
            $sqlupdate = "UPDATE user SET otp='$verificationcode' WHERE user_name='$enterusername'";
            $resultupdate = mysqli_query($connect, $sqlupdate) or die("sql error in sqlupdate" . mysqli_error($connect));

            //SMS - Send Code
            $user = "94769669804";//textit.biz username
            $password = "3100";//textit.biz password
            $text = urlencode("BlissfulSlice verification code is : ".$verificationcode);//message
            $to = "94".$rowmobile["mobile"];//sender number

            $baseurl = "http://www.textit.biz/sendmsg";
            $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
            $ret = file($url);

            $res = explode(":", $ret[0]);

            if (trim($res[0]) == "OK") 
            {//Message send
                if(isset($_SESSION["forgetusername"]))
                {
                    unset($_SESSION["forgetusername"]);
                }
                $_SESSION["verificationcode_username"]=$rowusername["user_name"];
                echo '<script>alert("Please check your mobile number"); window.location.href="index.php?Login=Login/Verificationcode.php";</script>';
            } 
            else 
            {//Message not send
                echo '<script>alert("Please check your internet connection");</script>';
            }
        } 
        else { //IF MOBILE NUMBER IS INCORRECT
            echo '<script>alert("Sorry Mobile Number Is Wrong");</script>';
        }
    } 
    else {   //USERNAME INCORRECT
        echo '<script>alert("Sorry There Is No Such UserName");</script>';
    }
}

if (isset($_SESSION["forgetusername"])) { //USER COME FROM LOGIN AFTER 3 ATTEMPTS
    $username = $_SESSION["forgetusername"];
    $readonlystatus = "readonly";
} else { //USER COME FROM FORGETPASSWORD LINK
    $username = "";
    $readonlystatus = "";
}

?>
<!-- Forgetpassword Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <form action="#" method="POST">
            <div class="row g-5">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="col-md-12 mx-auto col-lg-4">
                        <div class="form-item w-100">
                            <label class="form-label my-3">User Name<sup>*</sup></label>
                            <input type="text" class="form-control" placeholder="example@blissfulslice.com" value="<?php echo $username; ?>" <?php echo $readonlystatus; ?> name="txtusername" id="txtusername" onblur="lgemailvalidation()">
                        </div>
                    </div>
                    <div class="col-md-12 mx-auto col-lg-4">
                        <div class="form-item w-100">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <input type="text" class="form-control" placeholder="07xxxxxxxx" name="txtmobilenumber" id="txtmobilenumber" onkeypress="return isNumberKey(event)" onblur="phonenumber('txtmobilenumber')">
                        </div>
                    </div>
                    <div class=" d-grid col-2 mx-auto pt-4 ">
                        <button type="submit" name="btnrecover" id="btnrecover" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Recover</button>
                    </div>
                    <div class=" d-grid col-2 mx-auto pt-2 ">
                        <button type="reset" name="btnclear" id="btnclear" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Clear</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Forgetpassword Page End -->
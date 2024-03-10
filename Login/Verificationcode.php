<?php

if (!isset($_SESSION)) {
    session_start();
}

if(isset($_SESSION["verificationcode_username"]))
{
    
    include("db_connection.php");
    if(isset($_POST["btnverify"]))
    {
        $entercode=$_POST["txtcode"];
        $enterusername=$_SESSION["verificationcode_username"];

        $sqlcode="SELECT otp FROM user WHERE user_name='$enterusername'";
        $resultcode=mysqli_query($connect, $sqlcode) or die("sql error in sqlcode" . mysqli_error($connect));
        $rowcode=mysqli_fetch_assoc($resultcode);

        if($rowcode["otp"] == $entercode)
        {// If code is correct
            unset($_SESSION["verificationcode_username"]);
            $_SESSION["forgetchange_username"]=$enterusername;
            echo '<script>alert("Please Change Your Password");</script>';
            echo '<script>window.location.href="index.php?Login=Login/Forgetchangepassword.php";</script>'; 
        }
        else
        {// If code is wrong
            echo '<script>alert("Your Code Is Wrong");</script>';
        }
    }


?>
<!-- Verificationcode Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <form action="#" method="POST">
            <div class="row g-5">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="col-md-12 mx-auto col-lg-4">
                        <div class="form-item w-100">
                            <label class="form-label my-3">Code<sup>*</sup></label>
                            <input type="text" class="form-control" placeholder="enter the OTP code here" name="txtcode" id="txtcode" onkeypress="return isNumberKey(event)">
                        </div>
                    </div>
                    <div class=" d-grid col-2 mx-auto pt-4 ">
                        <button type="submit" name="btnverify" id="btnverify" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Verify</button>
                    </div>
                    <div class=" d-grid col-2 mx-auto pt-2 ">
                        <button type="reset" name="btnclear" id="btnclear" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Clear</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Verificationcode Page End -->
<?php
}
else 
{//LOCATION CHANGE TO FORGETPASSWORD.PHP
    echo '<script>window.location.href="index.php?Login=Login/Forgetpassword.php";</script>'; 
}

?>
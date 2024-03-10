<?php

if (!isset($_SESSION)) {
    session_start();
}

if(isset($_SESSION["forgetchange_username"]))
{
    
    include("db_connection.php");
    $enterusername=$_SESSION["forgetchange_username"];
    if(isset($_POST["btnchangepassword"]))
    {
        $newpassword=md5($_POST["txtnewpassword"]);
        $confirmnewpassword=md5($_POST["txtcnewpassword"]);

        if($newpassword==$confirmnewpassword)
        {
             //UPDATE to database
             $sqlupdate = "UPDATE user SET password='$newpassword' WHERE user_name='$enterusername'";
             $resultupdate = mysqli_query($connect, $sqlupdate) or die("sql error in sqlupdate" . mysqli_error($connect));
             unset($_SESSION["forgetchange_username"]);
             echo '<script>alert("Your new password is updated, please login with new password");</script>';
             echo '<script>window.location.href="index.php?Login=Login/Login.php";</script>'; 
        }
        else
        {
            echo '<script>alert("Sorry, your passwords are miss match!!!");</script>'; 
        }
    }



?>
<script>
    function check_password()
    {
        var newpassword = document.getElementById("txtnewpassword").value
        var cnewpassword = document.getElementById("txtcnewpassword").value
        if(newpassword==cnewpassword)
        {
            return true;
        }
        else
        {
            alert("Sorry, your passwords are miss match!!!");
            document.getElementById("txtnewpassword").value="";
            document.getElementById("txtcnewpassword").value="";
            return false;

        }
    }
</script>
<!-- Forgetchangepassword Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <form action="#" method="POST" onsubmit="return check_password()" >
            <div class="row g-5">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="col-md-12 mx-auto col-lg-4">
                        <div class="form-item w-100">
                            <label class="form-label my-3">User Name<sup>*</sup></label>
                            <input type="text" class="form-control" placeholder="example@blissfulslice.com" name="txtusername" id="txtusername" onblur = "lgemailvalidation()" value="<?php echo $enterusername; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-12 mx-auto col-lg-4">
                        <div class="form-item w-100">
                            <label class="form-label my-3">New Password<sup>*</sup></label>
                            <input type="password" class="form-control" placeholder="********" name="txtnewpassword" id="txtnewpassword">
                        </div>
                    </div>
                    <div class="col-md-12 mx-auto col-lg-4">
                        <div class="form-item w-100">
                            <label class="form-label my-3">Confirm New Password<sup>*</sup></label>
                            <input type="password" class="form-control" placeholder="********" name="txtcnewpassword" id="txtcnewpassword">
                        </div>
                    </div>
                    <div class=" d-grid col-2 mx-auto pt-4 ">
                        <button type="submit" name="btnchangepassword" id="btnchangepassword" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Change Password</button>
                    </div>
                    <div class=" d-grid col-2 mx-auto pt-2 ">
                        <button type="reset" name="btnclear" id="btnclear" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Clear</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Forgetchangepassword Page End -->
<?php
}
else
{//LOCATION CHANGE TO FORGETPASSWORD.PHP
    echo '<script>window.location.href="index.php?Login=Login/Forgetpassword.php";</script>'; 
}
?>
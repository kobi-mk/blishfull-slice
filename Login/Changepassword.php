<?php

if (!isset($_SESSION)) {
    session_start();
}
if(isset($_SESSION["login_usertype"]))
{//someone login into system
    $system_usertype=$_SESSION["login_usertype"];
    $system_username=$_SESSION["login_username"];
    $system_userid=$_SESSION["login_userid"];
}
else
{//guest or public
    $system_usertype="Guest";
}
if($system_usertype!="Guest")
{
include("db_connection.php");

    if(isset($_POST["btnchangepassword"]))
    {
        $currentpassword=md5($_POST["txtpassword"]);
        $newpassword=md5($_POST["txtnewpassword"]);
        $confirmnewpassword=md5($_POST["txtcnewpassword"]);

        $sqlpassword = "SELECT password FROM user WHERE user_name='$system_username' ";
        $resultpassword=mysqli_query($connect, $sqlpassword) or die("sql error in sqlpassword" . mysqli_error($connect));
        $rowpassword=mysqli_fetch_assoc($resultpassword);

        if($rowpassword["password"]==$currentpassword)
        {//current password correct
            if($newpassword==$confirmnewpassword) 
            {//UPDATE to database
                $sqlupdate = "UPDATE user SET password='$newpassword' WHERE user_name='$system_username'";
                $resultupdate = mysqli_query($connect, $sqlupdate) or die("sql error in sqlupdate" . mysqli_error($connect));
                session_destroy();
                echo '<script>alert("Your new password is updated, please login with new password");</script>';
                 echo '<script>window.location.href="index.php?Login=Login/Login.php";</script>'; 
            }
            else
            {
                echo '<script>alert("Sorry, your new passwords are miss match!!!");</script>'; 
            }
        }
        else
        {//current password incorrect
            echo '<script>alert("Sorry, your current password is wrong!!!");</script>'; 
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
        <form action="#" method="POST" onsubmit="return check_password()">
            <div class="row g-5">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="col-md-12 mx-auto col-lg-4">
                        <div class="form-item w-100">
                            <label class="form-label my-3">User Name<sup>*</sup></label>
                            <input type="text" class="form-control" placeholder="example@blissfulslice.com" name="txtusername" id="txtusername" onblur = "lgemailvalidation()" value="<?php echo $system_username; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-12 mx-auto col-lg-4">
                        <div class="form-item w-100">
                            <label class="form-label my-3">Current Password<sup>*</sup></label>
                            <input type="password" class="form-control" placeholder="********" name="txtpassword" id="txtpassword">
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
{
    echo '<script>window.location.href="index.php";</script>';  
}

?>
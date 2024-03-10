<?php

if (!isset($_SESSION)) {
    session_start();
}

include("db_connection.php");
// login submit start
if(isset($_POST["btnlogin"]))
{
    $enterusername = $_POST["txtusername"];
    $enterpassword = md5($_POST["txtpassword"]);

    $sqlusername="SELECT * FROM user WHERE user_name = '$enterusername'";
    $resultusername = mysqli_query($connect, $sqlusername) or die("sql error in sqlusername" . mysqli_error($connect));
    if(mysqli_num_rows($resultusername)==1)
    {   //USERNAME CORRECT
        $rowusername=mysqli_fetch_assoc($resultusername);

        $sqlpassword ="SELECT * FROM user WHERE user_name = '$enterusername' AND password ='$enterpassword'";
        $resultpassword = mysqli_query($connect, $sqlpassword) or die("sql error in sqlpassword" . mysqli_error($connect));
        if(mysqli_num_rows($resultpassword)==1)
        {   //USERNAME AND PASSWORD BOTH ARE CORRECT
            $sqlupdate = "UPDATE user SET attempt=0 WHERE user_name = '$enterusername'";
            $resultupdate = mysqli_query($connect, $sqlupdate) or die("sql error in sqlupdate" . mysqli_error($connect));

            if($rowusername["status"]=="Active")
            {
                $_SESSION["login_username"]=$rowusername["user_name"];
                $_SESSION["login_userid"]=$rowusername["user_id"];
                $_SESSION["login_usertype"]=$rowusername["user_type"];
                echo '<script>window.location.href="index.php";</script>';
            }
            else
            {
                echo '<script>alert("Sorry Your Account Is Deleted");</script>';
            }
            
        }
        else if($rowusername["attempt"]<3)
        {   //USERNAME CORRECT , PASSWORD INCORRECT BUT ATTEMPT LESS THAN 3
            $sqlupdate = "UPDATE user SET attempt=attempt+1 WHERE user_name = '$enterusername'";
            $resultupdate = mysqli_query($connect, $sqlupdate) or die("sql error in sqlupdate" . mysqli_error($connect));
            echo '<script>alert("Sorry Your Password Is Wrong");</script>';

        }
        else
        {   //USERNAME CORRECT , PASSWORD INCORRECT BUT ATTEMPT GREATER THAN 3
            $_SESSION["forgetusername"]=$rowusername["user_name"];
            echo '<script>alert("Sorry You Try More Than 3 Times, Please Recover Your Password"); window.location.href="index.php?Login=Login/Forgetpassword.php";</script>';


        }
    }
    else
    {   //USERNAME INCORRECT
        echo '<script>alert("Sorry There Is No Such UserName");</script>';
    }

}
// login submit end
?>
<!-- Login Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <form action="#" method="POST">
            <div class="row g-5">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="col-md-12 mx-auto col-lg-4">
                        <div class="form-item w-100">
                            <label class="form-label my-3">User Name<sup>*</sup></label>
                            <input type="text" class="form-control" placeholder="example@blissfulslice.com" name="txtusername" id="txtusername" onblur = "lgemailvalidation()">
                        </div>
                    </div>
                    <div class="col-md-12 mx-auto col-lg-4">
                        <div class="form-item w-100">
                            <label class="form-label my-3">Password<sup>*</sup></label>
                            <input type="password" class="form-control" placeholder="********" name="txtpassword" id="txtpassword">
                        </div>
                    </div>
                    <div class=" d-grid col-2 mx-auto pt-4 ">
                        <button type="submit" name="btnlogin" id="btnlogin" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Login</button>
                    </div>
                    <div class=" d-grid col-2 mx-auto pt-2 ">
                        <button type="reset" name="btnclear" id="btnclear" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Clear</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Login Page End -->
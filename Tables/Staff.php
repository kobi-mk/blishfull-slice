<?php

if (!isset($_SESSION)) {
    session_start();
}

include("db_connection.php");

if (isset($_GET["option"])) {
?>

    <!-- ADD -->
    <?php
    if ($_GET["option"] == "add") {
    ?>
        <!-- Staff Add Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Staff.php&option=insert" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Staff ID<sup>*</sup></label>
                                        <?php
                                            $sqlgenerateid="SELECT staff_id FROM staff ORDER BY staff_id DESC LIMIT 1";
                                            $resultgenerateid = mysqli_query($connect, $sqlgenerateid) or die("sql error in sqlgenerateid" . mysqli_error($connect));
                                            if(mysqli_num_rows($resultgenerateid)==1)
                                            {
                                                $rowgenerateid=mysqli_fetch_assoc($resultgenerateid);
                                                $generateid=++$rowgenerateid["staff_id"];
                                            }
                                            else
                                            {//for first time
                                                $generateid="STAFF001";
                                            }
                                        ?>
                                        <input type="text" class="form-control" placeholder="staff000" name="txtstaffid" value="<?php echo $generateid; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Name<sup>*</sup></label>
                                        <input type="text" class="form-control" placeholder="staff name" name="txtname" onkeypress="return isTextKey(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Mobile<sup>*</sup></label>
                                        <input type="text" class="form-control" name="txtmobile" id="txtmobile" onkeypress="return isNumberKey(event)" onblur = "phonenumber('txtmobile')">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Email<sup>*</sup></label>
                                        <input type="email" class="form-control" placeholder="@example.com" name="txtemail" id="txtemail" onblur = "emailvalidation()">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Gender<sup>*</sup></label>
                                        <select class="form-select" aria-label="Default select example" name="txtgender">
                                            <option selected disabled>Choose One</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Designation<sup>*</sup></label>
                                        <select class="form-select" aria-label="Default select example" name="txtdesignaction">
                                            <option selected disabled>Please Select</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Clark">Clark</option>
                                            <option value="DeliveryBoy">Delivery Boy</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Address<sup>*</sup></label>
                                <input type="text" class="form-control" name="txtaddress">
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnsubmit" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Submit</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Staff.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Staff Add Page End -->
    <?php
    }
    ?>

    <!-- INSERT -->
    <?php
    if ($_GET["option"] == "insert") {

    ?>
        <!-- Staff Insert Page Start -->

        <?php
        if (isset($_POST["btnsubmit"])) 
        {
            $sqlinsert = "INSERT INTO staff(staff_id,name,mobile,email,address,gender,designaction) 
            VALUES('" . mysqli_real_escape_string($connect, $_POST["txtstaffid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtname"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtmobile"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtemail"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtaddress"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtgender"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtdesignaction"]) . "')";

            $resultinsert = mysqli_query($connect, $sqlinsert) or die("sql error in sqlinsert" . mysqli_error($connect));

            $password=md5($_POST["txtmobile"]);
            $sqlinsertlogin = "INSERT INTO user(user_id,user_name,user_type,attempt,password,otp,status) 
            VALUES('" . mysqli_real_escape_string($connect, $_POST["txtstaffid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtemail"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtdesignaction"]) . "',
            '" . mysqli_real_escape_string($connect, 0) . "',
            '" . mysqli_real_escape_string($connect, $password) . "',
            '" . mysqli_real_escape_string($connect, 0) . "',
            '" . mysqli_real_escape_string($connect, "Active") . "')";

            $resultinsertlogin = mysqli_query($connect, $sqlinsertlogin) or die("sql error in sqlinsertlogin" . mysqli_error($connect));
            if ($resultinsert) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Staff.php&option=add";</script>';
            }
        } 
        else 
        {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Staff Insert Page End -->
    <?php
    }
    ?>


    <!-- VIEW -->
    <?php
    if ($_GET["option"] == "view") {

    ?>
        <!-- Staff view Page Start -->
        <section>
            <!-- DATA TABLE -->

            <!-- Favicon icon -->
            <link rel="icon" type="image/png" sizes="16x16" href="./tbl/ast/favicon.png">
            <!-- Datatable -->
            <link href="./tbl/ast/jquery.dataTables.min.css" rel="stylesheet">
            <!-- Custom Stylesheet -->
            <!-- <link href="./tbl/ast/style.css" rel="stylesheet"> -->

            <div class="container ">
                <div class="row">
                    <div class="col-md-12 col-sm-10 mx-auto mt-2 ">
                        <div class="card">
                            <div class="card-header bg-dark ">
                                <div class="card-title">
                                    <h4 class="float-start text-primary ">List Of Staffs</h4>
                                    <a href="index.php?Tables=Tables/Staff.php&option=add"><button type="button" class="card-title float-end btn btn-outline-primary py-2 text-uppercase">Add Staff</button></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 500px">
                                        <thead>
                                            <tr>
                                                <th>Staff ID</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Gender</th>
                                                <th>Designaction</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $sqlview = "SELECT staff_id,name,mobile,email,address,gender,designaction FROM staff";
                                            $resultview = mysqli_query($connect, $sqlview) or die("sql error in sqlview" . mysqli_error($connect));

                                            while ($rowview = mysqli_fetch_assoc($resultview)) {
                                                echo '<tr>';
                                                echo '<td>' . $rowview["staff_id"] . '</td>';
                                                echo '<td>' . $rowview["name"] . '</td>';
                                                echo '<td>' . $rowview["mobile"] . '</td>';
                                                echo '<td>' . $rowview["email"] . '</td>';
                                                echo '<td>' . $rowview["address"] . '</td>';
                                                echo '<td>' . $rowview["gender"] . '</td>';
                                                echo '<td>' . $rowview["designaction"] . '</td>';
                                                echo '<td>';
                                                echo '<div class="d-flex align-items-center pt-3">
                                                        <a class="btn btn-outline-info me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Staff.php&option=fullview&pk1=' . $rowview["staff_id"] . '"><i class="fas fa-eye"></i></a>
                                                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Staff.php&option=edit&pk1=' . $rowview["staff_id"] . '"><i class="fas fa-edit"></i></a>'; ?>
                                                        <a class="btn btn-outline-danger btn-md-square rounded-circle" onclick="return ask_delete('<?php echo $rowview["name"]; ?>')" href="index.php?Tables=Tables/Staff.php&option=delete&pk1=<?php echo $rowview["staff_id"]; ?>"><i class="fas fa-trash"></i></a>
                                                    </div>
                                            <?php
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Staff ID</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Gender</th>
                                                <th>Designaction</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- DATA TABLE -->
            <!-- Required vendors -->
            <script src="./tbl/ast/global.min.js"></script>
            <script src="./tbl/ast/quixnav-init.js"></script>
            <script src="./tbl/ast/custom.min.js"></script>



            <!-- Datatable -->
            <script src="./tbl/ast/jquery.dataTables.min.js"></script>
            <script src="./tbl/ast/datatables.init.js"></script>
        </section>
        <!-- Staff view Page End -->
    <?php
    }
    ?>


    <!-- DELETE -->
    <?php
    if ($_GET["option"] == "delete") {

    ?>
        <!-- Staff Delete Page Start -->
        <?php

        $userid = $_GET["pk1"];

        $sqldelete = "DELETE FROM staff WHERE staff_id='$userid'";
        $resultview = mysqli_query($connect, $sqldelete) or die("sql error in sqldelete" . mysqli_error($connect));
        if ($resultview) {
            echo '<script>alert("Successfully Deleted"); window.location.href="index.php?Tables=Tables/Staff.php&option=view";</script>';
        }
        ?>

        <!-- Staff Delete Page End -->
    <?php
    }
    ?>


    <!-- FULL VIEW -->
    <?php
    if ($_GET["option"] == "fullview") {

    ?>
        <?php

        $userid = $_GET["pk1"];

        $sqlfullview = "SELECT * FROM staff WHERE staff_id='$userid'";
        $resultfullview = mysqli_query($connect, $sqlfullview) or die("sql error in sqlfullview" . mysqli_error($connect));
        $rowfullview = mysqli_fetch_assoc($resultfullview)
        ?>
        <!-- Staff Fullview Page Start -->

        <div class="col-sm-12 col-xl-6 mx-auto mt-4  ">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4 text-uppercase text-info text-al text-center ">Staff Full View</h6>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Staff ID</th>
                            <td><?php echo $rowfullview["staff_id"]; ?></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><?php echo $rowfullview["name"]; ?></td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td><?php echo $rowfullview["mobile"]; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $rowfullview["email"]; ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?php echo $rowfullview["address"]; ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?php echo $rowfullview["gender"]; ?></td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td><?php echo $rowfullview["designaction"]; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class=" d-grid gap-2 col-3 mx-auto pt-2 ">
                    <a href="index.php?Tables=Tables/Staff.php&option=view">
                        <button type="button" class="btn btn-outline-dark py-2 text-uppercase w-100">View</button>
                    </a>
                    <a href="index.php?Tables=Tables/Staff.php&option=edit&pk1=<?php echo $rowfullview["staff_id"]; ?>">
                        <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-secondary">Edit</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Staff Fullview Page End -->
    <?php
    }
    ?>


    <!-- EDIT -->
    <?php
    if ($_GET["option"] == "edit") {

    ?>
        <!-- Staff Edit Page Start -->

        <?php

        $userid = $_GET["pk1"];

        $sqledit = "SELECT * FROM staff WHERE staff_id='$userid'";
        $resultedit = mysqli_query($connect, $sqledit) or die("sql error in sqledit" . mysqli_error($connect));
        $rowedit = mysqli_fetch_assoc($resultedit)
        ?>

        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Staff.php&option=update" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Staff ID<sup>*</sup></label>
                                        <input type="text" class="form-control" value="<?php echo $rowedit["staff_id"]; ?>" name="txtstaffid">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Name<sup>*</sup></label>
                                        <input type="text" class="form-control" value="<?php echo $rowedit["name"]; ?>" name="txtname" onkeypress="return isTextKey(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Mobile<sup>*</sup></label>
                                        <input type="text" class="form-control" value="<?php echo $rowedit["mobile"]; ?>" id="txtmobile" name="txtmobile" onkeypress="return isNumberKey(event)" onblur = "phonenumber('txtmobile')">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Email<sup>*</sup></label>
                                        <input type="email" class="form-control" value="<?php echo $rowedit["email"]; ?>" id="txtemail" name="txtemail" onblur = "emailvalidation()">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Gender<sup>*</sup></label>
                                        <select class="form-select" aria-label="Default select example" value="<?php echo $rowedit["gender"]; ?>" name="txtgender">
                                            <option selected disabled>Choose One</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Designation<sup>*</sup></label>
                                        <select class="form-select" aria-label="Default select example" value="<?php echo $rowedit["designaction"]; ?>" name="txtdesignaction">
                                            <option selected disabled>Please Select</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Clark">Clark</option>
                                            <option value="Delivery Boy">Delivery Boy</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Address<sup>*</sup></label>
                                <input type="text" class="form-control" value="<?php echo $rowedit["address"]; ?>" name="txtaddress">
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnupdate" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Update</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Staff.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Staff Edit Page End -->
    <?php
    }
    ?>


    <!-- UPDATE -->
    <?php
    if ($_GET["option"] == "update") {

    ?>
        <!-- Staff Update Page Start -->

        <?php
        if (isset($_POST["btnupdate"])) {
            $sqlupdate = "UPDATE staff SET 
                            name = '" . mysqli_real_escape_string($connect, $_POST["txtname"]) . "',
                            mobile = '" . mysqli_real_escape_string($connect, $_POST["txtmobile"]) . "',
                            email = '" . mysqli_real_escape_string($connect, $_POST["txtemail"]) . "',
                            address = '" . mysqli_real_escape_string($connect, $_POST["txtaddress"]) . "',
                            gender = '" . mysqli_real_escape_string($connect, $_POST["txtgender"]) . "',
                            designaction = '" . mysqli_real_escape_string($connect, $_POST["txtdesignaction"]) . "'
                            WHERE staff_id = '" . mysqli_real_escape_string($connect, $_POST["txtstaffid"]) . "' ";

            $resultupdate = mysqli_query($connect, $sqlupdate) or die("sql error in sqlupdate" . mysqli_error($connect));
            if ($resultupdate) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Staff.php&option=view";</script>';
            }
        } else {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Staff Update Page End -->
    <?php
    }
    ?>


<?php
}
?>
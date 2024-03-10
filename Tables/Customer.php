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
        <!-- Customer Add Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Customer.php&option=insert" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Customer ID<sup>*</sup></label>
                                        <?php
                                            $sqlgenerateid="SELECT customer_id FROM customer ORDER BY customer_id DESC LIMIT 1";
                                            $resultgenerateid = mysqli_query($connect, $sqlgenerateid) or die("sql error in sqlgenerateid" . mysqli_error($connect));
                                            if(mysqli_num_rows($resultgenerateid)==1)
                                            {
                                                $rowgenerateid=mysqli_fetch_assoc($resultgenerateid);
                                                $generateid=++$rowgenerateid["customer_id"];
                                            }
                                            else
                                            {//for first time
                                                $generateid="CUSTOMER001";
                                            }
                                        ?>
                                        <input type="text" name="txtcustomerid" class="form-control" placeholder="CUSTOMER000" value="<?php echo $generateid; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Name<sup>*</sup></label>
                                        <input type="text" name="txtname" class="form-control" placeholder="customer name" onkeypress="return isTextKey(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Mobile<sup>*</sup></label>
                                        <input type="text" name="txtmobile" id="txtmobile" class="form-control" onkeypress="return isNumberKey(event)" onblur="phonenumber('txtmobile')">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Type<sup>*</sup></label>
                                        <select class="form-select" name="txtgender" aria-label="Default select example">
                                            <option selected disabled>Choose One</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Email<sup>*</sup></label>
                                <input type="email" name="txtemail" id="txtemail" class="form-control" placeholder="@example.com" onblur="emailvalidation()">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Address<sup>*</sup></label>
                                <input type="text" name="txtaddress" class="form-control">
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnsubmit" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Submit</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Customer.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <!-- Customer Page End -->
    <?php
    }
    ?>

    <!-- INSERT -->
    <?php
    if ($_GET["option"] == "insert") {

    ?>
        <!-- Customer Insert Page Start -->

        <?php
        if (isset($_POST["btnsubmit"])) {
            $sqlinsert = "INSERT INTO customer(customer_id,name,mobile,email,address,gender) 
            VALUES('" . mysqli_real_escape_string($connect, $_POST["txtcustomerid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtname"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtmobile"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtemail"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtaddress"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtgender"]) . "')";

            $resultinsert = mysqli_query($connect, $sqlinsert) or die("sql error in sqlinsert" . mysqli_error($connect));

            $password=md5($_POST["txtmobile"]);
            $sqlinsertlogin = "INSERT INTO user(user_id,user_name,user_type,attempt,password,otp,status) 
            VALUES('" . mysqli_real_escape_string($connect, $_POST["txtcustomerid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtemail"]) . "',
            '" . mysqli_real_escape_string($connect, "Customer") . "',
            '" . mysqli_real_escape_string($connect, 0) . "',
            '" . mysqli_real_escape_string($connect, $password) . "',
            '" . mysqli_real_escape_string($connect, 0) . "',
            '" . mysqli_real_escape_string($connect, "Active") . "')";

            $resultinsertlogin = mysqli_query($connect, $sqlinsertlogin) or die("sql error in sqlinsertlogin" . mysqli_error($connect));
            if ($resultinsert) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Customer.php&option=add";</script>';
            }
        } else {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Customer Insert Page End -->
    <?php
    }
    ?>

    <!-- VIEW -->
    <?php
    if ($_GET["option"] == "view") {

    ?>
        <!-- Customer view Page Start -->
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
                                    <h4 class="float-start text-primary ">List Of Customers</h4>
                                    <a href="index.php?Tables=Tables/Customer.php&option=add"><button type="button" class="card-title float-end btn btn-outline-primary py-2 text-uppercase">Add Customer</button></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 500px">
                                        <thead>
                                            <tr>
                                                <th>Customer ID</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Gender</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $sqlview = "SELECT customer_id,name,mobile,email,address,gender FROM customer";
                                            $resultview = mysqli_query($connect, $sqlview) or die("sql error in sqlview" . mysqli_error($connect));

                                            while ($rowview = mysqli_fetch_assoc($resultview)) {
                                                echo '<tr>';
                                                echo '<td>' . $rowview["customer_id"] . '</td>';
                                                echo '<td>' . $rowview["name"] . '</td>';
                                                echo '<td>' . $rowview["mobile"] . '</td>';
                                                echo '<td>' . $rowview["email"] . '</td>';
                                                echo '<td>' . $rowview["address"] . '</td>';
                                                echo '<td>' . $rowview["gender"] . '</td>';
                                                echo '<td>';
                                                echo '<div class="d-flex align-items-center pt-3">
                                                        <a class="btn btn-outline-info me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Customer.php&option=fullview&pk1=' . $rowview["customer_id"] . '"><i class="fas fa-eye"></i></a>
                                                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Customer.php&option=edit&pk1=' . $rowview["customer_id"] . '"><i class="fas fa-edit"></i></a>'; ?>
                                                        <a class="btn btn-outline-danger btn-md-square rounded-circle" onclick="return ask_delete('<?php echo $rowview["name"]; ?>')" href="index.php?Tables=Tables/Customer.php&option=delete&pk1=<?php echo $rowview["customer_id"]; ?>"><i class="fas fa-trash"></i></a>
                                                    </div>
                                            <?php
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Customer ID</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Gender</th>
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
        <!-- Customer view Page End -->
    <?php
    }
    ?>


    <!-- DELETE -->
    <?php
    if ($_GET["option"] == "delete") {

    ?>
        <!-- Customer Delete Page Start -->
        <?php

        $userid = $_GET["pk1"];

        $sqldelete = "DELETE FROM customer WHERE customer_id='$userid'";
        $resultview = mysqli_query($connect, $sqldelete) or die("sql error in sqldelete" . mysqli_error($connect));
        if ($resultview) {
            echo '<script>alert("Successfully Deleted"); window.location.href="index.php?Tables=Tables/Customer.php&option=view";</script>';
        }
        ?>

        <!-- Customer Delete Page End -->
    <?php
    }
    ?>


    <!-- FULL VIEW -->
    <?php
    if ($_GET["option"] == "fullview") {

    ?>
        <?php

        $userid = $_GET["pk1"];

        $sqlfullview = "SELECT * FROM customer WHERE customer_id='$userid'";
        $resultfullview = mysqli_query($connect, $sqlfullview) or die("sql error in sqlfullview" . mysqli_error($connect));
        $rowfullview = mysqli_fetch_assoc($resultfullview)
        ?>
        <!-- Customer Fullview Page Start -->

        <div class="col-sm-12 col-xl-6 mx-auto mt-4  ">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4 text-uppercase text-info text-al text-center ">Customer Full View</h6>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Customer ID</th>
                            <td><?php echo $rowfullview["customer_id"]; ?></td>
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
                    </tbody>
                </table>
                <div class=" d-grid gap-2 col-3 mx-auto pt-2 ">
                    <a href="index.php?Tables=Tables/Customer.php&option=view">
                        <button type="button" class="btn btn-outline-dark py-2 text-uppercase w-100">View</button>
                    </a>
                    <a href="index.php?Tables=Tables/Customer.php&option=edit&pk1=<?php echo $rowfullview["customer_id"]; ?>">
                        <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-secondary">Edit</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Customer Fullview Page End -->
    <?php
    }
    ?>


    <!-- EDIT -->
    <?php
    if ($_GET["option"] == "edit") {

    ?>
        <!-- Customer Edit Page Start -->

        <?php

        $userid = $_GET["pk1"];

        $sqledit = "SELECT * FROM customer WHERE customer_id='$userid'";
        $resultedit = mysqli_query($connect, $sqledit) or die("sql error in sqledit" . mysqli_error($connect));
        $rowedit = mysqli_fetch_assoc($resultedit)
        ?>

        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Customer.php&option=update" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Customer ID<sup>*</sup></label>
                                        <input type="text" name="txtcustomerid" class="form-control" value="<?php echo $rowedit["customer_id"]; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Name<sup>*</sup></label>
                                        <input type="text" name="txtname" class="form-control" value="<?php echo $rowedit["name"]; ?>" onkeypress="return isTextKey(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Mobile<sup>*</sup></label>
                                        <input type="text" name="txtmobile" id="txtmobile" class="form-control" value="<?php echo $rowedit["mobile"]; ?>" onkeypress="return isNumberKey(event)" onblur="phonenumber('txtmobile')">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Gender<sup>*</sup></label>
                                        <select class="form-select" name="txtgender" aria-label="Default select example" value="<?php echo $rowedit["gender"]; ?>" name="txtemail" onblur = "emailvalidation()">
                                            <option selected disabled>Choose One</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Email<sup>*</sup></label>
                                <input type="email" name="txtemail" id="txtemail" class="form-control" value="<?php echo $rowedit["email"]; ?>" name="txtemail">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Address<sup>*</sup></label>
                                <input type="text" name="txtaddress" class="form-control" value="<?php echo $rowedit["address"]; ?>">
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnupdate" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Update</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Customer.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Customer Edit Page End -->
    <?php
    }
    ?>


    <!-- UPDATE -->
    <?php
    if ($_GET["option"] == "update") {

    ?>
        <!-- Customer Update Page Start -->

        <?php
        if (isset($_POST["btnupdate"])) {
            $sqlupdate = "UPDATE customer SET 
                            name = '" . mysqli_real_escape_string($connect, $_POST["txtname"]) . "',
                            mobile = '" . mysqli_real_escape_string($connect, $_POST["txtmobile"]) . "',
                            email = '" . mysqli_real_escape_string($connect, $_POST["txtemail"]) . "',
                            address = '" . mysqli_real_escape_string($connect, $_POST["txtaddress"]) . "',
                            gender = '" . mysqli_real_escape_string($connect, $_POST["txtgender"]) . "'
                            WHERE customer_id = '" . mysqli_real_escape_string($connect, $_POST["txtcustomerid"]) . "' ";

            $resultupdate = mysqli_query($connect, $sqlupdate) or die("sql error in sqlupdate" . mysqli_error($connect));
            if ($resultupdate) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Customer.php&option=view";</script>';
            }
        } else {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Customer Update Page End -->
    <?php
    }
    ?>


<?php
}
?>
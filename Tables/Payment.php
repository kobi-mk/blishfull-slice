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
        <!-- Payment Add Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Payment.php&option=insert" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Payment ID<sup>*</sup></label>
                                        <?php
                                            $sqlgenerateid="SELECT payment_id FROM payment ORDER BY payment_id DESC LIMIT 1";
                                            $resultgenerateid = mysqli_query($connect, $sqlgenerateid) or die("sql error in sqlgenerateid" . mysqli_error($connect));
                                            if(mysqli_num_rows($resultgenerateid)==1)
                                            {
                                                $rowgenerateid=mysqli_fetch_assoc($resultgenerateid);
                                                $generateid=++$rowgenerateid["payment_id"];
                                            }
                                            else
                                            {//for first time
                                                $generateid="PAYMENT001";
                                            }
                                        ?>
                                        <input type="text" class="form-control" placeholder="payment000" name="txtpaymentid" value="<?php echo $generateid; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Order ID<sup>*</sup></label>
                                        <select class="form-control" placeholder="order000" name="txtorderid">
                                            <option value="select" selected disabled>Select Order ID</option>
                                            <?php
                                            $sqlload="SELECT order_id FROM orderdetail";
                                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                            while($rowload=mysqli_fetch_assoc($resultload))
                                            {
                                                echo '<option value="'.$rowload["order_id"].'">'.$rowload["order_id"].'</option>';
                                            }                                        
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Pay Date<sup>*</sup></label>
                                        <input type="date" class="form-control" name="txtpaydate">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Pay Amount<sup>*</sup></label>
                                        <input type="number" class="form-control" name="txtpayamount" onkeypress="return isNumberKey(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Pay Mode<sup>*</sup></label>
                                        <input type="text" class="form-control" placeholder="" name="txtpaymode">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Pay Status<sup>*</sup></label>
                                        <input type="text" class="form-control" placeholder="" name="txtpaystatus">
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Slip Photo<sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="location/photo.format" name="txtslipphoto">
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnsubmit" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Submit</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Payment.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <!-- Payment Add Page End -->
    <?php
    }
    ?>

    <!-- INSERT -->
    <?php
    if ($_GET["option"] == "insert") {

    ?>
        <!-- Payment Insert Page Start -->

        <?php
        if (isset($_POST["btnsubmit"])) 
        {
            $sqlinsert = "INSERT INTO payment(payment_id,order_id,pay_date,pay_amount,pay_mode,slip_photo,pay_status) 
            VALUES('" . mysqli_real_escape_string($connect, $_POST["txtpaymentid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtorderid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtpaydate"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtpayamount"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtpaymode"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtslipphoto"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtpaystatus"]) . "')";

            $resultinsert = mysqli_query($connect, $sqlinsert) or die("sql error in sqlinsert" . mysqli_error($connect));
            if ($resultinsert) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Payment.php&option=add";</script>';
            }
        } 
        else 
        {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Payment Insert Page End -->
    <?php
    }
    ?>


    <!-- VIEW -->
    <?php
    if ($_GET["option"] == "view") {

    ?>
        <!-- Payment view Page Start -->
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
                    <div class="col-md-11 col-sm-10 mx-auto mt-2 ">
                        <div class="card">
                            <div class="card-header bg-dark ">
                                <div class="card-title">
                                    <h4 class="float-start text-primary ">List Of Payments</h4>
                                    <a href="index.php?Tables=Tables/Payment.php&option=add"><button type="button" class="card-title float-end btn btn-outline-primary py-2 text-uppercase">Add Payment</button></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 500px">
                                        <thead>
                                            <tr>
                                                <th>Payment ID</th>
                                                <th>Order ID</th>
                                                <th>Pay Date</th>
                                                <th>Pay Amount</th>
                                                <th>Pay Mode</th>
                                                <th>Pay Status</th>
                                                <th>Slip Photo</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $sqlview = "SELECT payment_id,order_id,pay_date,pay_amount,pay_mode,slip_photo,pay_status FROM payment";
                                            $resultview = mysqli_query($connect, $sqlview) or die("sql error in sqlview" . mysqli_error($connect));

                                            while ($rowview = mysqli_fetch_assoc($resultview)) {
                                                echo '<tr>';
                                                echo '<td>' . $rowview["payment_id"] . '</td>';
                                                echo '<td>' . $rowview["order_id"] . '</td>';
                                                echo '<td>' . $rowview["pay_date"] . '</td>';
                                                echo '<td>' . $rowview["pay_amount"] . '</td>';
                                                echo '<td>' . $rowview["pay_mode"] . '</td>';
                                                echo '<td>' . $rowview["pay_status"] . '</td>';
                                                echo '<td>' . $rowview["slip_photo"] . '</td>';
                                                echo '<td>';
                                                echo '<div class="d-flex align-items-center pt-3">
                                                        <a class="btn btn-outline-info me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Payment.php&option=fullview&pk1=' . $rowview["payment_id"] . '"><i class="fas fa-eye"></i></a>
                                                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Payment.php&option=edit&pk1=' . $rowview["payment_id"] . '"><i class="fas fa-edit"></i></a>'; ?>
                                                        <a class="btn btn-outline-danger btn-md-square rounded-circle" onclick="return ask_delete('<?php echo $rowview["payment_id"]; ?>')" href="index.php?Tables=Tables/Payment.php&option=delete&pk1=<?php echo $rowview["payment_id"]; ?>"><i class="fas fa-trash"></i></a>
                                                    </div>
                                            <?php
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Payment ID</th>
                                                <th>Order ID</th>
                                                <th>Pay Date</th>
                                                <th>Pay Amount</th>
                                                <th>Pay Mode</th>
                                                <th>Pay Status</th>
                                                <th>Slip Photo</th>
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
        <!-- Payment view Page End -->
    <?php
    }
    ?>


    <!-- DELETE -->
    <?php
    if ($_GET["option"] == "delete") {

    ?>
        <!-- Payment Delete Page Start -->
        <?php

        $userid = $_GET["pk1"];

        $sqldelete = "DELETE FROM payment WHERE payment_id='$userid'";
        $resultview = mysqli_query($connect, $sqldelete) or die("sql error in sqldelete" . mysqli_error($connect));
        if ($resultview) {
            echo '<script>alert("Successfully Deleted"); window.location.href="index.php?Tables=Tables/Payment.php&option=view";</script>';
        }
        ?>

        <!-- Payment Delete Page End -->
    <?php
    }
    ?>


    <!-- FULL VIEW -->
    <?php
    if ($_GET["option"] == "fullview") {

    ?>
        <?php

        $userid = $_GET["pk1"];

        $sqlfullview = "SELECT * FROM payment WHERE payment_id='$userid'";
        $resultfullview = mysqli_query($connect, $sqlfullview) or die("sql error in sqlfullview" . mysqli_error($connect));
        $rowfullview = mysqli_fetch_assoc($resultfullview)
        ?>
        <!-- Payment Fullview Page Start -->

        <div class="col-sm-12 col-xl-6 mx-auto mt-4  ">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4 text-uppercase text-info text-al text-center ">Payment Full View</h6>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Payment ID</th>
                            <td><?php echo $rowfullview["payment_id"]; ?></td>
                        </tr>
                        <tr>
                            <th>Order ID</th>
                            <td><?php echo $rowfullview["order_id"]; ?></td>
                        </tr>
                        <tr>
                            <th>Pay Date</th>
                            <td><?php echo $rowfullview["pay_date"]; ?></td>
                        </tr>
                        <tr>
                            <th>Pay Amount</th>
                            <td><?php echo $rowfullview["pay_amount"]; ?></td>
                        </tr>
                        <tr>
                            <th>Pay Mode</th>
                            <td><?php echo $rowfullview["pay_mode"]; ?></td>
                        </tr>
                        <tr>
                            <th>Pay Status</th>
                            <td><?php echo $rowfullview["pay_status"]; ?></td>
                        </tr>
                        <tr>
                            <th>Slip Photo</th>
                            <td><?php echo $rowfullview["slip_photo"]; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class=" d-grid gap-2 col-3 mx-auto pt-2 ">
                    <a href="index.php?Tables=Tables/Payment.php&option=view">
                        <button type="button" class="btn btn-outline-dark py-2 text-uppercase w-100">View</button>
                    </a>
                    <a href="index.php?Tables=Tables/Payment.php&option=edit&pk1=<?php echo $rowfullview["payment_id"]; ?>">
                        <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-secondary">Edit</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Payment Fullview Page End -->
    <?php
    }
    ?>


    <!-- EDIT -->
    <?php
    if ($_GET["option"] == "edit") {

    ?>
        <!-- Payment Edit Page Start -->

        <?php

        $userid = $_GET["pk1"];

        $sqledit = "SELECT * FROM payment WHERE payment_id='$userid'";
        $resultedit = mysqli_query($connect, $sqledit) or die("sql error in sqledit" . mysqli_error($connect));
        $rowedit = mysqli_fetch_assoc($resultedit)
        ?>

        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Payment.php&option=update" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                        <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Payment ID<sup>*</sup></label>
                                        <input type="text" class="form-control" value="<?php echo $rowedit["payment_id"]; ?>" name="txtpaymentid" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Order ID<sup>*</sup></label>
                                        <select class="form-control" name="txtorderid">
                                            <?php
                                            $sqlload="SELECT order_id FROM orderdetail";
                                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                            while($rowload=mysqli_fetch_assoc($resultload))
                                            {
                                                if($rowload["order_id"]==$rowedit["order_id"])
                                                {
                                                    echo '<option selected value="'.$rowload["order_id"].'">'.$rowload["order_id"].'</option>';
                                                }
                                                else
                                                {
                                                    echo '<option value="'.$rowload["order_id"].'">'.$rowload["order_id"].'</option>';
                                                }
                                            
                                            }                                        
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Pay Date<sup>*</sup></label>
                                        <input type="date" class="form-control" value="<?php echo $rowedit["pay_date"]; ?>" name="txtpaydate">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Pay Amount<sup>*</sup></label>
                                        <input type="number" class="form-control" value="<?php echo $rowedit["pay_amount"]; ?>" name="txtpayamount" onkeypress="return isNumberKey(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Pay Mode<sup>*</sup></label>
                                        <input type="text" class="form-control" value="<?php echo $rowedit["pay_mode"]; ?>" name="txtpaymode">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Pay Status<sup>*</sup></label>
                                        <input type="text" class="form-control" value="<?php echo $rowedit["pay_status"]; ?>" name="txtpaystatus">
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Slip Photo<sup>*</sup></label>
                                <input type="text" class="form-control" value="<?php echo $rowedit["slip_photo"]; ?>" name="txtslipphoto">
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnupdate" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Update</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Payment.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Payment Edit Page End -->
    <?php
    }
    ?>


    <!-- UPDATE -->
    <?php
    if ($_GET["option"] == "update") {

    ?>
        <!-- Payment Update Page Start -->

        <?php
        if (isset($_POST["btnupdate"])) {
            $sqlupdate = "UPDATE payment SET 
                            order_id = '" . mysqli_real_escape_string($connect, $_POST["txtorderid"]) . "',
                            pay_date = '" . mysqli_real_escape_string($connect, $_POST["txtpaydate"]) . "',
                            pay_amount = '" . mysqli_real_escape_string($connect, $_POST["txtpayamount"]) . "',
                            pay_mode = '" . mysqli_real_escape_string($connect, $_POST["txtpaymode"]) . "',
                            pay_status = '" . mysqli_real_escape_string($connect, $_POST["txtpaystatus"]) . "',
                            slip_photo = '" . mysqli_real_escape_string($connect, $_POST["txtslipphoto"]) . "'
                            WHERE payment_id = '" . mysqli_real_escape_string($connect, $_POST["txtpaymentid"]) . "' ";

            $resultupdate = mysqli_query($connect, $sqlupdate) or die("sql error in sqlupdate" . mysqli_error($connect));
            if ($resultupdate) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Payment.php&option=view";</script>';
            }
        } else {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Payment Update Page End -->
    <?php
    }
    ?>


<?php
}
?>
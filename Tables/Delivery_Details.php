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
        <!-- Delivery_Details Add Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Delivery_Details.php&option=insert" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="form-item">
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
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Delivery Date<sup>*</sup></label>
                                        <input type="date" class="form-control" name="txtdeliverydate">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Delivery Time<sup>*</sup></label>
                                        <input type="time" class="form-control" name="txtdeliverytime">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Delivered By<sup>*</sup></label>
                                        <select  class="form-control" placeholder="staff000" name="txtdeliveredby" >
                                            <option value="select" selected disabled>Select Staff ID</option>
                                            <?php
                                            $sqlload="SELECT staff_id,name FROM staff";
                                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                            while($rowload=mysqli_fetch_assoc($resultload))
                                            {
                                                echo '<option value="'.$rowload["staff_id"].'">'.$rowload["name"].'</option>';
                                            }                                        
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Delivery Status<sup>*</sup></label>
                                        <input type="text" class="form-control" name="txtdeliverystatus">
                                    </div>
                                </div>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnsubmit" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Submit</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Delivery_Details.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Delivery_Details Add Page End -->
    <?php
    }
    ?>

    <!-- INSERT -->
    <?php
    if ($_GET["option"] == "insert") {

    ?>
        <!-- Delivery_Details Insert Page Start -->

        <?php
        if (isset($_POST["btnsubmit"])) 
        {
            $sqlinsert = "INSERT INTO deliverydetails(order_id,delivery_date,delivery_time,delivery_by,delivery_status) 
            VALUES('" . mysqli_real_escape_string($connect, $_POST["txtorderid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtdeliverydate"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtdeliverytime"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtdeliveredby"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtdeliverystatus"]) . "')";

            $resultinsert = mysqli_query($connect, $sqlinsert) or die("sql error in sqlinsert" . mysqli_error($connect));
            if ($resultinsert) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Delivery_Details.php&option=add";</script>';
            }
        } 
        else 
        {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Delivery_Details Insert Page End -->
    <?php
    }
    ?>


    <!-- VIEW -->
    <?php
    if ($_GET["option"] == "view") {

    ?>
        <!-- Delivery_Details view Page Start -->
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
                    <div class="col-md-10 col-sm-10 mx-auto mt-2 ">
                        <div class="card">
                            <div class="card-header bg-dark ">
                                <div class="card-title">
                                    <h4 class="float-start text-primary ">List Of Delivery Details</h4>
                                    <a href="index.php?Tables=Tables/Delivery_Details.php&option=add"><button type="button" class="card-title float-end btn btn-outline-primary py-2 text-uppercase">Add Delivery_Details</button></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 500px">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Delivery Date</th>
                                                <th>Delivery Time</th>
                                                <th>Delivered By</th>
                                                <th>Delivery Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $sqlview = "SELECT order_id,delivery_date,delivery_time,delivery_by,delivery_status FROM deliverydetails";
                                            $resultview = mysqli_query($connect, $sqlview) or die("sql error in sqlview" . mysqli_error($connect));

                                            while ($rowview = mysqli_fetch_assoc($resultview)) {
                                                echo '<tr>';
                                                echo '<td>' . $rowview["order_id"] . '</td>';
                                                echo '<td>' . $rowview["delivery_date"] . '</td>';
                                                echo '<td>' . $rowview["delivery_time"] . '</td>';
                                                $sqlload1 = "SELECT name FROM staff WHERE staff_id='$rowview[delivery_by]'";
                                                $resultload1 = mysqli_query($connect, $sqlload1) or die("sql error in sqlload1" . mysqli_error($connect));
                                                $rowload1 = mysqli_fetch_assoc($resultload1);
                                                echo '<td>' . $rowload1["name"] . '</td>'; 
                                                echo '<td>' . $rowview["delivery_status"] . '</td>';
                                                echo '<td>';
                                                echo '<div class="d-flex align-items-center pt-3">
                                                        <a class="btn btn-outline-info me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Delivery_Details.php&option=fullview&pk1=' . $rowview["order_id"] . '"><i class="fas fa-eye"></i></a>
                                                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Delivery_Details.php&option=edit&pk1=' . $rowview["order_id"] . '"><i class="fas fa-edit"></i></a>'; ?>
                                                        <a class="btn btn-outline-danger btn-md-square rounded-circle" onclick="return ask_delete('<?php echo $rowview["order_id"]; ?>')" href="index.php?Tables=Tables/Delivery_Details.php&option=delete&pk1=<?php echo $rowview["order_id"]; ?>"><i class="fas fa-trash"></i></a>
                                                    </div>
                                            <?php
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Delivery Date</th>
                                                <th>Delivery Time</th>
                                                <th>Delivered By</th>
                                                <th>Delivery Status</th>
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
        <!-- Delivery_Details view Page End -->
    <?php
    }
    ?>


    <!-- DELETE -->
    <?php
    if ($_GET["option"] == "delete") {

    ?>
        <!-- Delivery_Details Delete Page Start -->
        <?php

        $userid = $_GET["pk1"];

        $sqldelete = "DELETE FROM deliverydetails WHERE order_id='$userid'";
        $resultview = mysqli_query($connect, $sqldelete) or die("sql error in sqldelete" . mysqli_error($connect));
        if ($resultview) {
            echo '<script>alert("Successfully Deleted"); window.location.href="index.php?Tables=Tables/Delivery_Details.php&option=view";</script>';
        }
        ?>

        <!-- Delivery_Details Delete Page End -->
    <?php
    }
    ?>


    <!-- FULL VIEW -->
    <?php
    if ($_GET["option"] == "fullview") {

    ?>
        <?php

        $userid = $_GET["pk1"];

        $sqlfullview = "SELECT * FROM deliverydetails WHERE order_id='$userid'";
        $resultfullview = mysqli_query($connect, $sqlfullview) or die("sql error in sqlfullview" . mysqli_error($connect));
        $rowfullview = mysqli_fetch_assoc($resultfullview)
        ?>
        <!-- Delivery_Details Fullview Page Start -->

        <div class="col-sm-12 col-xl-6 mx-auto mt-4  ">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4 text-uppercase text-info text-al text-center ">Delivery Details Full View</h6>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Order ID</th>
                            <td><?php echo $rowfullview["order_id"]; ?></td>
                        </tr>
                        <tr>
                            <th>Delivery Date</th>
                            <td><?php echo $rowfullview["delivery_date"]; ?></td>
                        </tr>
                        <tr>
                            <th>Delivery Time</th>
                            <td><?php echo $rowfullview["delivery_time"]; ?></td>
                        </tr>
                        <tr>
                            <th>Delivered By</th>
                            <?php
                            $sqlload = "SELECT name FROM staff WHERE staff_id='$rowfullview[delivery_by]'";
                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                            $rowload = mysqli_fetch_assoc($resultload);
                            echo '<td>' . $rowload["name"] . '</td>';
                            ?>
                        </tr>
                        <tr>
                            <th>Delivery Status</th>
                            <td><?php echo $rowfullview["delivery_status"]; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class=" d-grid gap-2 col-3 mx-auto pt-2 ">
                    <a href="index.php?Tables=Tables/Delivery_Details.php&option=view">
                        <button type="button" class="btn btn-outline-dark py-2 text-uppercase w-100">View</button>
                    </a>
                    <a href="index.php?Tables=Tables/Delivery_Details.php&option=edit&pk1=<?php echo $rowfullview["order_id"]; ?>">
                        <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-secondary">Edit</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Delivery_Details Fullview Page End -->
    <?php
    }
    ?>


    <!-- EDIT -->
    <?php
    if ($_GET["option"] == "edit") {

    ?>
        <!-- Delivery_Details Edit Page Start -->

        <?php

        $userid = $_GET["pk1"];

        $sqledit = "SELECT * FROM deliverydetails WHERE order_id='$userid'";
        $resultedit = mysqli_query($connect, $sqledit) or die("sql error in sqledit" . mysqli_error($connect));
        $rowedit = mysqli_fetch_assoc($resultedit)
        ?>

        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Delivery_Details.php&option=update" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                        <div class="form-item">
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
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Delivery Date<sup>*</sup></label>
                                        <input type="date" class="form-control" value="<?php echo $rowedit["delivery_date"]; ?>" name="txtdeliverydate">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Delivery Time<sup>*</sup></label>
                                        <input type="time" class="form-control" value="<?php echo $rowedit["delivery_time"]; ?>" name="txtdeliverytime">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Delivered By<sup>*</sup></label>
                                        <select class="form-control" name="txtdeliveredby">
                                            <?php
                                            $sqlload="SELECT staff_id, name FROM staff";
                                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                            while($rowload=mysqli_fetch_assoc($resultload))
                                            {
                                                if($rowload["staff_id"]==$rowedit["delivery_by"])
                                                {
                                                    echo '<option selected value="'.$rowload["staff_id"].'">'.$rowload["name"].'</option>';
                                                }
                                                else
                                                {
                                                    echo '<option value="'.$rowload["staff_id"].'">'.$rowload["name"].'</option>';
                                                }
                                            
                                            }                                        
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Delivery Status<sup>*</sup></label>
                                        <input type="text" class="form-control" value="<?php echo $rowedit["delivery_status"]; ?>" name="txtdeliverystatus">
                                    </div>
                                </div>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnupdate" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Update</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Delivery_Details.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delivery_Details Edit Page End -->
    <?php
    }
    ?>


    <!-- UPDATE -->
    <?php
    if ($_GET["option"] == "update") {

    ?>
        <!-- Delivery_Details Update Page Start -->

        <?php
        if (isset($_POST["btnupdate"])) {
            $sqlupdate = "UPDATE deliverydetails SET 
                            delivery_date = '" . mysqli_real_escape_string($connect, $_POST["txtdeliverydate"]) . "',
                            delivery_time = '" . mysqli_real_escape_string($connect, $_POST["txtdeliverytime"]) . "',
                            delivery_by = '" . mysqli_real_escape_string($connect, $_POST["txtdeliveredby"]) . "',
                            delivery_status = '" . mysqli_real_escape_string($connect, $_POST["txtdeliverystatus"]) . "'
                            WHERE order_id = '" . mysqli_real_escape_string($connect, $_POST["txtorderid"]) . "' ";

            $resultupdate = mysqli_query($connect, $sqlupdate) or die("sql error in sqlupdate" . mysqli_error($connect));
            if ($resultupdate) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Delivery_Details.php&option=view";</script>';
            }
        } else {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Delivery_Details Update Page End -->
    <?php
    }
    ?>


<?php
}
?>
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
        <!-- Order_Detail Add Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Order_Detail.php&option=insert" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Order ID<sup>*</sup></label>
                                        <?php
                                            $sqlgenerateid="SELECT order_id FROM orderdetail ORDER BY order_id DESC LIMIT 1";
                                            $resultgenerateid = mysqli_query($connect, $sqlgenerateid) or die("sql error in sqlgenerateid" . mysqli_error($connect));
                                            if(mysqli_num_rows($resultgenerateid)==1)
                                            {
                                                $rowgenerateid=mysqli_fetch_assoc($resultgenerateid);
                                                $generateid=++$rowgenerateid["order_id"];
                                            }
                                            else
                                            {//for first time
                                                $generateid="ORDER001";
                                            }
                                        ?>
                                        <input type="text" class="form-control" placeholder="order000" name="txtorderid" value="<?php echo $generateid; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Order Date<sup>*</sup></label>
                                        <input type="date" class="form-control" name="txtorderdate">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Customer ID<sup>*</sup></label>
                                        <select class="form-control" placeholder="customer000" name="txtcustomerid">
                                            <option value="select" selected disabled>Select Category</option>
                                            <?php
                                            $sqlload="SELECT customer_id,name FROM customer";
                                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                            while($rowload=mysqli_fetch_assoc($resultload))
                                            {
                                                echo '<option value="'.$rowload["customer_id"].'">'.$rowload["name"].'</option>';
                                            }                                        
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Total Amount<sup>*</sup></label>
                                        <input type="number" class="form-control" name="txttotalamount" onkeypress="return isNumberKey(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Delivery Type<sup>*</sup></label>
                                        <input type="text" class="form-control" placeholder="" name="txtdeliverytype">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Offer<sup>*</sup></label>
                                        <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="100" value="0" oninput="amount.value=rangeInput.value">
                                        <output id="amount" name="amount" min-value="0" max-value="100" for="rangeInput">0</output><small>%</small>
                                    </div>
                                </div>
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
                                        <label class="form-label my-3">Status<sup>*</sup></label>
                                        <input type="text" class="form-control" name="txtstatus">
                                    </div>
                                </div>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnsubmit" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Submit</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Order_Detail.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
         <!-- Order_Detail Add Page End -->
    <?php
    }
    ?>

    <!-- INSERT -->
    <?php
    if ($_GET["option"] == "insert") {

    ?>
        <!-- Order_Detail Insert Page Start -->

        <?php
        if (isset($_POST["btnsubmit"])) 
        {
            $sqlinsert = "INSERT INTO orderdetail(order_id,order_date,customer_id,total_amount,offer,delivery_type,delivery_date,status) 
            VALUES('" . mysqli_real_escape_string($connect, $_POST["txtorderid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtorderdate"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtcustomerid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txttotalamount"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["rangeInput"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtdeliverytype"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtdeliverydate"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtstatus"]) . "')";

            $resultinsert = mysqli_query($connect, $sqlinsert) or die("sql error in sqlinsert" . mysqli_error($connect));
            if ($resultinsert) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Order_Detail.php&option=add";</script>';
            }
        } 
        else 
        {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Order_Detail Insert Page End -->
    <?php
    }
    ?>


    <!-- VIEW -->
    <?php
    if ($_GET["option"] == "view") {

    ?>
        <!-- Order_Detail view Page Start -->
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
                                    <h4 class="float-start text-primary ">List Of Order Details</h4>
                                    <a href="index.php?Tables=Tables/Order_Detail.php&option=add"><button type="button" class="card-title float-end btn btn-outline-primary py-2 text-uppercase">Add Order_Detail</button></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 500px">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Order Date</th>
                                                <th>Customer ID</th>
                                                <th>Total Amount</th>
                                                <th>Offer</th>
                                                <th>Delivery Type</th>
                                                <th>Delivery Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $sqlview = "SELECT order_id,order_date,customer_id,total_amount,offer,delivery_type,delivery_date,status FROM orderdetail";
                                            $resultview = mysqli_query($connect, $sqlview) or die("sql error in sqlview" . mysqli_error($connect));

                                            while ($rowview = mysqli_fetch_assoc($resultview)) {
                                                echo '<tr>';
                                                echo '<td>' . $rowview["order_id"] . '</td>';
                                                echo '<td>' . $rowview["order_date"] . '</td>';
                                                $sqlload1 = "SELECT name FROM customer WHERE customer_id='$rowview[customer_id]'";
                                                $resultload1 = mysqli_query($connect, $sqlload1) or die("sql error in sqlload1" . mysqli_error($connect));
                                                $rowload1 = mysqli_fetch_assoc($resultload1);
                                                echo '<td>' . $rowload1["name"] . '</td>';                                                
                                                echo '<td>' . $rowview["total_amount"] . '</td>';
                                                echo '<td>' . $rowview["offer"] . '</td>';
                                                echo '<td>' . $rowview["delivery_type"] . '</td>';
                                                echo '<td>' . $rowview["delivery_date"] . '</td>';
                                                echo '<td>' . $rowview["status"] . '</td>';
                                                echo '<td>';
                                                echo '<div class="d-flex align-items-center pt-3">
                                                        <a class="btn btn-outline-info me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Order_Detail.php&option=fullview&pk1=' . $rowview["order_id"] . '"><i class="fas fa-eye"></i></a>
                                                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Order_Detail.php&option=edit&pk1=' . $rowview["order_id"] . '"><i class="fas fa-edit"></i></a>'; ?>
                                                        <a class="btn btn-outline-danger btn-md-square rounded-circle" onclick="return ask_delete('<?php echo $rowview["order_id"]; ?>')" href="index.php?Tables=Tables/Order_Detail.php&option=delete&pk1=<?php echo $rowview["order_id"]; ?>"><i class="fas fa-trash"></i></a>
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
                                                <th>Order Date</th>
                                                <th>Customer ID</th>
                                                <th>Total Amount</th>
                                                <th>Offer</th>
                                                <th>Delivery Type</th>
                                                <th>Delivery Date</th>
                                                <th>Status</th>
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
        <!-- Order_Detail view Page End -->
    <?php
    }
    ?>


    <!-- DELETE -->
    <?php
    if ($_GET["option"] == "delete") {

    ?>
        <!-- Order_Detail Delete Page Start -->
        <?php

        $userid = $_GET["pk1"];

        $sqldelete = "DELETE FROM orderdetail WHERE order_id='$userid'";
        $resultview = mysqli_query($connect, $sqldelete) or die("sql error in sqldelete" . mysqli_error($connect));
        if ($resultview) {
            echo '<script>alert("Successfully Deleted"); window.location.href="index.php?Tables=Tables/Order_Detail.php&option=view";</script>';
        }
        ?>

        <!-- Order_Detail Delete Page End -->
    <?php
    }
    ?>


    <!-- FULL VIEW -->
    <?php
    if ($_GET["option"] == "fullview") {

    ?>
        <?php

        $userid = $_GET["pk1"];

        $sqlfullview = "SELECT * FROM orderdetail WHERE order_id='$userid'";
        $resultfullview = mysqli_query($connect, $sqlfullview) or die("sql error in sqlfullview" . mysqli_error($connect));
        $rowfullview = mysqli_fetch_assoc($resultfullview)
        ?>
        <!-- Order_Detail Fullview Page Start -->

        <div class="col-sm-12 col-xl-6 mx-auto mt-4  ">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4 text-uppercase text-info text-al text-center ">Order_Detail Full View</h6>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Order ID</th>
                            <td><?php echo $rowfullview["order_id"]; ?></td>
                        </tr>
                        <tr>
                            <th>Order Date</th>
                            <td><?php echo $rowfullview["order_date"]; ?></td>
                        </tr>
                        <tr>
                            <th>Customer ID</th>
                            <?php
                            $sqlload = "SELECT name FROM customer WHERE customer_id='$rowfullview[customer_id]'";
                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                            $rowload = mysqli_fetch_assoc($resultload);
                            echo '<td>' . $rowload["name"] . '</td>';
                            ?>
                        </tr>
                        <tr>
                            <th>Total Amount</th>
                            <td><?php echo $rowfullview["total_amount"]; ?></td>
                        </tr>
                        <tr>
                            <th>Offer</th>
                            <td><?php echo $rowfullview["offer"]; ?></td>
                        </tr>
                        <tr>
                            <th>Delivery Type</th>
                            <td><?php echo $rowfullview["delivery_type"]; ?></td>
                        </tr>
                        <tr>
                            <th>Delivery Date</th>
                            <td><?php echo $rowfullview["delivery_date"]; ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?php echo $rowfullview["status"]; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class=" d-grid gap-2 col-3 mx-auto pt-2 ">
                    <a href="index.php?Tables=Tables/Order_Detail.php&option=view">
                        <button type="button" class="btn btn-outline-dark py-2 text-uppercase w-100">View</button>
                    </a>
                    <a href="index.php?Tables=Tables/Order_Detail.php&option=edit&pk1=<?php echo $rowfullview["order_id"]; ?>">
                        <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-secondary">Edit</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Order_Detail Fullview Page End -->
    <?php
    }
    ?>


    <!-- EDIT -->
    <?php
    if ($_GET["option"] == "edit") {

    ?>
        <!-- Order_Detail Edit Page Start -->

        <?php

        $userid = $_GET["pk1"];

        $sqledit = "SELECT * FROM orderdetail WHERE order_id='$userid'";
        $resultedit = mysqli_query($connect, $sqledit) or die("sql error in sqledit" . mysqli_error($connect));
        $rowedit = mysqli_fetch_assoc($resultedit)
        ?>

        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Order_Detail.php&option=update" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                        <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Order ID<sup>*</sup></label>
                                        <input type="text" class="form-control" value="<?php echo $rowedit["order_id"]; ?>" name="txtorderid" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Order Date<sup>*</sup></label>
                                        <input type="date" class="form-control" value="<?php echo $rowedit["order_date"]; ?>" name="txtorderdate">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Customer ID<sup>*</sup></label>
                                        <select class="form-control" name="txtcustomerid">
                                            <?php
                                            $sqlload="SELECT customer_id, name FROM customer";
                                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                            while($rowload=mysqli_fetch_assoc($resultload))
                                            {
                                                if($rowload["customer_id"]==$rowedit["customer_id"])
                                                {
                                                    echo '<option selected value="'.$rowload["customer_id"].'">'.$rowload["name"].'</option>';
                                                }
                                                else
                                                {
                                                    echo '<option value="'.$rowload["customer_id"].'">'.$rowload["name"].'</option>';
                                                }
                                            
                                            }                                        
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Total Amount<sup>*</sup></label>
                                        <input type="number" class="form-control" value="<?php echo $rowedit["total_amount"]; ?>" name="txttotalamount" onkeypress="return isNumberKey(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Delivery Type<sup>*</sup></label>
                                        <input type="text" class="form-control" value="<?php echo $rowedit["delivery_type"]; ?>" name="txtdeliverytype">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Offer<sup>*</sup></label>
                                        <input type="range" class="form-range w-100" id="rangeInput" value="<?php echo $rowedit["offer"]; ?>" name="rangeInput" min="0" max="100" value="0" oninput="amount.value=rangeInput.value">
                                        <output id="amount" name="amount" min-value="0" max-value="100" for="rangeInput" ><?php echo $rowedit["offer"]; ?></output><small>%</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Delivery Date<sup>*</sup></label>
                                        <input type="date" class="form-control" value="<?php echo $rowedit["delivery_date"]; ?>" name="txtdeliverydate" >
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Status<sup>*</sup></label>
                                        <input type="text" class="form-control" value="<?php echo $rowedit["status"]; ?>" name="txtstatus" >
                                    </div>
                                </div>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnupdate" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Update</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Order_Detail.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Order_Detail Edit Page End -->
    <?php
    }
    ?>


    <!-- UPDATE -->
    <?php
    if ($_GET["option"] == "update") {

    ?>
        <!-- Order_Detail Update Page Start -->

        <?php
        if (isset($_POST["btnupdate"])) {
            $sqlupdate = "UPDATE orderdetail SET 
                            order_date = '" . mysqli_real_escape_string($connect, $_POST["txtorderdate"]) . "',
                            customer_id = '" . mysqli_real_escape_string($connect, $_POST["txtcustomerid"]) . "',
                            total_amount = '" . mysqli_real_escape_string($connect, $_POST["txttotalamount"]) . "',
                            delivery_type = '" . mysqli_real_escape_string($connect, $_POST["txtdeliverytype"]) . "',
                            offer = '" . mysqli_real_escape_string($connect, $_POST["rangeInput"]) . "',
                            delivery_date = '" . mysqli_real_escape_string($connect, $_POST["txtdeliverydate"]) . "',
                            status = '" . mysqli_real_escape_string($connect, $_POST["txtstatus"]) . "'
                            WHERE order_id = '" . mysqli_real_escape_string($connect, $_POST["txtorderid"]) . "' ";

            $resultupdate = mysqli_query($connect, $sqlupdate) or die("sql error in sqlupdate" . mysqli_error($connect));
            if ($resultupdate) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Order_Detail.php&option=view";</script>';
            }
        } else {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Order_Detail Update Page End -->
    <?php
    }
    ?>


<?php
}
?>
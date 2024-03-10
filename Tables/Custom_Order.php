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

include("db_connection.php");

if (isset($_GET["option"])) {
?>

    <!-- ADD -->
    <?php
    if ($_GET["option"] == "add") {
    ?>
        <!-- Custom_Order Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Custom_Order.php&option=insert" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Order ID<sup>*</sup></label>
                                        <?php
                                            $sqlgenerateid="SELECT order_id FROM customorder ORDER BY order_id DESC LIMIT 1";
                                            $resultgenerateid = mysqli_query($connect, $sqlgenerateid) or die("sql error in sqlgenerateid" . mysqli_error($connect));
                                            if(mysqli_num_rows($resultgenerateid)==1)
                                            {
                                                $rowgenerateid=mysqli_fetch_assoc($resultgenerateid);
                                                $generateid=++$rowgenerateid["order_id"];
                                            }
                                            else
                                            {//for first time
                                                $generateid="CORDER001";
                                            }
                                        ?>
                                        <input type="text" name="txtcustomorderorderid" class="form-control" placeholder="CORDER000" value="<?php echo $generateid; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Image ID<sup>*</sup></label>
                                        <input type="text" name="txtcustomorderimageid" class="form-control" placeholder="img000">
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Image<sup>*</sup></label>
                                <input type="text" name="txtcustomorderimage" class="form-control" placeholder="location/img.format">
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Request Price<sup>*</sup></label>
                                        <input type="number" name="txtcustomorderrequestprice" class="form-control" placeholder="" onkeypress="return isNumberKey(event)">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Confirm Price<sup>*</sup></label>
                                        <input type="number" name="txtcustomorderconfirmprice" class="form-control" placeholder="" onkeypress="return isNumberKey(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Status<sup>*</sup></label>
                                        <input type="text" name="txtcustomorderstatus" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Quantity<sup>*</sup></label>
                                        <input type="number" name="txtcustomorderquantity" class="form-control" placeholder="" onkeypress="return isNumberKey(event)">
                                    </div>
                                </div>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnsubmit" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Submit</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Custom_Order.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Custom_Order Page End -->
    <?php
    }
    ?>

    <!-- INSERT -->
    <?php
    if ($_GET["option"] == "insert") {

    ?>
        <!-- Custom_Order Insert Page Start -->

        <?php
        if(isset($_POST["btnsubmit"]))
        {
            $sqlinsert = "INSERT INTO customorder(order_id,image_id,image,request_price,confirm_price,status,quantity) 
            VALUES('".mysqli_real_escape_string($connect,$_POST["txtcustomorderorderid"])."',
            '".mysqli_real_escape_string($connect,$_POST["txtcustomorderimageid"])."',
            '".mysqli_real_escape_string($connect,$_POST["txtcustomorderimage"])."',
            '".mysqli_real_escape_string($connect,$_POST["txtcustomorderrequestprice"])."',
            '".mysqli_real_escape_string($connect,$_POST["txtcustomorderconfirmprice"])."',
            '".mysqli_real_escape_string($connect,$_POST["txtcustomorderstatus"])."',
            '".mysqli_real_escape_string($connect,$_POST["txtcustomorderquantity"])."')";

            $resultinsert = mysqli_query($connect,$sqlinsert) or die("sql error in sqlinsert".mysqli_error($connect));
            if($resultinsert)
            {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Custom_Order.php&option=add";</script>';
            }
        }
        
        else
        {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Custom_Order Insert Page End -->
    <?php
    }
    ?>

    <!-- VIEW -->
    <?php
    if ($_GET["option"] == "view") {

    ?>
        <!-- Custom_Order view Page Start -->
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
                                    <h4 class="float-start text-primary ">List Of Custom Order</h4>
                                    <a href="index.php?Tables=Tables/Custom_Order.php&option=add"><button type="button" class="card-title float-end btn btn-outline-primary py-2 text-uppercase">Add Custom_Order</button></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 500px">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Image ID</th>
                                                <th>Image</th>
                                                <th>Request Price</th>
                                                <th>Confirm Price</th>
                                                <th>Status</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $sqlview = "SELECT order_id,image_id,image,request_price,confirm_price,status,quantity FROM customorder";
                                            $resultview = mysqli_query($connect, $sqlview) or die("sql error in sqlview" . mysqli_error($connect));

                                            while ($rowview = mysqli_fetch_assoc($resultview)) {
                                                echo '<tr>';
                                                echo '<td>' . $rowview["order_id"] . '</td>';
                                                echo '<td>' . $rowview["image_id"] . '</td>';
                                                echo '<td>' . $rowview["image"] . '</td>';
                                                echo '<td>' . $rowview["request_price"] . '</td>';
                                                echo '<td>' . $rowview["confirm_price"] . '</td>';
                                                echo '<td>' . $rowview["status"] . '</td>';
                                                echo '<td>' . $rowview["quantity"] . '</td>';
                                                echo '<td>';
                                                echo '<div class="d-flex align-items-center pt-3">
                                                        <a class="btn btn-outline-info me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Custom_Order.php&option=fullview&pk1=' . $rowview["order_id"] . '&pk2=' . $rowview["image_id"] . '"><i class="fas fa-eye"></i></a>
                                                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Custom_Order.php&option=edit&pk1=' . $rowview["order_id"] . '&pk2=' . $rowview["image_id"] . '"><i class="fas fa-edit"></i></a>'; ?>
                                                <a class="btn btn-outline-danger btn-md-square rounded-circle" onclick="return ask_delete('<?php echo $rowview["order_id"]; ?>')" href="index.php?Tables=Tables/Custom_Order.php&option=delete&pk1=<?php echo $rowview["order_id"]; ?>&pk2=<?php echo $rowview["image_id"]; ?>"><i class="fas fa-trash"></i></a>
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
                                                <th>Image ID</th>
                                                <th>Image</th>
                                                <th>Request Price</th>
                                                <th>Confirm Price</th>
                                                <th>Status</th>
                                                <th>Quantity</th>
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
        <!-- Custom_Order view Page End -->
    <?php
    }
    ?>

    <!-- DELETE -->
    <?php
    if ($_GET["option"] == "delete") {

    ?>
        <!-- Custom_Order Delete Page Start -->
        <?php

        $userid1 = $_GET["pk1"];
        $userid2 = $_GET["pk2"];

        $sqldelete = "DELETE FROM customorder WHERE order_id='$userid1' AND image_id='$userid2'";
        $resultview = mysqli_query($connect, $sqldelete) or die("sql error in sqldelete" . mysqli_error($connect));
        if ($resultview) {
            echo '<script>alert("Successfully Deleted"); window.location.href="index.php?Tables=Tables/Custom_Order.php&option=view";</script>';
        }
        ?>

        <!-- Custom_Order Delete Page End -->
    <?php
    }
    ?>


    <!-- FULL VIEW -->
    <?php
    if ($_GET["option"] == "fullview") {

    ?>
        <?php

        $userid1 = $_GET["pk1"];
        $userid2 = $_GET["pk2"];

        $sqlfullview = "SELECT * FROM customorder WHERE order_id='$userid1' AND image_id='$userid2'";
        $resultfullview = mysqli_query($connect, $sqlfullview) or die("sql error in sqlfullview" . mysqli_error($connect));
        $rowfullview = mysqli_fetch_assoc($resultfullview)
        ?>
        <!-- Custom_Order Fullview Page Start -->

        <div class="col-sm-12 col-xl-6 mx-auto mt-4  ">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4 text-uppercase text-info text-al text-center ">Product Image Full View</h6>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Order ID</th>
                            <td><?php echo $rowfullview["order_id"]; ?></td>
                        </tr>
                        <tr>
                            <th>Image ID</th>
                            <td><?php echo $rowfullview["image_id"]; ?></td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td><?php echo $rowfullview["image"]; ?></td>
                        </tr>
                        <tr>
                            <th>Request Price</th>
                            <td><?php echo $rowfullview["request_price"]; ?></td>
                        </tr>
                        <tr>
                            <th>Confirm Price</th>
                            <td><?php echo $rowfullview["confirm_price"]; ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?php echo $rowfullview["status"]; ?></td>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <td><?php echo $rowfullview["quantity"]; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class=" d-grid gap-2 col-3 mx-auto pt-2 ">
                    <a href="index.php?Tables=Tables/Custom_Order.php&option=view">
                        <button type="button" class="btn btn-outline-dark py-2 text-uppercase w-100">View</button>
                    </a>
                    <a href="index.php?Tables=Tables/Custom_Order.php&option=edit&pk1=<?php echo $rowfullview["order_id"]; ?>&pk2=<?php echo $rowfullview["image_id"]; ?>">
                        <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-secondary">Edit</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Custom_Order Fullview Page End -->
    <?php
    }
    ?>


    <!-- EDIT -->
    <?php
    if ($_GET["option"] == "edit") {

    ?>
        <!-- Custom_Order Edit Page Start -->

        <?php

        $userid1 = $_GET["pk1"];
        $userid2 = $_GET["pk2"];

        $sqledit = "SELECT * FROM customorder WHERE order_id='$userid1' AND image_id='$userid2'";
        $resultedit = mysqli_query($connect, $sqledit) or die("sql error in sqledit" . mysqli_error($connect));
        $rowedit = mysqli_fetch_assoc($resultedit)
        ?>

        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Custom_Order.php&option=update" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Order ID<sup>*</sup></label>
                                        <input type="text" name="txtcustomorderorderid" class="form-control" value="<?php echo $rowedit["order_id"]; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Image ID<sup>*</sup></label>
                                        <input type="text" name="txtcustomorderimageid" class="form-control" value="<?php echo $rowedit["image_id"]; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Image<sup>*</sup></label>
                                <input type="text" name="txtcustomorderimage" class="form-control" value="<?php echo $rowedit["image"]; ?>">
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Request Price<sup>*</sup></label>
                                        <input type="number" name="txtcustomorderrequestprice" class="form-control" value="<?php echo $rowedit["request_price"]; ?>" onkeypress="return isNumberKey(event)">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Confirm Price<sup>*</sup></label>
                                        <input type="number" name="txtcustomorderconfirmprice" class="form-control" value="<?php echo $rowedit["confirm_price"]; ?>" onkeypress="return isNumberKey(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Status<sup>*</sup></label>
                                        <input type="text" name="txtcustomorderstatus" class="form-control" value="<?php echo $rowedit["status"]; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Quantity<sup>*</sup></label>
                                        <input type="number" name="txtcustomorderquantity" class="form-control" value="<?php echo $rowedit["quantity"]; ?>" onkeypress="return isNumberKey(event)">
                                    </div>
                                </div>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnupdate" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Update</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Custom_Order.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Custom_Order Edit Page End -->
    <?php
    }
    ?>


    <!-- UPDATE -->
    <?php
    if ($_GET["option"] == "update") {

    ?>
        <!-- Custom_Order Update Page Start -->

        <?php
        if (isset($_POST["btnupdate"])) {
            $sqlupdate = "UPDATE customorder SET 
                            image = '" . mysqli_real_escape_string($connect, $_POST["txtcustomorderimage"]) . "',
                            request_price = '" . mysqli_real_escape_string($connect, $_POST["txtcustomorderrequestprice"]) . "',
                            confirm_price = '" . mysqli_real_escape_string($connect, $_POST["txtcustomorderconfirmprice"]) . "',
                            status = '" . mysqli_real_escape_string($connect, $_POST["txtcustomorderstatus"]) . "',
                            quantity = '" . mysqli_real_escape_string($connect, $_POST["txtcustomorderquantity"]) . "'
                            WHERE order_id = '" . mysqli_real_escape_string($connect, $_POST["txtcustomorderorderid"]) . "' 
                            AND image_id = '" . mysqli_real_escape_string($connect, $_POST["txtcustomorderimageid"]) . "'";
                            
            $resultupdate = mysqli_query($connect, $sqlupdate) or die("sql error in sqlupdate" . mysqli_error($connect));
            if ($resultupdate) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Custom_Order.php&option=view";</script>';
            }
        } else {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Custom_Order Update Page End -->
    <?php
    }
    ?>

<?php
}
?>
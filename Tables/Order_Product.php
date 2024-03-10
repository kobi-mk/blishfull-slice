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

        <!-- Order_Product Add Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Order_Product.php&option=insert" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="row">
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
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Product ID<sup>*</sup></label>
                                        <select class="form-control" placeholder="product000" name="txtproductid">
                                            <option value="select" selected disabled>Select Product ID</option>
                                            <?php
                                            $sqlload="SELECT product_id, name FROM product";
                                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                            while($rowload=mysqli_fetch_assoc($resultload))
                                            {
                                                echo '<option value="'.$rowload["product_id"].'">'.$rowload["name"].'</option>';
                                            }                                        
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Weight ID<sup>*</sup></label>
                                        <select  class="form-control" placeholder="weight000" name="txtweightid">
                                            <option value="select" selected disabled>Select Weight ID</option>
                                            <?php
                                            $sqlload="SELECT weight_id,name FROM weight";
                                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                            while($rowload=mysqli_fetch_assoc($resultload))
                                            {
                                                echo '<option value="'.$rowload["weight_id"].'">'.$rowload["name"].'</option>';
                                            }                                        
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Quantity<sup>*</sup></label>
                                        <input type="number" class="form-control" placeholder="" name="txtquantity" onkeypress="return isNumberKey(event)">
                                    </div>
                                </div>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnsubmit" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Submit</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Order_Product.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
         <!-- Order_Product Add Page End -->
    <?php
    }
    ?>

    <!-- INSERT -->
    <?php
    if ($_GET["option"] == "insert") {

    ?>
        <!-- Order_Product Insert Page Start -->

        <?php
        if (isset($_POST["btnsubmit"])) {
            $sqlinsert = "INSERT INTO orderproduct(order_id,product_id,weight_id,quantity) 
            VALUES('" . mysqli_real_escape_string($connect, $_POST["txtorderid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtproductid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtweightid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtquantity"]) . "')";

            $resultinsert = mysqli_query($connect, $sqlinsert) or die("sql error in sqlinsert" . mysqli_error($connect));
            if ($resultinsert) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Order_Product.php&option=add";</script>';
            }
        } else {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Order_Product Insert Page End -->
    <?php
    }
    ?>

    <!-- VIEW -->
    <?php
    if ($_GET["option"] == "view") {

    ?>
        <!-- Order_Product view Page Start -->
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
                                    <h4 class="float-start text-primary ">List Of Order Product</h4>
                                    <a href="index.php?Tables=Tables/Order_Product.php&option=add"><button type="button" class="card-title float-end btn btn-outline-primary py-2 text-uppercase">Add Order_Product</button></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 500px">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Product ID</th>
                                                <th>Weight ID</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $sqlview = "SELECT order_id,product_id,weight_id,quantity FROM orderproduct";
                                            $resultview = mysqli_query($connect, $sqlview) or die("sql error in sqlview" . mysqli_error($connect));

                                            while ($rowview = mysqli_fetch_assoc($resultview)) {
                                                echo '<tr>';
                                                echo '<td>' . $rowview["order_id"] . '</td>';
                                                $sqlload1 = "SELECT name FROM product WHERE product_id='$rowview[product_id]'";
                                                $resultload1 = mysqli_query($connect, $sqlload1) or die("sql error in sqlload1" . mysqli_error($connect));
                                                $rowload1 = mysqli_fetch_assoc($resultload1);
                                                echo '<td>' . $rowload1["name"] . '</td>';                                                
                                                $sqlload2 = "SELECT name FROM weight WHERE weight_id='$rowview[weight_id]'";
                                                $resultload2 = mysqli_query($connect, $sqlload2) or die("sql error in sqlload2" . mysqli_error($connect));
                                                $rowload2 = mysqli_fetch_assoc($resultload2);
                                                echo '<td>' . $rowload2["name"] . '</td>';                                                
                                                echo '<td>' . $rowview["quantity"] . '</td>';
                                                echo '<td>';
                                                echo '<div class="d-flex align-items-center pt-3">
                                                        <a class="btn btn-outline-info me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Order_Product.php&option=fullview&pk1=' . $rowview["order_id"] . '&pk2=' . $rowview["product_id"] . '&pk3=' . $rowview["weight_id"] . '"><i class="fas fa-eye"></i></a>
                                                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Order_Product.php&option=edit&pk1=' . $rowview["order_id"] . '&pk2=' . $rowview["product_id"] . '&pk3=' . $rowview["weight_id"] . '"><i class="fas fa-edit"></i></a>'; ?>
                                                        <a class="btn btn-outline-danger btn-md-square rounded-circle" onclick="return ask_delete('<?php echo $rowview["product_id"]; ?>')" href="index.php?Tables=Tables/Order_Product.php&option=delete&pk1=<?php echo $rowview["order_id"]; ?>&pk2=<?php echo $rowview["product_id"]; ?>&pk3=<?php echo $rowview["weight_id"]; ?>"><i class="fas fa-trash"></i></a>
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
                                                <th>Product ID</th>
                                                <th>Weight ID</th>
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
        <!-- Order_Product view Page End -->
    <?php
    }
    ?>

    <!-- DELETE -->
    <?php
    if ($_GET["option"] == "delete") {

    ?>
        <!-- Order_Product Delete Page Start -->
        <?php

        $userid1 = $_GET["pk1"];
        $userid2 = $_GET["pk2"];
        $userid3 = $_GET["pk3"];

        $sqldelete = "DELETE FROM orderproduct WHERE order_id='$userid1' AND product_id='$userid2' AND weight_id='$userid3'";
        $resultview = mysqli_query($connect, $sqldelete) or die("sql error in sqldelete" . mysqli_error($connect));
        if ($resultview) {
            echo '<script>alert("Successfully Deleted"); window.location.href="index.php?Tables=Tables/Order_Product.php&option=view";</script>';
        }
        ?>

        <!-- Order_Product Delete Page End -->
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
        $userid3 = $_GET["pk3"];

        $sqlfullview = "SELECT * FROM orderproduct WHERE order_id='$userid1' AND product_id='$userid2' AND weight_id='$userid3'";
        $resultfullview = mysqli_query($connect, $sqlfullview) or die("sql error in sqlfullview" . mysqli_error($connect));
        $rowfullview = mysqli_fetch_assoc($resultfullview)
        ?>
        <!-- Order_Product Fullview Page Start -->

        <div class="col-sm-12 col-xl-6 mx-auto mt-4  ">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4 text-uppercase text-info text-al text-center ">Order Product Full View</h6>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Order ID</th>
                            <td><?php echo $rowfullview["order_id"]; ?></td>
                        </tr>
                        <tr>
                            <th>Product ID</th>
                            <?php
                            $sqlload1 = "SELECT name FROM product WHERE product_id='$rowfullview[product_id]'";
                            $resultload1 = mysqli_query($connect, $sqlload1) or die("sql error in sqlload1" . mysqli_error($connect));
                            $rowload1 = mysqli_fetch_assoc($resultload1);
                            echo '<td>' . $rowload1["name"] . '</td>';
                            ?>
                        </tr>
                        <tr>
                            <th>Weight ID</th>
                            <?php
                            $sqlload2 = "SELECT name FROM weight WHERE weight_id='$rowfullview[weight_id]'";
                            $resultload2 = mysqli_query($connect, $sqlload2) or die("sql error in sqlload2" . mysqli_error($connect));
                            $rowload2 = mysqli_fetch_assoc($resultload2);
                            echo '<td>' . $rowload2["name"] . '</td>';
                            ?>
                        </tr>
                        <tr>
                            <th>Start Date</th>
                            <td><?php echo $rowfullview["quantity"]; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class=" d-grid gap-2 col-3 mx-auto pt-2 ">
                    <a href="index.php?Tables=Tables/Order_Product.php&option=view">
                        <button type="button" class="btn btn-outline-dark py-2 text-uppercase w-100">View</button>
                    </a>
                    <a href="index.php?Tables=Tables/Order_Product.php&option=edit&pk1=<?php echo $rowfullview["order_id"]; ?>&pk2=<?php echo $rowfullview["product_id"]; ?>&pk3=<?php echo $rowfullview["weight_id"]; ?>">
                        <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-secondary">Edit</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Order_Product Fullview Page End -->
    <?php
    }
    ?>


    <!-- EDIT -->
    <?php
    if ($_GET["option"] == "edit") {

    ?>
        <!-- Order_Product Edit Page Start -->

        <?php

        $userid1 = $_GET["pk1"];
        $userid2 = $_GET["pk2"];
        $userid3 = $_GET["pk3"];

        $sqledit = "SELECT * FROM orderproduct WHERE order_id='$userid1' AND product_id='$userid2' AND weight_id='$userid3'";
        $resultedit = mysqli_query($connect, $sqledit) or die("sql error in sqledit" . mysqli_error($connect));
        $rowedit = mysqli_fetch_assoc($resultedit)
        ?>

        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Order_Product.php&option=update" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                        <div class="row">
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
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Product ID<sup>*</sup></label>
                                        <select class="form-control" name="txtproductid">
                                            <?php
                                            $sqlload="SELECT product_id, name FROM product";
                                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                            while($rowload=mysqli_fetch_assoc($resultload))
                                            {
                                                if($rowload["product_id"]==$rowedit["product_id"])
                                                {
                                                    echo '<option selected value="'.$rowload["product_id"].'">'.$rowload["name"].'</option>';
                                                }
                                                else
                                                {
                                                    echo '<option value="'.$rowload["product_id"].'">'.$rowload["name"].'</option>';
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
                                        <label class="form-label my-3">Weight ID<sup>*</sup></label>
                                        <select class="form-control" name="txtweightid">
                                            <?php
                                            $sqlload="SELECT weight_id, name FROM weight";
                                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                            while($rowload=mysqli_fetch_assoc($resultload))
                                            {
                                                if($rowload["weight_id"]==$rowedit["weight_id"])
                                                {
                                                    echo '<option selected value="'.$rowload["weight_id"].'">'.$rowload["name"].'</option>';
                                                }
                                                else
                                                {
                                                    echo '<option value="'.$rowload["weight_id"].'">'.$rowload["name"].'</option>';
                                                }
                                            
                                            }                                        
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Quantity<sup>*</sup></label>
                                        <input type="number" class="form-control" value="<?php echo $rowedit["quantity"]; ?>" name="txtquantity" onkeypress="return isNumberKey(event)">
                                    </div>
                                </div>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnupdate" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Update</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Order_Product.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Order_Product Edit Page End -->
    <?php
    }
    ?>


    <!-- UPDATE -->
    <?php
    if ($_GET["option"] == "update") {

    ?>
        <!-- Order_Product Update Page Start -->

        <?php
        if (isset($_POST["btnupdate"])) {
            $sqlupdate = "UPDATE orderproduct SET 
                            quantity = '" . mysqli_real_escape_string($connect, $_POST["txtquantity"]) . "'
                            WHERE order_id = '" . mysqli_real_escape_string($connect, $_POST["txtorderid"]) . "' 
                            AND product_id = '" . mysqli_real_escape_string($connect, $_POST["txtproductid"]) . "'
                            AND weight_id = '" . mysqli_real_escape_string($connect, $_POST["txtweightid"]) . "'";

            $resultupdate = mysqli_query($connect, $sqlupdate) or die("sql error in sqlupdate" . mysqli_error($connect));
            if ($resultupdate) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Order_Product.php&option=view";</script>';
            }
        } else {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Order_Product Update Page End -->
    <?php
    }
    ?>

<?php
}
?>
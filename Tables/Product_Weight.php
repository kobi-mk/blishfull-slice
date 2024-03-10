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
        $get_pro_id=$_GET["pro_id"];
    ?>
        <!-- Product_Weight Add Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Product_Weight.php&option=insert" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Product ID<sup>*</sup></label>
                                        <select class="form-control" placeholder="product000" name="txtproductweightproductid">
                                            <?php
                                            $sqlload="SELECT product_id, name FROM product WHERE product_id='$get_pro_id'";
                                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                            while($rowload=mysqli_fetch_assoc($resultload))
                                            {
                                                echo '<option value="'.$rowload["product_id"].'">'.$rowload["name"].'</option>';
                                            }                                        
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Weight ID<sup>*</sup></label>
                                        <select class="form-control" placeholder="weight000" name="txtproductweightweightid">
                                            <option value="select" selected disabled>Select Weight ID</option>
                                            <?php
                                            $sqlload="SELECT weight_id, name FROM weight";
                                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                            while($rowload=mysqli_fetch_assoc($resultload))
                                            {
                                                echo '<option value="'.$rowload["weight_id"].'">'.$rowload["name"].'</option>';
                                            }                                        
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Start Date<sup>*</sup></label>
                                        <input type="date" class="form-control" name="txtproductweightstartdate">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">End Date<sup>*</sup></label>
                                        <input type="date" class="form-control" name="txtproductweightenddate">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Price<sup>*</sup></label>
                                        <input type="number" class="form-control" name="txtproductweightprice" onkeypress="return isNumberKey(event)">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <div class="mb-3">
                                            <label class="form-label my-3">Offer<sup>*</sup></label>
                                            <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="100" value="0" oninput="amount.value=rangeInput.value">
                                            <output id="amount" name="amount" min-value="0" max-value="100" for="rangeInput">0</output><small>%</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnsubmit" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Submit</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Product.php&option=fullview&pk1=<?php echo $get_pro_id; ?>">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Product_Weight Add Page End -->

        <!-- Product_Image Page Start -->
        <div class="Product_Image py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Product_Image.php&option=insert" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="form-item">
                                <label class="form-label my-3">Product ID<sup>*</sup></label>
                                <select class="form-control" placeholder="product000" name="txtproductid">
                                    <?php
                                    $sqlload="SELECT product_id, name FROM product WHERE product_id='$get_pro_id'";
                                    $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                    while($rowload=mysqli_fetch_assoc($resultload))
                                    {
                                        echo '<option value="'.$rowload["product_id"].'">'.$rowload["name"].'</option>';
                                    }                                        
                                    ?>
                                </select>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Image ID<sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="image000" name="txtimageid">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Image<sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="location/image.format" name="txtimage">
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnsubmit" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Submit</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Product.php&option=fullview&pk1=<?php echo $get_pro_id; ?>">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <!-- Product_Image Page End -->
    <?php
    }
    ?>

    <!-- INSERT -->
    <?php
    if ($_GET["option"] == "insert") {

    ?>
        <!-- Product_Weight Insert Page Start -->

        <?php
        if (isset($_POST["btnsubmit"])) {
            $sqlinsert = "INSERT INTO productweight(product_id,weight_id,start_date,end_date,price,offer) 
            VALUES('" . mysqli_real_escape_string($connect, $_POST["txtproductweightproductid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtproductweightweightid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtproductweightstartdate"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtproductweightenddate"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtproductweightprice"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["rangeInput"]) . "')";

            $resultinsert = mysqli_query($connect, $sqlinsert) or die("sql error in sqlinsert" . mysqli_error($connect));
            if ($resultinsert) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Product_Weight.php&option=add&pro_id='. $_POST["txtproductweightproductid"].'";</script>';
            }
        } else {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Product_Weight Insert Page End -->
    <?php
    }
    ?>

    <!-- VIEW -->
    <?php
    if ($_GET["option"] == "view") {

    ?>
        <!-- Product_Weight view Page Start -->
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
                                    <h4 class="float-start text-primary ">List Of Product Weight</h4>
                                    <a href="index.php?Tables=Tables/Product_Weight.php&option=add"><button type="button" class="card-title float-end btn btn-outline-primary py-2 text-uppercase">Add Product_Weight</button></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 500px">
                                        <thead>
                                            <tr>
                                                <th>Product ID</th>
                                                <th>Weight ID</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Price</th>
                                                <th>Offer</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $sqlview = "SELECT product_id,weight_id,start_date,end_date,price,offer FROM productweight";
                                            $resultview = mysqli_query($connect, $sqlview) or die("sql error in sqlview" . mysqli_error($connect));

                                            while ($rowview = mysqli_fetch_assoc($resultview)) {
                                                echo '<tr>';
                                                $sqlload1 = "SELECT name FROM product WHERE product_id='$rowview[product_id]'";
                                                $resultload1 = mysqli_query($connect, $sqlload1) or die("sql error in sqlload1" . mysqli_error($connect));
                                                $rowload1 = mysqli_fetch_assoc($resultload1);
                                                echo '<td>' . $rowload1["name"] . '</td>';
                                                $sqlload2 = "SELECT name FROM weight WHERE weight_id='$rowview[weight_id]'";
                                                $resultload2 = mysqli_query($connect, $sqlload2) or die("sql error in sqlload2" . mysqli_error($connect));
                                                $rowload2 = mysqli_fetch_assoc($resultload2);
                                                echo '<td>' . $rowload2["name"] . '</td>';
                                                echo '<td>' . $rowview["start_date"] . '</td>';
                                                echo '<td>' . $rowview["end_date"] . '</td>';
                                                echo '<td>' . $rowview["price"] . '</td>';
                                                echo '<td>' . $rowview["offer"] . '</td>';
                                                echo '<td>';
                                                echo '<div class="d-flex align-items-center pt-3">
                                                        <a class="btn btn-outline-info me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Product_Weight.php&option=fullview&pk1=' . $rowview["product_id"] . '&pk2=' . $rowview["weight_id"] . '&pk3=' . $rowview["start_date"] . '"><i class="fas fa-eye"></i></a>
                                                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Product_Weight.php&option=edit&pk1=' . $rowview["product_id"] . '&pk2=' . $rowview["weight_id"] . '&pk3=' . $rowview["start_date"] . '"><i class="fas fa-edit"></i></a>'; ?>
                                                <a class="btn btn-outline-danger btn-md-square rounded-circle" onclick="return ask_delete('<?php echo $rowview["product_id"]; ?>')" href="index.php?Tables=Tables/Product_Weight.php&option=delete&pk1=<?php echo $rowview["product_id"]; ?>&pk2=<?php echo $rowview["weight_id"]; ?>&pk3=<?php echo $rowview["start_date"]; ?>"><i class="fas fa-trash"></i></a>
                                                    </div>
                                            <?php
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Product ID</th>
                                                <th>Weight ID</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Price</th>
                                                <th>Offer</th>
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
        <!-- Product_Weight view Page End -->
    <?php
    }
    ?>

<!-- DELETE -->
    <?php
    if ($_GET["option"] == "delete") {

    ?>
        <!-- Product_Weight Delete Page Start -->
        <?php

        $userid1 = $_GET["pk1"];
        $userid2 = $_GET["pk2"];
        $userid3 = $_GET["pk3"];

        $sqldelete = "DELETE FROM productweight WHERE product_id='$userid1' AND weight_id='$userid2' AND start_date='$userid3'";
        $resultview = mysqli_query($connect, $sqldelete) or die("sql error in sqldelete" . mysqli_error($connect));
        if ($resultview) {
            echo '<script>alert("Successfully Deleted"); window.location.href="index.php?Tables=Tables/Product.php&option=fullview&pk1='.$userid1.'";</script>';
        }
        ?>

        <!-- Product_Weight Delete Page End -->
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

        $sqlfullview = "SELECT * FROM productweight WHERE product_id='$userid1' AND weight_id='$userid2' AND start_date='$userid3'";
        $resultfullview = mysqli_query($connect, $sqlfullview) or die("sql error in sqlfullview" . mysqli_error($connect));
        $rowfullview = mysqli_fetch_assoc($resultfullview)
        ?>
        <!-- Product_Weight Fullview Page Start -->

        <div class="col-sm-12 col-xl-6 mx-auto mt-4  ">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4 text-uppercase text-info text-al text-center ">Product Weight Full View</h6>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Product ID</th>
                            <td><?php echo $rowfullview["product_id"]; ?></td>
                        </tr>
                        <tr>
                            <th>Weight ID</th>
                            <td><?php echo $rowfullview["weight_id"]; ?></td>
                        </tr>
                        <tr>
                            <th>Start Date</th>
                            <td><?php echo $rowfullview["start_date"]; ?></td>
                        </tr>
                        <tr>
                            <th>End Date</th>
                            <td><?php echo $rowfullview["end_date"]; ?></td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td><?php echo $rowfullview["price"]; ?></td>
                        </tr>
                        <tr>
                            <th>Offer</th>
                            <td><?php echo $rowfullview["offer"]; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class=" d-grid gap-2 col-3 mx-auto pt-2 ">
                    <a href="index.php?Tables=Tables/Product_Weight.php&option=view">
                        <button type="button" class="btn btn-outline-dark py-2 text-uppercase w-100">View</button>
                    </a>
                    <a href="index.php?Tables=Tables/Product_Weight.php&option=edit&pk1=<?php echo $rowfullview["product_id"]; ?>&pk2=<?php echo $rowfullview["weight_id"]; ?>&pk3=<?php echo $rowfullview["start_date"]; ?>">
                        <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-secondary">Edit</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Product_Weight Fullview Page End -->
    <?php
    }
    ?>


    <!-- EDIT -->
    <?php
    if ($_GET["option"] == "edit") {

    ?>
        <!-- Product_Weight Edit Page Start -->

        <?php

        $userid1 = $_GET["pk1"];
        $userid2 = $_GET["pk2"];
        $userid3 = $_GET["pk3"];

        $sqledit = "SELECT * FROM productweight WHERE product_id='$userid1' AND weight_id='$userid2' AND start_date='$userid3'";
        $resultedit = mysqli_query($connect, $sqledit) or die("sql error in sqledit" . mysqli_error($connect));
        $rowedit = mysqli_fetch_assoc($resultedit)
        ?>

        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Product_Weight.php&option=update" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Product ID<sup>*</sup></label>
                                        <select class="form-control" name="txtproductweightproductid">
                                            <?php
                                                $sqlload="SELECT product_id, name FROM product";
                                                $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                                while($rowload=mysqli_fetch_assoc($resultload))
                                                {
                                                    if($rowload["product_id"]==$rowedit["product_id"])
                                                    {
                                                        echo '<option selected value="'.$rowload["product_id"].'">'.$rowload["name"].'</option>';
                                                    }
                                                    
                                                
                                                }                                        
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Weight ID<sup>*</sup></label>
                                        <select class="form-control" name="txtproductweightweightid">
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
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Start Date<sup>*</sup></label>
                                        <input type="date" class="form-control" value="<?php echo $rowedit["start_date"]; ?>" name="txtproductweightstartdate" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">End Date<sup>*</sup></label>
                                        <input type="date" class="form-control" value="<?php echo $rowedit["end_date"]; ?>" name="txtproductweightenddate">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Price<sup>*</sup></label>
                                        <input type="number" class="form-control" value="<?php echo $rowedit["price"]; ?>" name="txtproductweightprice" onkeypress="return isNumberKey(event)">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <div class="mb-3">
                                            <label class="form-label my-3">Offer<sup>*</sup></label>
                                            <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="100" value="<?php echo $rowedit["offer"]; ?>" oninput="amount.value=rangeInput.value">
                                            <output id="amount" name="amount" min-value="0" max-value="100" for="rangeInput">0</output><small>%</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnupdate" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Update</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Product.php&option=fullview&pk1=<?php echo $rowedit["product_id"]; ?>">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Product_Weight Edit Page End -->
    <?php
    }
    ?>


    <!-- UPDATE -->
    <?php
    if ($_GET["option"] == "update") {

    ?>
        <!-- Product_Weight Update Page Start -->

        <?php
        if (isset($_POST["btnupdate"])) {
            $sqlupdate = "UPDATE productweight SET 
                            end_date = '" . mysqli_real_escape_string($connect, $_POST["txtproductweightenddate"]) . "',
                            price = '" . mysqli_real_escape_string($connect, $_POST["txtproductweightprice"]) . "',
                            offer = '" . mysqli_real_escape_string($connect, $_POST["rangeInput"]) . "'
                            WHERE product_id = '" . mysqli_real_escape_string($connect, $_POST["txtproductweightproductid"]) . "' 
                            AND weight_id = '" . mysqli_real_escape_string($connect, $_POST["txtproductweightweightid"]) . "'
                            AND start_date = '" . mysqli_real_escape_string($connect, $_POST["txtproductweightstartdate"]) . "'";

            $resultupdate = mysqli_query($connect, $sqlupdate) or die("sql error in sqlupdate" . mysqli_error($connect));
            if ($resultupdate) {
                echo '<script>alert("Success"); 
                window.location.href="index.php?Tables=Tables/Product.php&option=fullview&pk1='.$_POST["txtproductweightproductid"].'";</script>';
            }
        } else {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Product_Weight Update Page End -->
    <?php
    }
    ?>

<?php
}
?>
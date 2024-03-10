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
        $get_product_id=$_GET["product_id"];
    ?>

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
                                    <option value="select" selected disabled>Select Product ID</option>
                                    <?php
                                    $sqlload="SELECT product_id, name FROM product WHERE product_id='$get_product_id'";
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
                                <a href="index.php?Tables=Tables/Product_Image.php&option=view">
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
        <!-- Product_Image Insert Page Start -->

        <?php
        if (isset($_POST["btnsubmit"])) {
            $sqlinsert = "INSERT INTO productimage(product_id,image_id,image) 
            VALUES('" . mysqli_real_escape_string($connect, $_POST["txtproductid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtimageid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtimage"]) . "')";

            $resultinsert = mysqli_query($connect, $sqlinsert) or die("sql error in sqlinsert" . mysqli_error($connect));
            if ($resultinsert) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Product_Weight.php&option=add&pro_id='. $_POST["txtproductid"].'";</script>';
            }
        } else {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Product_Image Insert Page End -->
    <?php
    }
    ?>

    <!-- VIEW -->
    <?php
    if ($_GET["option"] == "view") {

    ?>
        <!-- Product_Image view Page Start -->
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
                                    <h4 class="float-start text-primary ">List Of Product Image</h4>
                                    <a href="index.php?Tables=Tables/Product_Image.php&option=add"><button type="button" class="card-title float-end btn btn-outline-primary py-2 text-uppercase">Add Product_Image</button></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 500px">
                                        <thead>
                                            <tr>
                                                <th>Product ID</th>
                                                <th>Image ID</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $sqlview = "SELECT product_id,image_id,image FROM productimage";
                                            $resultview = mysqli_query($connect, $sqlview) or die("sql error in sqlview" . mysqli_error($connect));

                                            while ($rowview = mysqli_fetch_assoc($resultview)) {
                                                echo '<tr>';
                                                echo '<td>' . $rowview["product_id"] . '</td>';
                                                echo '<td>' . $rowview["image_id"] . '</td>';
                                                echo '<td>' . $rowview["image"] . '</td>';
                                                echo '<td>';
                                                echo '<div class="d-flex align-items-center pt-3">
                                                        <a class="btn btn-outline-info me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Product_Image.php&option=fullview&pk1=' . $rowview["product_id"] . '&pk2=' . $rowview["image_id"] . '"><i class="fas fa-eye"></i></a>
                                                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Product_Image.php&option=edit&pk1=' . $rowview["product_id"] . '&pk2=' . $rowview["image_id"] . '"><i class="fas fa-edit"></i></a>'; ?>
                                                <a class="btn btn-outline-danger btn-md-square rounded-circle" onclick="return ask_delete('<?php echo $rowview["product_id"]; ?>')" href="index.php?Tables=Tables/Product_Image.php&option=delete&pk1=<?php echo $rowview["product_id"]; ?>&pk2=<?php echo $rowview["image_id"]; ?>"><i class="fas fa-trash"></i></a>
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
                                                <th>Image ID</th>
                                                <th>Image</th>
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
        <!-- Product_Image view Page End -->
    <?php
    }
    ?>

    <!-- DELETE -->
    <?php
    if ($_GET["option"] == "delete") {

    ?>
        <!-- Product_Image Delete Page Start -->
        <?php

        $userid1 = $_GET["pk1"];
        $userid2 = $_GET["pk2"];

        $sqldelete = "DELETE FROM productimage WHERE product_id='$userid1' AND image_id='$userid2'";
        $resultview = mysqli_query($connect, $sqldelete) or die("sql error in sqldelete" . mysqli_error($connect));
        if ($resultview) {
            echo '<script>alert("Successfully Deleted"); window.location.href="index.php?Tables=Tables/Product.php&option=fullview&pk1='.$userid1.'";</script>';
        }
        ?>

        <!-- Product_Image Delete Page End -->
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

        $sqlfullview = "SELECT * FROM productimage WHERE product_id='$userid1' AND image_id='$userid2'";
        $resultfullview = mysqli_query($connect, $sqlfullview) or die("sql error in sqlfullview" . mysqli_error($connect));
        $rowfullview = mysqli_fetch_assoc($resultfullview)
        ?>
        <!-- Product_Image Fullview Page Start -->

        <div class="col-sm-12 col-xl-6 mx-auto mt-4  ">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4 text-uppercase text-info text-al text-center ">Product Image Full View</h6>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Product ID</th>
                            <td><?php echo $rowfullview["product_id"]; ?></td>
                        </tr>
                        <tr>
                            <th>Image ID</th>
                            <td><?php echo $rowfullview["image_id"]; ?></td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td><?php echo $rowfullview["image"]; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class=" d-grid gap-2 col-3 mx-auto pt-2 ">
                    <a href="index.php?Tables=Tables/Product_Image.php&option=view">
                        <button type="button" class="btn btn-outline-dark py-2 text-uppercase w-100">View</button>
                    </a>
                    <a href="index.php?Tables=Tables/Product_Image.php&option=edit&pk1=<?php echo $rowfullview["product_id"]; ?>&pk2=<?php echo $rowfullview["image_id"]; ?>">
                        <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-secondary">Edit</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Product_Image Fullview Page End -->
    <?php
    }
    ?>


    <!-- EDIT -->
    <?php
    if ($_GET["option"] == "edit") {

    ?>
        <!-- Product_Image Edit Page Start -->

        <?php

        $userid1 = $_GET["pk1"];
        $userid2 = $_GET["pk2"];

        $sqledit = "SELECT * FROM productimage WHERE product_id='$userid1' AND image_id='$userid2'";
        $resultedit = mysqli_query($connect, $sqledit) or die("sql error in sqledit" . mysqli_error($connect));
        $rowedit = mysqli_fetch_assoc($resultedit)
        ?>

        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Product_Image.php&option=update" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                        <div class="form-item">
                            <label class="form-label my-3">Product ID<sup>*</sup></label>
                            <select class="form-control" name="txtproductid">
                                <?php
                                    $sqlload="SELECT product_id, name FROM product WHERE product_id='$rowedit[product_id]'";
                                    $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                    while($rowload=mysqli_fetch_assoc($resultload))
                                    {
                                        
                                        echo '<option selected value="'.$rowload["product_id"].'">'.$rowload["name"].'</option>';
                                          
                                    }                                        
                                ?>
                            </select>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Image ID<sup>*</sup></label>
                            <input type="text" class="form-control" value="<?php echo $rowedit["image_id"]; ?>" name="txtimageid" readonly>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Image<sup>*</sup></label>
                            <input type="text" class="form-control" value="<?php echo $rowedit["image"]; ?>" name="txtimage">
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
                </form>
            </div>
        </div>

        <!-- Product_Image Edit Page End -->
    <?php
    }
    ?>


    <!-- UPDATE -->
    <?php
    if ($_GET["option"] == "update") {

    ?>
        <!-- Product_Image Update Page Start -->

        <?php
        if (isset($_POST["btnupdate"])) {
            $sqlupdate = "UPDATE productimage SET 
                            image = '" . mysqli_real_escape_string($connect, $_POST["txtimage"]) . "'
                            WHERE product_id = '" . mysqli_real_escape_string($connect, $_POST["txtproductid"]) . "' 
                            AND image_id = '" . mysqli_real_escape_string($connect, $_POST["txtimageid"]) . "'";
                            
            $resultupdate = mysqli_query($connect, $sqlupdate) or die("sql error in sqlupdate" . mysqli_error($connect));
            if ($resultupdate) {
                echo '<script>alert("Success"); 
                window.location.href="index.php?Tables=Tables/Product.php&option=fullview&pk1='.$_POST["txtproductid"].'";</script>';
            }
        } else {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Product_Image Update Page End -->
    <?php
    }
    ?>

<?php
}
?>
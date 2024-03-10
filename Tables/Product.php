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
        <!-- Product Add Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Product.php&option=insert" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Product ID<sup>*</sup></label>
                                        <?php
                                            $sqlgenerateid="SELECT product_id FROM product ORDER BY product_id DESC LIMIT 1";
                                            $resultgenerateid = mysqli_query($connect, $sqlgenerateid) or die("sql error in sqlgenerateid" . mysqli_error($connect));
                                            if(mysqli_num_rows($resultgenerateid)==1)
                                            {
                                                $rowgenerateid=mysqli_fetch_assoc($resultgenerateid);
                                                $generateid=++$rowgenerateid["product_id"];
                                            }
                                            else
                                            {//for first time
                                                $generateid="PRODUCT001";
                                            }
                                        ?>
                                        <input type="text" class="form-control" placeholder="product000" name="txtproductid" value="<?php echo $generateid; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Name<sup>*</sup></label>
                                        <input type="text" class="form-control" placeholder="product name" name="txtname" onkeypress="return isTextKey(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Subcategory ID<sup>*</sup></label>
                                        <select class="form-control" placeholder="sub000" name="txtsubcategoryid">
                                            <option value="select" selected disabled>Select Subcategory ID</option>
                                            <?php
                                            $sqlload="SELECT subcategory_id, name FROM subcategory";
                                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                            while($rowload=mysqli_fetch_assoc($resultload))
                                            {
                                                echo '<option value="'.$rowload["subcategory_id"].'">'.$rowload["name"].'</option>';
                                            }                                        
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Type<sup>*</sup></label>
                                        <select class="form-select" aria-label="Default select example" name="txttype">
                                            <option selected disabled>Choose Veg/NonVeg</option>
                                            <option value="V">V</option>
                                            <option value="NV">NV</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Ingredients<sup>*</sup></label>
                                <input type="tel" class="form-control" placeholder="item01---item02---item03---item04---cont..." name="txtingredients">
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnsubmit" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Submit</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Product.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
         <!-- Product Add Page End -->
    <?php
    }
    ?>

    <!-- INSERT -->
    <?php
    if ($_GET["option"] == "insert") {

    ?>
        <!-- Product Insert Page Start -->

        <?php
        if (isset($_POST["btnsubmit"])) 
        {
            $sqlinsert = "INSERT INTO product(product_id,name,subcategory_id,ingredients,type) 
            VALUES('" . mysqli_real_escape_string($connect, $_POST["txtproductid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtname"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtsubcategoryid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtingredients"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txttype"]) . "')";

            $resultinsert = mysqli_query($connect, $sqlinsert) or die("sql error in sqlinsert" . mysqli_error($connect));
            if ($resultinsert) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Product_Weight.php&option=add&pro_id='.$_POST["txtproductid"].'";</script>';
            }
        } 
        else 
        {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Product Insert Page End -->
    <?php
    }
    ?>


    <!-- VIEW -->
    <?php
    if ($_GET["option"] == "view") {

    ?>
        <!-- Product view Page Start -->
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
                                    <h4 class="float-start text-primary ">List Of Products</h4>
                                    <a href="index.php?Tables=Tables/Product.php&option=add"><button type="button" class="card-title float-end btn btn-outline-primary py-2 text-uppercase">Add Product</button></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 500px">
                                        <thead>
                                            <tr>
                                                <th>Product ID</th>
                                                <th>Name</th>
                                                <th>Subcategory ID</th>
                                                <th>Ingredients</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $sqlview = "SELECT product_id,name,subcategory_id,ingredients,type FROM product";
                                            $resultview = mysqli_query($connect, $sqlview) or die("sql error in sqlview" . mysqli_error($connect));

                                            while ($rowview = mysqli_fetch_assoc($resultview)) {
                                                echo '<tr>';
                                                echo '<td>' . $rowview["product_id"] . '</td>';
                                                echo '<td>' . $rowview["name"] . '</td>';
                                                $sqlload = "SELECT name FROM subcategory WHERE subcategory_id='$rowview[subcategory_id]'";
                                                $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                                $rowload = mysqli_fetch_assoc($resultload);
                                                echo '<td>' . $rowload["name"] . '</td>';
                                                echo '<td>' . $rowview["ingredients"] . '</td>';
                                                echo '<td>' . $rowview["type"] . '</td>';
                                                echo '<td>';
                                                echo '<div class="d-flex align-items-center pt-3">
                                                        <a class="btn btn-outline-info me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Product.php&option=fullview&pk1=' . $rowview["product_id"] . '"><i class="fas fa-eye"></i></a>
                                                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Product.php&option=edit&pk1=' . $rowview["product_id"] . '"><i class="fas fa-edit"></i></a>'; ?>
                                                        <a class="btn btn-outline-danger btn-md-square rounded-circle" onclick="return ask_delete('<?php echo $rowview["name"]; ?>')" href="index.php?Tables=Tables/Product.php&option=delete&pk1=<?php echo $rowview["product_id"]; ?>"><i class="fas fa-trash"></i></a>
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
                                                <th>Name</th>
                                                <th>Subcategory ID</th>
                                                <th>Ingredients</th>
                                                <th>Type</th>
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
        <!-- Product view Page End -->
    <?php
    }
    ?>


    <!-- DELETE -->
    <?php
    if ($_GET["option"] == "delete") {

    ?>
        <!-- Product Delete Page Start -->
        <?php

        $userid = $_GET["pk1"];

        $sqldelete = "DELETE FROM productweight WHERE product_id='$userid'";
        $resultdelete= mysqli_query($connect, $sqldelete) or die("sql error in sqldelete" . mysqli_error($connect));

        $sqldelete = "DELETE FROM productimage WHERE product_id='$userid'";
        $resultdelete= mysqli_query($connect, $sqldelete) or die("sql error in sqldelete" . mysqli_error($connect));

        $sqldelete = "DELETE FROM product WHERE product_id='$userid'";
        $resultdelete= mysqli_query($connect, $sqldelete) or die("sql error in sqldelete" . mysqli_error($connect));
        if ($resultdelete) {
            echo '<script>alert("Successfully Deleted"); window.location.href="index.php?Tables=Tables/Product.php&option=view";</script>';
        }
        ?>

        <!-- Product Delete Page End -->
    <?php
    }
    ?>


    <!-- FULL VIEW -->
    <?php
    if ($_GET["option"] == "fullview") {

    ?>
        <?php

        $userid = $_GET["pk1"];

        $sqlfullview = "SELECT * FROM product WHERE product_id='$userid'";
        $resultfullview = mysqli_query($connect, $sqlfullview) or die("sql error in sqlfullview" . mysqli_error($connect));
        $rowfullview = mysqli_fetch_assoc($resultfullview)
        ?>
        <!-- Product Fullview Page Start -->

        <div class="col-sm-12 col-xl-6 mx-auto mt-4  ">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4 text-uppercase text-info text-al text-center ">Product Full View</h6>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Product ID</th>
                            <td><?php echo $rowfullview["product_id"]; ?></td>
                         </tr>
                        <tr>
                            <th>Name</th>
                            <td><?php echo $rowfullview["name"]; ?></td>
                        </tr>
                        <tr>
                            <th>Subcategory ID</th>
                            <?php
                            $sqlload = "SELECT name FROM subcategory WHERE subcategory_id='$rowfullview[subcategory_id]'";
                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                            $rowload = mysqli_fetch_assoc($resultload);
                            echo '<td>' . $rowload["name"] . '</td>';
                            
                            ?>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td><?php echo $rowfullview["type"]; ?></td>
                        </tr>
                        <tr>
                            <th>Ingredients</th>
                            <td><?php echo $rowfullview["ingredients"]; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class=" d-grid gap-2 col-3 mx-auto pt-2 ">
                    <a href="index.php?Tables=Tables/Product.php&option=view">
                        <button type="button" class="btn btn-outline-dark py-2 text-uppercase w-100">View</button>
                    </a>
                    <a href="index.php?Tables=Tables/Product.php&option=edit&pk1=<?php echo $rowfullview["product_id"]; ?>">
                        <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-secondary">Edit</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Product Fullview Page End -->

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
                                    <a href="index.php?Tables=Tables/Product_Weight.php&option=add&pro_id=<?php echo $rowfullview["product_id"]; ?>"><button type="button" class="card-title float-end btn btn-outline-primary py-2 text-uppercase">Add Product_Weight</button></a>
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

                                            $sqlview_pw = "SELECT product_id,weight_id,start_date,end_date,price,offer FROM productweight WHERE product_id='$rowfullview[product_id]'";
                                            $resultview_pw = mysqli_query($connect, $sqlview_pw) or die("sql error in sqlview_pw" . mysqli_error($connect));

                                            while ($rowview_pw = mysqli_fetch_assoc($resultview_pw)) {
                                                echo '<tr>';
                                                $sqlload1 = "SELECT name FROM product WHERE product_id='$rowview_pw[product_id]'";
                                                $resultload1 = mysqli_query($connect, $sqlload1) or die("sql error in sqlload1" . mysqli_error($connect));
                                                $rowload1 = mysqli_fetch_assoc($resultload1);
                                                echo '<td>' . $rowload1["name"] . '</td>';
                                                $sqlload2 = "SELECT name FROM weight WHERE weight_id='$rowview_pw[weight_id]'";
                                                $resultload2 = mysqli_query($connect, $sqlload2) or die("sql error in sqlload2" . mysqli_error($connect));
                                                $rowload2 = mysqli_fetch_assoc($resultload2);
                                                echo '<td>' . $rowload2["name"] . '</td>';                                                
                                                echo '<td>' . $rowview_pw["start_date"] . '</td>';
                                                echo '<td>' . $rowview_pw["end_date"] . '</td>';
                                                echo '<td>' . $rowview_pw["price"] . '</td>';
                                                echo '<td>' . $rowview_pw["offer"] . '</td>';
                                                echo '<td>';
                                                echo '<div class="d-flex align-items-center pt-3">
                                                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Product_Weight.php&option=edit&pk1=' . $rowview_pw["product_id"] . '&pk2=' . $rowview_pw["weight_id"] . '&pk3=' . $rowview_pw["start_date"] . '"><i class="fas fa-edit"></i></a>'; ?>
                                                <a class="btn btn-outline-danger btn-md-square rounded-circle" onclick="return ask_delete('<?php echo $rowview_pw["product_id"]; ?>')" href="index.php?Tables=Tables/Product_Weight.php&option=delete&pk1=<?php echo $rowview_pw["product_id"]; ?>&pk2=<?php echo $rowview_pw["weight_id"]; ?>&pk3=<?php echo $rowview_pw["start_date"]; ?>"><i class="fas fa-trash"></i></a>
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

           
        </section>
        <!-- Product_Weight view Page End -->


        <!-- Product_Image view Page Start -->
        <section>
            <!-- DATA TABLE -->
            
            <div class="container ">
                <div class="row">
                    <div class="col-md-10 col-sm-10 mx-auto mt-2 ">
                        <div class="card">
                            <div class="card-header bg-dark ">
                                <div class="card-title">
                                    <h4 class="float-start text-primary ">List Of Product Image</h4>
                                    <a href="index.php?Tables=Tables/Product_Weight.php&option=add&option=add&pro_id=<?php echo $rowfullview["product_id"]; ?>"><button type="button" class="card-title float-end btn btn-outline-primary py-2 text-uppercase">Add Product_Image</button></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="display" style="min-width: 500px">
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

                                            $sqlview = "SELECT product_id,image_id,image FROM productimage WHERE product_id='$rowfullview[product_id]'";
                                            $resultview = mysqli_query($connect, $sqlview) or die("sql error in sqlview" . mysqli_error($connect));

                                            while ($rowview_pi = mysqli_fetch_assoc($resultview)) {
                                                echo '<tr>';
                                                $sqlload1 = "SELECT name FROM product WHERE product_id='$rowview_pi[product_id]'";
                                                $resultload1 = mysqli_query($connect, $sqlload1) or die("sql error in sqlload1" . mysqli_error($connect));
                                                $rowload1 = mysqli_fetch_assoc($resultload1);
                                                echo '<td>' . $rowload1["name"] . '</td>';                                                
                                                echo '<td>' . $rowview_pi["image_id"] . '</td>';
                                                echo '<td>' . $rowview_pi["image"] . '</td>';
                                                echo '<td>';
                                                echo '<div class="d-flex align-items-center pt-3">
                                                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Product_Image.php&option=edit&pk1=' . $rowview_pi["product_id"] . '&pk2=' . $rowview_pi["image_id"] . '"><i class="fas fa-edit"></i></a>'; ?>
                                                        <a class="btn btn-outline-danger btn-md-square rounded-circle" onclick="return ask_delete('<?php echo $rowview_pi["product_id"]; ?>')" href="index.php?Tables=Tables/Product_Image.php&option=delete&pk1=<?php echo $rowview_pi["product_id"]; ?>&pk2=<?php echo $rowview_pi["image_id"]; ?>"><i class="fas fa-trash"></i></a>
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


    <!-- EDIT -->
    <?php
    if ($_GET["option"] == "edit") {

    ?>
        <!-- Product Edit Page Start -->

        <?php

        $userid = $_GET["pk1"];

        $sqledit = "SELECT * FROM product WHERE product_id='$userid'";
        $resultedit = mysqli_query($connect, $sqledit) or die("sql error in sqledit" . mysqli_error($connect));
        $rowedit = mysqli_fetch_assoc($resultedit)
        ?>

        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Product.php&option=update" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Product ID<sup>*</sup></label>
                                        <input type="text" class="form-control" value="<?php echo $rowedit["product_id"]; ?>" name="txtproductid" readonly>
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
                                        <label class="form-label my-3">Subcategory ID<sup>*</sup></label>
                                        <select class="form-control" name="txtsubcategoryid">
                                            <?php
                                            $sqlload="SELECT subcategory_id, name FROM subcategory";
                                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                            while($rowload=mysqli_fetch_assoc($resultload))
                                            {
                                                if($rowload["subcategory_id"]==$rowedit["subcategory_id"])
                                                {
                                                    echo '<option selected value="'.$rowload["subcategory_id"].'">'.$rowload["name"].'</option>';
                                                }
                                                else
                                                {
                                                    echo '<option value="'.$rowload["subcategory_id"].'">'.$rowload["name"].'</option>';
                                                }
                                            
                                            }                                        
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Type<sup>*</sup></label>
                                        <select class="form-select" aria-label="Default select example" value="<?php echo $rowedit["type"]; ?>" name="txttype">
                                            <option selected disabled>Choose Veg/NonVeg</option>
                                            <option value="V">V</option>
                                            <option value="NV">NV</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Ingredients<sup>*</sup></label>
                                <input type="tel" class="form-control" value="<?php echo $rowedit["ingredients"]; ?>" name="txtingredients">
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnupdate" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Update</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Product.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Product Edit Page End -->
    <?php
    }
    ?>


    <!-- UPDATE -->
    <?php
    if ($_GET["option"] == "update") {

    ?>
        <!-- Product Update Page Start -->

        <?php
        if (isset($_POST["btnupdate"])) {
            $sqlupdate = "UPDATE product SET 
                            name = '" . mysqli_real_escape_string($connect, $_POST["txtname"]) . "',
                            subcategory_id = '" . mysqli_real_escape_string($connect, $_POST["txtsubcategoryid"]) . "',
                            ingredients = '" . mysqli_real_escape_string($connect, $_POST["txtingredients"]) . "',
                            type = '" . mysqli_real_escape_string($connect, $_POST["txttype"]) . "'
                            WHERE product_id = '" . mysqli_real_escape_string($connect, $_POST["txtproductid"]) . "' ";

            $resultupdate = mysqli_query($connect, $sqlupdate) or die("sql error in sqlupdate" . mysqli_error($connect));
            if ($resultupdate) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Product.php&option=view";</script>';
            }
        } else {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Product Update Page End -->
    <?php
    }
    ?>


<?php
}
?>
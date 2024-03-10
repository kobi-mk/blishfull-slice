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
        <!-- Review Add Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Review.php&option=insert" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Review ID<sup>*</sup></label>
                                        <?php
                                            $sqlgenerateid="SELECT review_id FROM review ORDER BY review_id DESC LIMIT 1";
                                            $resultgenerateid = mysqli_query($connect, $sqlgenerateid) or die("sql error in sqlgenerateid" . mysqli_error($connect));
                                            if(mysqli_num_rows($resultgenerateid)==1)
                                            {
                                                $rowgenerateid=mysqli_fetch_assoc($resultgenerateid);
                                                $generateid=++$rowgenerateid["review_id"];
                                            }
                                            else
                                            {//for first time
                                                $generateid="REVIEW001";
                                            }
                                        ?>
                                        <input type="text" class="form-control" placeholder="review000" name="txtreviewid" value="<?php echo $generateid; ?>" readonly>
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
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Weight ID<sup>*</sup></label>
                                        <select class="form-control" placeholder="weight000" name="txtweightid">
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
                                        <label class="form-label my-3">Rate<sup>*</sup></label>
                                        <select class="form-select" aria-label="Default select example" name="txtrate">
                                            <option selected disabled>Valuable Rate Please</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Date<sup>*</sup></label>
                                        <input type="date" class="form-control" name="txtdate">
                                    </div>
                                </div>
                            </div>
                            <div class="form-item mt-4">
                                <textarea name="text" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Comments..." ></textarea>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnsubmit" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Submit</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Review.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Review Add Page End -->
    <?php
    }
    ?>

    <!-- INSERT -->
    <?php
    if ($_GET["option"] == "insert") {

    ?>
        <!-- Review Insert Page Start -->

        <?php
        if (isset($_POST["btnsubmit"])) 
        {
            $sqlinsert = "INSERT INTO review(review_id,order_id,product_id,weight_id,rate,date,comment) 
            VALUES('" . mysqli_real_escape_string($connect, $_POST["txtreviewid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtorderid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtproductid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtweightid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtrate"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtdate"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["text"]) . "')";

            $resultinsert = mysqli_query($connect, $sqlinsert) or die("sql error in sqlinsert" . mysqli_error($connect));
            if ($resultinsert) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Review.php&option=add";</script>';
            }
        } 
        else 
        {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Review Insert Page End -->
    <?php
    }
    ?>


    <!-- VIEW -->
    <?php
    if ($_GET["option"] == "view") {

    ?>
        <!-- Review view Page Start -->
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
                                    <h4 class="float-start text-primary ">List Of Reviews</h4>
                                    <a href="index.php?Tables=Tables/Review.php&option=add"><button type="button" class="card-title float-end btn btn-outline-primary py-2 text-uppercase">Add Review</button></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 500px">
                                        <thead>
                                            <tr>
                                                <th>Review ID</th>
                                                <th>Order ID</th>
                                                <th>Product ID</th>
                                                <th>Weight ID</th>
                                                <th>Rate</th>
                                                <th>Date</th>
                                                <th>Comments</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $sqlview = "SELECT review_id,order_id,product_id,weight_id,rate,date,comment FROM review";
                                            $resultview = mysqli_query($connect, $sqlview) or die("sql error in sqlview" . mysqli_error($connect));

                                            while ($rowview = mysqli_fetch_assoc($resultview)) {
                                                echo '<tr>';
                                                echo '<td>' . $rowview["review_id"] . '</td>';
                                                echo '<td>' . $rowview["order_id"] . '</td>';
                                                $sqlload1 = "SELECT name FROM product WHERE product_id='$rowview[product_id]'";
                                                $resultload1 = mysqli_query($connect, $sqlload1) or die("sql error in sqlload1" . mysqli_error($connect));
                                                $rowload1 = mysqli_fetch_assoc($resultload1);
                                                echo '<td>' . $rowload1["name"] . '</td>';                                                
                                                $sqlload2 = "SELECT name FROM weight WHERE weight_id='$rowview[weight_id]'";
                                                $resultload2 = mysqli_query($connect, $sqlload2) or die("sql error in sqlload2" . mysqli_error($connect));
                                                $rowload2 = mysqli_fetch_assoc($resultload2);
                                                echo '<td>' . $rowload2["name"] . '</td>';
                                                echo '<td>' . $rowview["rate"] . '</td>';
                                                echo '<td>' . $rowview["date"] . '</td>';
                                                echo '<td>' . $rowview["comment"] . '</td>';
                                                echo '<td>';
                                                echo '<div class="d-flex align-items-center pt-3">
                                                        <a class="btn btn-outline-info me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Review.php&option=fullview&pk1=' . $rowview["review_id"] . '"><i class="fas fa-eye"></i></a>
                                                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Review.php&option=edit&pk1=' . $rowview["review_id"] . '"><i class="fas fa-edit"></i></a>'; ?>
                                                        <a class="btn btn-outline-danger btn-md-square rounded-circle" onclick="return ask_delete('<?php echo $rowview["review_id"]; ?>')" href="index.php?Tables=Tables/Review.php&option=delete&pk1=<?php echo $rowview["review_id"]; ?>"><i class="fas fa-trash"></i></a>
                                                    </div>
                                            <?php
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Review ID</th>
                                                <th>Order ID</th>
                                                <th>Product ID</th>
                                                <th>Weight ID</th>
                                                <th>Rate</th>
                                                <th>Date</th>
                                                <th>Comments</th>
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
        <!-- Review view Page End -->
    <?php
    }
    ?>


    <!-- DELETE -->
    <?php
    if ($_GET["option"] == "delete") {

    ?>
        <!-- Review Delete Page Start -->
        <?php

        $userid = $_GET["pk1"];

        $sqldelete = "DELETE FROM review WHERE review_id='$userid'";
        $resultview = mysqli_query($connect, $sqldelete) or die("sql error in sqldelete" . mysqli_error($connect));
        if ($resultview) {
            echo '<script>alert("Successfully Deleted"); window.location.href="index.php?Tables=Tables/Review.php&option=view";</script>';
        }
        ?>

        <!-- Review Delete Page End -->
    <?php
    }
    ?>


    <!-- FULL VIEW -->
    <?php
    if ($_GET["option"] == "fullview") {

    ?>
        <?php

        $userid = $_GET["pk1"];

        $sqlfullview = "SELECT * FROM review WHERE review_id='$userid'";
        $resultfullview = mysqli_query($connect, $sqlfullview) or die("sql error in sqlfullview" . mysqli_error($connect));
        $rowfullview = mysqli_fetch_assoc($resultfullview)
        ?>
        <!-- Review Fullview Page Start -->

        <div class="col-sm-12 col-xl-6 mx-auto mt-4  ">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4 text-uppercase text-info text-al text-center ">Review Full View</h6>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Review ID</th>
                            <td><?php echo $rowfullview["review_id"]; ?></td>
                        </tr>
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
                            <th>Rate</th>
                            <td><?php echo $rowfullview["rate"]; ?></td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td><?php echo $rowfullview["date"]; ?></td>
                        </tr>
                        <tr>
                            <th>Comment</th>
                            <td><?php echo $rowfullview["comment"]; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class=" d-grid gap-2 col-3 mx-auto pt-2 ">
                    <a href="index.php?Tables=Tables/Review.php&option=view">
                        <button type="button" class="btn btn-outline-dark py-2 text-uppercase w-100">View</button>
                    </a>
                    <a href="index.php?Tables=Tables/Review.php&option=edit&pk1=<?php echo $rowfullview["review_id"]; ?>">
                        <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-secondary">Edit</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Review Fullview Page End -->
    <?php
    }
    ?>


    <!-- EDIT -->
    <?php
    if ($_GET["option"] == "edit") {

    ?>
        <!-- Review Edit Page Start -->

        <?php

        $userid = $_GET["pk1"];

        $sqledit = "SELECT * FROM review WHERE review_id='$userid'";
        $resultedit = mysqli_query($connect, $sqledit) or die("sql error in sqledit" . mysqli_error($connect));
        $rowedit = mysqli_fetch_assoc($resultedit)
        ?>

        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Review.php&option=update" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                        <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Review ID<sup>*</sup></label>
                                        <input type="text" class="form-control" value="<?php echo $rowedit["review_id"]; ?>" name="txtreviewid" readonly>
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
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Rate<sup>*</sup></label>
                                        <select class="form-select" aria-label="Default select example" value="<?php echo $rowedit["rate"]; ?>" name="txtrate">
                                            <option selected disabled>Valuable Rate Please</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Date<sup>*</sup></label>
                                        <input type="date" class="form-control" value="<?php echo $rowedit["order_id"]; ?>" name="txtdate">
                                    </div>
                                </div>
                            </div>
                            <div class="form-item mt-4">
                                <textarea name="text" value="<?php echo $rowedit["comment"]; ?>" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Comments..." ></textarea>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnupdate" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Update</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Review.php&option=view">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Review Edit Page End -->
    <?php
    }
    ?>


    <!-- UPDATE -->
    <?php
    if ($_GET["option"] == "update") {

    ?>
        <!-- Review Update Page Start -->

        <?php
        if (isset($_POST["btnupdate"])) {
            $sqlupdate = "UPDATE review SET 
                            order_id = '" . mysqli_real_escape_string($connect, $_POST["txtorderid"]) . "',
                            product_id = '" . mysqli_real_escape_string($connect, $_POST["txtproductid"]) . "',
                            weight_id = '" . mysqli_real_escape_string($connect, $_POST["txtweightid"]) . "',
                            rate = '" . mysqli_real_escape_string($connect, $_POST["txtrate"]) . "',
                            date = '" . mysqli_real_escape_string($connect, $_POST["txtdate"]) . "',
                            comment = '" . mysqli_real_escape_string($connect, $_POST["text"]) . "'
                            WHERE review_id = '" . mysqli_real_escape_string($connect, $_POST["txtreviewid"]) . "' ";

            $resultupdate = mysqli_query($connect, $sqlupdate) or die("sql error in sqlupdate" . mysqli_error($connect));
            if ($resultupdate) {
                echo '<script>alert("Success"); window.location.href="index.php?Tables=Tables/Review.php&option=view";</script>';
            }
        } 
        else 
        {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Review Update Page End -->
    <?php
    }
    ?>


<?php
}
?>
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
        $get_cat_id=$_GET["cat_id"];
    ?>
        <!-- Subcategory Add Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Subcategory.php&option=insert" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2"></div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="form-item">
                                <label class="form-label my-3">Subcategory ID<sup>*</sup></label>
                                <?php
                                        $sqlgenerateid="SELECT subcategory_id FROM subcategory ORDER BY subcategory_id DESC LIMIT 1";
                                        $resultgenerateid = mysqli_query($connect, $sqlgenerateid) or die("sql error in sqlgenerateid" . mysqli_error($connect));
                                        if(mysqli_num_rows($resultgenerateid)==1)
                                        {
                                            $rowgenerateid=mysqli_fetch_assoc($resultgenerateid);
                                            $generateid=++$rowgenerateid["subcategory_id"];
                                        }
                                        else
                                        {//for first time
                                            $generateid="SCA001";
                                        }
                                ?>
                                <input type="text" class="form-control" placeholder="SCA000" name="txtsubcategorysubcategoryid" value="<?php echo $generateid; ?>" readonly>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Name<sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="specific event" name="txtsubcategoryname" onkeypress="return isTextKey(event)">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Category ID<sup>*</sup></label>
                                <select class="form-control" placeholder="cat000" name="txtsubcategorycategoryid">
                                    
                                    <?php
                                    $sqlload="SELECT category_id, name FROM category WHERE category_id='$get_cat_id'";
                                    $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                    while($rowload=mysqli_fetch_assoc($resultload))
                                    {
                                        echo '<option value="'.$rowload["category_id"].'">'.$rowload["name"].'</option>';
                                    }                                        
                                    ?>
                                </select>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnsubmit" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Submit</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Category.php&option=fullview&pk1=<?php echo $get_cat_id; ?>">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <!-- Subcategory Add Page End -->
    <?php
    }
    ?>

    <!-- INSERT -->
    <?php
    if ($_GET["option"] == "insert") {

    ?>
        <!-- Subcategory Insert Page Start -->

        <?php
        if (isset($_POST["btnsubmit"])) {
            $sqlinsert = "INSERT INTO subcategory(subcategory_id,name,category_id) 
            VALUES('" . mysqli_real_escape_string($connect, $_POST["txtsubcategorysubcategoryid"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtsubcategoryname"]) . "',
            '" . mysqli_real_escape_string($connect, $_POST["txtsubcategorycategoryid"]) . "')";

            $resultinsert = mysqli_query($connect, $sqlinsert) or die("sql error in sqlinsert" . mysqli_error($connect));
            if ($resultinsert) {
                echo '<script>alert("Success");
                window.location.href="index.php?Tables=Tables/Subcategory.php&option=add&cat_id='. $_POST["txtsubcategorycategoryid"].'";</script>';
            }
        } else {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Subcategory Insert Page End -->
    <?php
    }
    ?>

    <!-- VIEW -->
    <?php
    if ($_GET["option"] == "view") {

    ?>
        <!-- Subcategory view Page Start -->
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
                    <div class="col-md-7 col-sm-10 mx-auto mt-2 ">
                        <div class="card">
                            <div class="card-header bg-dark ">
                                <div class="card-title">
                                    <h4 class="float-start text-primary ">List Of Subcategories</h4>
                                    <a href="index.php?Tables=Tables/Subcategory.php&option=add"><button type="button" class="card-title float-end btn btn-outline-primary py-2 text-uppercase">Add SubCategory</button></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 500px">
                                        <thead>
                                            <tr>
                                                <th>Subcategory ID</th>
                                                <th>Name</th>
                                                <th>Category ID</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $sqlview = "SELECT subcategory_id,name,category_id FROM subcategory";
                                            $resultview = mysqli_query($connect, $sqlview) or die("sql error in sqlview" . mysqli_error($connect));

                                            while ($rowview = mysqli_fetch_assoc($resultview)) {
                                                $a = $rowview["category_id"];
                                                echo '<tr>';
                                                echo '<td>' . $rowview["subcategory_id"] . '</td>';
                                                echo '<td>' . $rowview["name"] . '</td>';
                                                $sqlload = "SELECT name FROM category WHERE category_id='$rowview[category_id]'";
                                                $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                                $rowload = mysqli_fetch_assoc($resultload);
                                                echo '<td>' . $rowload["name"] . '</td>';
                                                echo '<td>';
                                                echo '<div class="d-flex align-items-center pt-3">
                                                        <a class="btn btn-outline-info me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Subcategory.php&option=fullview&pk1=' . $rowview["subcategory_id"] . '"><i class="fas fa-eye"></i></a>
                                                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href="index.php?Tables=Tables/Subcategory.php&option=edit&pk1=' . $rowview["subcategory_id"] . '"><i class="fas fa-edit"></i></a>'; ?>
                                                <a class="btn btn-outline-danger btn-md-square rounded-circle" onclick="return ask_delete('<?php echo $rowview["name"]; ?>')" href="index.php?Tables=Tables/Subcategory.php&option=delete&pk1=<?php echo $rowview["subcategory_id"]; ?>"><i class="fas fa-trash"></i></a>
                                                    </div>
                                            <?php
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Subcategory ID</th>
                                                <th>Name</th>
                                                <th>Category ID</th>
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
        <!-- Subcategory view Page End -->
    <?php
    }
    ?>

    <!-- DELETE -->
    <?php
    if ($_GET["option"] == "delete") {

    ?>
        <!-- Subcategory Delete Page Start -->
        <?php

        $userid = $_GET["pk1"];
        $cat_id = $_GET["pk2"];

        $sqldelete = "DELETE FROM subcategory WHERE subcategory_id='$userid'";
        $resultview = mysqli_query($connect, $sqldelete) or die("sql error in sqldelete" . mysqli_error($connect));
        if ($resultview) {
            echo '<script>alert("Successfully Deleted"); window.location.href="index.php?Tables=Tables/Category.php&option=fullview&pk1='.$cat_id.'";</script>';
        }
        ?>

        <!-- Subcategory Delete Page End -->
    <?php
    }
    ?>


    <!-- FULL VIEW -->
    <?php
    if ($_GET["option"] == "fullview") {

    ?>
        <?php

        $userid = $_GET["pk1"];

        $sqlfullview = "SELECT * FROM subcategory WHERE subcategory_id='$userid'";
        $resultfullview = mysqli_query($connect, $sqlfullview) or die("sql error in sqlfullview" . mysqli_error($connect));
        $rowfullview = mysqli_fetch_assoc($resultfullview)
        ?>
        <!-- Subcategory Fullview Page Start -->

        <div class="col-sm-12 col-xl-6 mx-auto mt-4  ">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4 text-uppercase text-info text-al text-center ">Subcategory Full View</h6>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Subcategory ID</th>
                            <td><?php echo $rowfullview["subcategory_id"]; ?></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><?php echo $rowfullview["name"]; ?></td>
                        </tr>
                        <tr>
                            <th>Category ID</th>
                            <?php
                            $sqlload = "SELECT name FROM category WHERE category_id='$$rowfullview[category_id]'";
                            $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                            $rowload = mysqli_fetch_assoc($resultload);
                            echo '<td>' . $rowload["name"] . '</td>';
                            ?>
                        </tr>
                    </tbody>
                </table>
                <div class=" d-grid gap-2 col-3 mx-auto pt-2 ">
                    <a href="index.php?Tables=Tables/Subcategory.php&option=view">
                        <button type="button" class="btn btn-outline-dark py-2 text-uppercase w-100">View</button>
                    </a>
                    <a href="index.php?Tables=Tables/Subcategory.php&option=edit&pk1=<?php echo $rowfullview["subcategory_id"]; ?>">
                        <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-secondary">Edit</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Subcategory Fullview Page End -->
    <?php
    }
    ?>


    <!-- EDIT -->
    <?php
    if ($_GET["option"] == "edit") {

    ?>
        <!-- Subcategory Edit Page Start -->

        <?php

        $userid = $_GET["pk1"];

        $sqledit = "SELECT * FROM subcategory WHERE subcategory_id='$userid'";
        $resultedit = mysqli_query($connect, $sqledit) or die("sql error in sqledit" . mysqli_error($connect));
        $rowedit = mysqli_fetch_assoc($resultedit)
        ?>

        <div class="container-fluid py-5">
            <div class="container py-5">
                <form action="index.php?Tables=Tables/Subcategory.php&option=update" method="POST">
                    <div class="row g-5">
                        <div class="col-lg-2 col-xl-2">

                        </div>
                        <div class="col-md-12 col-lg-8 col-xl-8">
                            <div class="form-item">
                                <label class="form-label my-3">Subcategory ID<sup>*</sup></label>
                                <input type="text" readonly class="form-control" value="<?php echo $rowedit["subcategory_id"]; ?>" name="txtsubcategorysubcategoryid">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Name<sup>*</sup></label>
                                <input type="text" class="form-control" value="<?php echo $rowedit["name"]; ?>" name="txtsubcategoryname" onkeypress="return isTextKey(event)">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Category ID<sup>*</sup></label>
                               
                                <select class="form-control" name="txtsubcategorycategoryid">
                                    <?php
                                    $sqlload="SELECT category_id, name FROM category WHERE category_id='$rowedit[category_id]'";
                                    $resultload = mysqli_query($connect, $sqlload) or die("sql error in sqlload" . mysqli_error($connect));
                                    while($rowload=mysqli_fetch_assoc($resultload))
                                    {
                                        echo '<option selected value="'.$rowload["category_id"].'">'.$rowload["name"].'</option>';                                       
                                       
                                    }                                        
                                    ?>
                                </select>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-4 ">
                                <button type="submit" name="btnupdate" class="btn border-secondary py-2 text-uppercase w-100 text-primary">Update</button>
                            </div>
                            <div class=" d-grid col-3 mx-auto pt-2 ">
                                <a href="index.php?Tables=Tables/Category.php&option=fullview&pk1=<?php echo $rowedit["category_id"]; ?>">
                                    <button type="button" class="btn border-secondary py-2 text-uppercase w-100 text-primary">View</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Subcategory Edit Page End -->
    <?php
    }
    ?>


    <!-- UPDATE -->
    <?php
    if ($_GET["option"] == "update") {

    ?>
        <!-- Subcategory Update Page Start -->

        <?php
        if (isset($_POST["btnupdate"])) {
            $sqlupdate = "UPDATE subcategory SET 
                            name = '" . mysqli_real_escape_string($connect, $_POST["txtsubcategoryname"]) . "',
                            category_id = '" . mysqli_real_escape_string($connect, $_POST["txtsubcategorycategoryid"]) . "'
                            WHERE subcategory_id = '" . mysqli_real_escape_string($connect, $_POST["txtsubcategorysubcategoryid"]) . "' ";

            $resultupdate = mysqli_query($connect, $sqlupdate) or die("sql error in sqlupdate" . mysqli_error($connect));
            if ($resultupdate) {
                echo '<script>alert("Success"); 
                window.location.href="index.php?Tables=Tables/Category.php&option=fullview&pk1='.$_POST["txtsubcategorycategoryid"].'";</script>';
            }
        } else {
            echo '<script>window.location.href="index.php";</script>';
        }
        ?>

        <!-- Subcategory Update Page End -->
    <?php
    }
    ?>



<?php
}
?>
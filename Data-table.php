<?php

if (!isset($_SESSION)) {
    session_start();
}

include("db_connection.php");

?>
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
            <div class="col-10 mx-auto mt-2 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Basic Datatable</h4>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-primary">Primary</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <!-- <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Donna Snider</td>
                                        <td>Customer Support</td>
                                        <td>New York</td>
                                        <!-- <td>27</td>
                                        <td>2011/01/25</td>
                                        <td>$112,000</td> -->
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <!-- <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th> -->
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
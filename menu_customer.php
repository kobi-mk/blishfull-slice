<!-- Page Nav Start -->
<div class="navbar-nav mx-auto">
    <a href="index.php" class="nav-item nav-link active">Customer</a>
    <a href="index.php?page=0" class="nav-item nav-link">Shop</a>
    <a href="index.php?page=9" class="nav-item nav-link">Contact</a>
    
     <!-- 
    <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
        <div class="dropdown-menu m-0 bg-secondary rounded-0">
            
           
            <a href="index.php?page=1" class="nav-item nav-link">Shop Detail</a>
            <a href="index.php?page=2" class="dropdown-item">Cart</a>
            <a href="index.php?page=3" class="dropdown-item">Checkout</a>
            <a href="index.php?page=4" class="dropdown-item">Testimonial</a>
            <a href="index.php?page=5" class="dropdown-item">404 Page</a>
            <a href="index.php?page=6" class="dropdown-item">Testing</a>
            <a href="index.php?page=7" class="dropdown-item">Table</a>
            <a href="index.php?page=8" class="dropdown-item">Data-table</a> 
        </div>
    </div>
        -->
            
    <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Tables</a>
        <div class="dropdown-menu m-0 bg-secondary rounded-0">
            <a href="index.php?Tables=Tables/Category.php&option=view" class="dropdown-item">Category</a>
            <a href="index.php?Tables=Tables/Subcategory.php&option=view" class="dropdown-item">Subcategory</a>
            <a href="index.php?Tables=Tables/Weight.php&option=view" class="dropdown-item">Weight</a>
            <a href="index.php?Tables=Tables/Product.php&option=view" class="dropdown-item">Product</a>
            <a href="index.php?Tables=Tables/Product_Weight.php&option=view" class="dropdown-item">Product_Weight</a>
            <a href="index.php?Tables=Tables/Product_Image.php&option=view" class="dropdown-item">Product_Image</a>
            <a href="index.php?Tables=Tables/Staff.php&option=view" class="dropdown-item">Staff</a>
            <a href="index.php?Tables=Tables/Customer.php&option=view" class="dropdown-item">Customer</a>
            <a href="index.php?Tables=Tables/Order_Detail.php&option=view" class="dropdown-item">Order_Detail</a>
            <a href="index.php?Tables=Tables/Order_Product.php&option=view" class="dropdown-item">Order_Product</a>
            <a href="index.php?Tables=Tables/Custom_Order.php&option=view" class="dropdown-item">Custom_Order</a>
            <a href="index.php?Tables=Tables/Payment.php&option=view" class="dropdown-item">Payment</a>
            <a href="index.php?Tables=Tables/Delivery_Details.php&option=view" class="dropdown-item">Delivery_Details</a>
            <a href="index.php?Tables=Tables/Review.php&option=view" class="dropdown-item">Review</a>
        </div>
    </div>
    <!-- <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">5_Login</a>
        <div class="dropdown-menu m-0 bg-secondary rounded-0">
            <a href="index.php?Login=Login/Changepassword.php" class="dropdown-item">Changepassword</a>
            <a href="logout.php" class="dropdown-item">Logout</a>
        </div>
    </div> -->
</div>

<div class="d-flex m-3 me-0">
    <!-- SHOPPING CART -->
    <a href="index.php?page=2" class="position-relative me-4 my-auto">
        <i class="fa fa-shopping-bag fa-2x"></i>
        <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
    </a>
    <!-- USER -->
    <div class="me-3 mt-1">
        <div class="nav-item dropdown">
            <a class="my-auto"><i class="fas fa-user fa-2x"></i></a>
            <div class="dropdown-menu me-2 bg-secondary rounded-0">
                <a href="index.php?Login=Login/Changepassword.php" class="dropdown-item">Changepassword</a>
                <a href="logout.php" class="dropdown-item">Logout</a>
            </div>
        </div>
    </div>
    <!-- SEARCH -->
    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-0" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
</div>
<!-- Page Nav Start -->
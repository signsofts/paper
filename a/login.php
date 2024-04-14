<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./head.php") ?>
</head>




<body class="">

    <?php include("./header.php") ?>

    <section id="banner" class="py-3" style="background: #F9F3EC;">
        <div class="container">
            <div class="hero-content py-5 my-3">
                <h2 class="display-1 mt-3 mb-0">Sign In - Sign Up</h2>
                <nav class="breadcrumb">
                    <a class="breadcrumb-item nav-link" href="./index.php">Home</a>
                    <span class="breadcrumb-item active" aria-current="page">Sign In - Sign Up</span>
                </nav>
            </div>
        </div>
    </section>

    <section class="login-tabs padding-large">
        <div class="container my-5 py-5">
            <div class="row">
                <div class="tabs-listing">
                    <nav>
                        <div class="nav nav-tabs d-flex justify-content-center border-dark-subtle mb-3" id="nav-tab" role="tablist">
                            <button class="nav-link mx-3 fs-3 border-bottom border-dark-subtle border-0 text-uppercase active" id="nav-sign-in-tab" data-bs-toggle="tab" data-bs-target="#nav-sign-in" type="button" role="tab" aria-controls="nav-sign-in" aria-selected="true">Log In</button>

                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade active show " id="nav-sign-in" role="tabpanel" aria-labelledby="nav-sign-in-tab">
                            <div class="col-lg-8 offset-lg-2 mt-5">

                                <p class="mb-0">Log - In</p>
                                <hr class="my-1">

                                <form id="form1" action="../api/a/login.php" method="POST" class="form-group flex-wrap ">
                                    <div class="form-input col-lg-12 my-4">

                                        <input type="text" id="exampleInputEmail1" name="AD_EMAIL" placeholder="Enter email address" class="form-control mb-3 p-4" value="admin@admin.com">
                                        <input type="password" id="inputPassword1" placeholder="Enter password" name="AD_PASSWORD" class="form-control mb-3 p-4" aria-describedby="passwordHelpBlock" value="admin@admin.com">


                                        <div class="d-grid my-3">
                                            <button type="submit" class="btn btn-dark btn-lg rounded-1">Log In</button>
                                        </div>

                                    </div>
                                </form>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr style="margin-bottom: 200px ;">

    <?php include("./footer.php") ?>
    
</body>

</html>
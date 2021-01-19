<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Accessories portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* body {
            padding-top: 56px;
        } */

        .layout {
            background: lightcoral;
            border: 2px solid black;
        }

        .topPadding {
            padding-top: 20px;
        }

        .center {
            text-align: center;
            /* float: ; */
            /* vertical-align: middle; */
            /* align-items: center; */
            /* display: flex; */
            margin-left: auto;
            margin-right: auto;
            /* border: 3px solid green; */
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css" />

</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="home.php"><img src="assets/sports-logo.png" alt="" width="40" height="40"> Accessories Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link"><?php
                                        session_start();
                                        $email = $_SESSION['email'];
                                        print(explode("@", "Welcome " . $email)[0]); ?>
                        <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <div class="dropdown">
                        <button type="button" class="btn btn-dark" data-toggle="dropdown">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
                            <!-- <span class="badge badge-pill badge-light">3</span> -->
                        </button>
                        <div class="dropdown-menu">
                            <?php
                            if (isset($_POST['search'])) {
                                // session_start();

                                $_SESSION['search'] = $_POST['search'];
                                header("Location: search.php");
                            }

                            if (!isset($_POST['checkout'])) {
                                $con = mysqli_connect("localhost", "root", "", "accessories");

                                if (mysqli_connect_errno()) {
                                    echo "Failed to connect to MySQL: " . mysqli_connect_errno();
                                }

                                $query = "select * from cart";
                                $r = mysqli_query($con, $query);

                                $_SESSION['price'] = 0;

                                $price = 0;
                                if (mysqli_num_rows($r) > 0) {
                                    while ($rw = mysqli_fetch_assoc($r)) {
                                        echo '<div class="row cart-detail">
                                <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                    <img src="' . $rw["imageUrl"] . '" />
                                </div>
                                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                    <p>' . $rw["productName"] . '</p>
                                    <span class="price text-info"> ₹' . $rw["price"] . '</span>
                                </div>
                            </div>';
                                        $_SESSION['price'] += (int)$rw["price"];
                                        $price = $_SESSION['price'];
                                    }
                                    echo ' <div class="row total-header-section">
                                <div class="col-lg-6 col-sm-6 col-6">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    
                                </div>
                                <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                    <p>Total: <span class="text-info">₹' . $price . '</span></p>
                                </div>
                            </div>';
                                } else {
                                    echo "Empty cart";
                                }
                            } else {
                                echo "<h3 class='display-4'>Items purchased and delivered.</h3>";
                                $con = mysqli_connect("localhost", "root", "", "accessories");

                                if (mysqli_connect_errno()) {
                                    echo "Failed to connect to MySQL: " . mysqli_connect_errno();
                                }

                                $query = "select * from cart";
                                $r = mysqli_query($con, $query);

                                // $resUpdate = "UPDATE `accessories` SET `quantity`=[value-6] WHERE 1";

                                if (mysqli_num_rows($r) > 0) {
                                    while ($rw1 = mysqli_fetch_assoc($r)) {
                                        $quantity = (int)$rw1['quantity'];
                                        $productId = (int)$rw1['productId'];
                                        // print($quantity);
                                        if ($quantity > 0) {
                                            $quantity = $quantity - 1;
                                            // print($quantity);
                                            mysqli_query($con, "UPDATE `accessories` SET `quantity`=  $quantity where productId = $productId");
                                        } else {
                                            echo "error";
                                        }
                                    }
                                }


                                // $resUp = mysqli_query($con, "select * from accessories");



                                $r = mysqli_query($con, "delete from cart");


                                if ($r) {
                                    //
                                } else {
                                    echo "Error while checking out.";
                                }
                            } ?>

                            <form method="post">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                        <button class="btn btn-primary btn-block" type="submit" name="checkout">Checkout</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0" method="post" role="form" id="templateno-preferences-form">
                <input class="form-control mr-sm-2" type="text" placeholder="Search accessories" aria-label="Search" name="search" id="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="searchQ" value="Search">Search</button>
            </form>




        </div>
    </nav>

    <h1 class="display-4 center topPadding"><img src="assets/sports-logo.png" alt="" width="100" height="100"> Accessories Store</h1>

    <form method="post">
        <div class="container">
            <div class="row">
                <?php
                $con = mysqli_connect("localhost", "root", "", "accessories");

                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_errno();
                }

                $query = "select * from accessories";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        if (isset($_POST[$row["productId"]])) {

                            $con = mysqli_connect("localhost", "root", "", "accessories");

                            if (mysqli_connect_errno()) {
                                echo "Failed to connect to MySQL: " . mysqli_connect_errno();
                            }

                            $insert_query = "INSERT INTO `cart` (productName,productId,description,price,imageUrl,quantity) VALUES ('{$row['productName']}','{$row['productId']}','{$row['description']}','{$row['price']}','{$row['imageUrl']}','{$row['quantity']}')";

                            $res = mysqli_query($con, $insert_query);

                            if ($res) {
                                // print("<script>alert('success');</script>");
                            } else {
                                echo ("Error: " . $res);
                            }
                        }
                        echo '<div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="#"
                            ><img
                                class="card-img-top"
                                src= ' . $row["imageUrl"] . '
                                alt=""
                            /></a>
                            <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">' . strval($row["productName"]) . '</a>
                            </h4>
                            <h5>₹' . $row["price"] . '</h5>
                            <p class="card-text">
                                ' . $row["description"] . '
                            </p>
                            </div>
                            <div class="card-footer">
                            <input type="submit" class="btn btn-primary btn-sm" name=' . $row["productId"] . ' value="Add to cart"/>
                            </div>
                        </div>
                        </div>';
                    }
                } else {
                    echo "error";
                } ?>
            </div>
        </div>
    </form>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Accessories portal</title>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <?php
    $password = $email = $username = "";
    if (isset($_POST['username']) || isset($_POST['email'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];

        $password = $_POST['password'];

        $con = mysqli_connect("localhost", "root", "", "accessories");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_errno();
        }

        $query = "SELECT * FROM users WHERE (username='$username' or email='$email') and password='$password'";
        $result = mysqli_query($con, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;

                header("Location: home.php");
            } else {
                echo ("Invalid credentials");
            }
        } else {
            echo ("Invalid credentials");
        }
    }
    ?>


    <form role="form" id="templateno-preferences-form" name="login" action="" method="post" class="form-signin">
        <img class="mb-4" src="assets/sports-logo.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Login </h1>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Email or Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <!--<a>Haven't registered? Click here.</a>-->
        <div class=" p-1">
            <a href="index.php">Haven't registered? Click here.</a>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
        <!--<button type="submit"  name="submit" value="Register" >Update</button>-->
        <p class="mt-5 mb-3 text-muted">&copy; Szepetry: 2021-present</p>

    </form>

</body>
</html>
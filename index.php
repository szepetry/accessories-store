<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Accessories portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

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
    <link href="signin.css" rel="stylesheet">

</head>

<body class="text-center">
    <?php
    $Name = $Age = $Contact = $Password = $Email = $Username = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Name = $_POST['name'];
        $Age = $_POST['age'];
        $Email = $_POST['email'];
        $Contact = $_POST['contact'];
        $Password = $_POST['password'];
        $Username = $_POST['username'];

        $con = mysqli_connect("localhost", "root", "", "accessories");


        $query = "INSERT INTO `users` (email, age, contact, name, password, username) VALUES ('$Email', '$Age', '$Contact', '$Name', '$Password', '$Username')";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo ("<script type=\"text/javascript\">" .
                "alert('Registration successful.');" .
                "</script>");
        } else {
            echo ("Fail");
        }
    }
    ?>


    <form action="" method="post" class="form-signin">
        <img class="mb-4" src="assets/sports-logo.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Registration </h1>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required>
        <label for="inputName" class="sr-only">Name</label>
        <input type="text" name="name" id="inputName" class="form-control" placeholder="Name" required>
        <label for="inputAge" class="sr-only">Age</label>
        <input type="text" name="age" id="inputAge" class="form-control" placeholder="Age" required>
        <label for="inputContact" class="sr-only">Contact</label>
        <input type="text" name="contact" id="inputContact" class="form-control" placeholder="Contact number" required>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

        <div class=" p-1">
            <a href="login.php">Already have an account? Click here.</a>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign up</button>
        <p class="mt-5 mb-3 text-muted">&copy; Szepetry: 2021-present</p>
    </form>
</body>

</html>
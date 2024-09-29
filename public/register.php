<?php
require_once '../src/config.php';
$error_message = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){  // check POST method was submitted in form
    $username = trim($_POST['username']);  // retrieves data from form field
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);  // trim() function removes any extra spaces

    if (!empty($username) && !empty($email) && !empty($password)){
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password) VALUES (?,?,?)"; //? symbols are placeholders for the actual values

        if ($stmt = $conn->prepare($sql)){
            $stmt->bind_param("sss", $username, $email ,$hashed_password); //binds the actual values to ?
            if ($stmt->execute()){
                header("Location: index.php"); // Redirect to the Sign in page
            } else{
                if ($stmt->errno == 1062) {  // 1062 is duplicate entry errorno
                    $error_message = "This email is already registered. Please use a different email.";
                } else {
                    $error_message = "An error occurred. Please try again.";
                }
            }
            // Close the statement
            $stmt->close();
        } else{
            $error_message = "Failed to prepare the statement.";
        }
    }else {
        $error_message = "Please fill out all fields.";
    }
}
// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container mx-auto m-5 div-shadow">
        <h1 class="text-center text-white mt-3">Sign Up</h1>
        <div class="row">
            <!-- Left side: Form -->
            <div class="col-md-6 first">
                <form action="register.php" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="username" placeholder="username" required>
                        <label for="floatingInput">User Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
                        <label for="floatingInput">Email Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-secondary border-warning">Register</button>
                    </div>
                    <?php if (!empty($error_message)): ?>
                        <div style="color: red;" class="text-center mt-3"><?php echo htmlspecialchars($error_message); ?></div>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Right side: Background Image -->
            <div class="col-md-6 second img1">
                <!-- Background image applied here via CSS -->
            </div>
        </div>

        <p class="text-center text-white">Already have an account? <a href="index.php">Login here</a>.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>



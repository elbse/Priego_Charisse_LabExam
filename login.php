<?php
// Start the session
session_start();

// Hardcoded credentials (for demo only)
// $valid_username = "admin";
// $valid_password = "1234";

// $message = "";

// FIXED: CHECK REQUEST METHOD CORRECTLY
// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     // Get the submitted username & password
//     $username = $_POST["username"];
//     $password = $_POST["password"];

//     if ($username === $valid_username && $password === $valid_password) {
//         $_SESSION["user"] = $username;
//         header("Location: dashboard.php");
//         exit();
//     } else {
//         $message = "Invalid username or password!";
//     }
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>

<div class="logo">
    <img src="assets/Group10.png" alt="Logo">
</div>

<div class="container" >
    <div class="login-box">
        <h2>Welcome!</h2>

        <?php if (!empty($message)) : ?>
            <p class="error"><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="POST">
            <h5>Email</h5>
            <input type="text" name="username" required>
            <h5>Password</h5>
            <input type="password" name="password"required>
            <button type="submit">Login</button>
        </form>
        <div class="line">
            <a href="#" class="forgot">Forgot Password?</a>
        </div>

        <!-- Footer: Terms & Conditions + Sign Up -->
        <div class="footer-links">
            <p class="signup">Don’t have an account? <a href="#" class="signup-link">Sign Up</a></p>
            <a href="#" class="terms">Terms & Conditions</a>
        </div>


    </div>
</div>

<div class="image">
    <img src="assets/Group12.png" alt="Image">
</div>

</body>
</html>

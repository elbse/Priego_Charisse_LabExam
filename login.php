<?php

session_start();


if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = array();
}

$showSuccessPopup = false;
$message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = isset($_POST["username"]) ? trim($_POST["username"]) : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    
    $userFound = false;
    foreach ($_SESSION['users'] as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            $userFound = true;
            $_SESSION["logged_in_user"] = $user;
            $showSuccessPopup = true;
            break;
        }
    }

    if (!$userFound) {
        $message = "Invalid email or password!";
    }
}

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

<body></body>

<div class="logo">
    <img src="assets/Group10.png" alt="Logo">
</div>

<div class="container" >
    <div class="login-box">
        <h2>Welcome!</h2>

        <?php if (!empty($message)) : ?>
            <p class="error"><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="POST" id="loginForm">
            <h5>Email</h5>
            <input type="text" name="username" required>
            <h5>Password</h5>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <div class="line">
            <a href="#" class="forgot">Forgot Password?</a>
        </div>

       
       <div class="footer-links">
            <p class="signup">
                Don’t have an account? <a href="register.php" class="signup-link">Sign Up</a>
            </p>
            <a href="#" class="terms">Terms & Conditions</a>
        </div>



    </div>
</div>

<div class="image">
    <img src="assets/Group12.png" alt="Image">
</div>


<?php if ($showSuccessPopup): ?>
<div id="successPopup" class="popup">
    <div class="popup-content">
        <span class="popup-close" onclick="closePopup()">&times;</span>
        <p>Signed In</p>
    </div>
</div>
<script>
  
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('successPopup').style.display = 'flex';
       
        setTimeout(function() {
            closePopup();
        }, 3000);
    });
</script>
<?php endif; ?>

<script>
function closePopup() {
    document.getElementById('successPopup').style.display = 'none';
}
</script>

</body>
</html>

<?php

session_start();


if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = array();
}

$showSuccessPopup = false;
$message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $fullname = isset($_POST["fullname"]) ? trim($_POST["fullname"]) : "";
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";


    $emailExists = false;
    foreach ($_SESSION['users'] as $user) {
        if ($user['email'] === $email) {
            $emailExists = true;
            $message = "Email already registered!";
            break;
        }
    }

    
    if (!$emailExists && !empty($fullname) && !empty($email) && !empty($username) && !empty($password)) {
        $newUser = array(
            'fullname' => $fullname,
            'email' => $email,
            'username' => $username,
            'password' => $password
        );
        $_SESSION['users'][] = $newUser;
        $showSuccessPopup = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

<div class="logo">
    <img src="assets/Group10.png" alt="Logo">
</div>

<div class="container">
    <div class="login-box">
        <h2>Create Account</h2>

        <?php if (!empty($message)) : ?>
            <p class="error"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="POST" id="registerForm">
            <h5>Full Name</h5>
            <input type="text" name="fullname" required>

            <h5>Email</h5>
            <input type="email" name="email" required>

            <h5>Username</h5>
            <input type="text" name="username" required>

            <h5>Password</h5>
            <input type="password" name="password" required>

            <button type="submit">Register</button>
        </form>

       
        <div class="footer-links">
            <p class="signup">
                Already have an account? <a href="login.php" class="signup-link">Login</a>
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
        <p>Account Created</p>
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

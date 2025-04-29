<?php
session_start();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['errors'] = [];

    // Name Validation
    if (empty($name)) {
        $_SESSION['errors']['name'] = "Name is required";
    }

    // Email Validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors']['email'] = "Enter a valid email";
    }

    // Password Validation
    if (strlen($password) < 8) {
        $_SESSION['errors']['password'] = "Password must be at least 8 characters";
    } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
        $_SESSION['errors']['password'] = "Password must include uppercase, lowercase, number, and special character";
    }

    // Confirm Password Validation
    if ($password !== $confirmPassword) {
        $_SESSION['errors']['confirmPassword'] = "Passwords do not match";
    }

    // If no errors, registration is successful
    if (empty($_SESSION['errors'])) {
        $_SESSION['success'] = "Registration Successful!";
        unset($_SESSION['name'], $_SESSION['email']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.85);
            max-width: 400px;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        h2 { text-align: center; color: #333; margin-bottom: 25px; font-weight: 500; }
        .input-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 7px; color: #555; font-weight: 500; }
        input {
            width: 100%; padding: 12px; border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px; outline: none; background-color: rgba(255, 255, 255, 0.7);
        }
        input:focus { border-color: #667eea; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2); }
        .error { color: #d9534f; font-size: 12px; margin-top: 5px; }
        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; padding: 12px; border: none; border-radius: 8px;
            cursor: pointer; width: 100%; font-weight: 500;
        }
        button:hover { transform: translateY(-3px); box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1); }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create an Account</h2>
        <?php if (isset($_SESSION['success'])): ?>
            <p style="color: green; text-align: center;"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="input-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= $_SESSION['name'] ?? '' ?>">
                <span class="error"><?= $_SESSION['errors']['name'] ?? '' ?></span>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= $_SESSION['email'] ?? '' ?>">
                <span class="error"><?= $_SESSION['errors']['email'] ?? '' ?></span>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <span class="error"><?= $_SESSION['errors']['password'] ?? '' ?></span>
            </div>
            <div class="input-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword">
                <span class="error"><?= $_SESSION['errors']['confirmPassword'] ?? '' ?></span>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>

<?php session_destroy(); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection settings
    $servername = "localhost";
    $username = "id21151727_root";
    $password = "e38492F@ejrqerqjriqjrqrjqr";
    $dbname = "id21151727_livestore";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and validate input data
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM registration WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $loginMessage = "Login successful!";
        } else {
            $loginMessage = "Email and password do not match.";
        }
    } else {
        $loginMessage = "User not found.";
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f0f0f0;
}

.login-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
}

h2 {
    margin-bottom: 10px;
}

input {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

.options {
    margin-top: 20px;
    font-size: 14px;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
    </style>
</head>
<body>
    
    <div class="login-container">
        <h2>Login</h2>
        <form id="login-form" method="POST" action="#">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div class="message" id="login-message">
            <?php echo isset($loginMessage) ? $loginMessage : ""; ?>
        </div>
        <div class="options">
            <a href="./Auth/ForgotPass.php">Forgot Password?</a>
            <span>Don't have an account? <a href="./Auth/Register.php">Register</a></span>
        </div>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function (e) {
    // e.preventDefault();

    });
    
    </script>
</body>
</html>

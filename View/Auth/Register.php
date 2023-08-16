<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection settings
    $servername = "localhost";
    $username = "id21151727_root";
    $password = "e38492F@ejrqerqjriqjrqrjqr";
    $dbname = "id21151727_livestore";

    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and validate input data
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Insert data into the database
    $sql = "INSERT INTO registration (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        echo <<<EOL
        <script>
            window.location.href = "../";
        </script>
        EOL;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Registration Form</title>
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
    <div class="register-container">
        <h2>Register</h2>
       <form id="register-form" method="POST" action="#">
            <div class="avatar">
                <img id="avatar-preview" src="dubby.jpg" alt="Avatar">
                <input type="file" id="avatar-input" accept="image/*">
            </div>
            <input type="text" id="username" placeholder="Username or Email" name="username" required>
            <input type="password" id="password" placeholder="Password" required>
            <input type="password" id="confirm-password" placeholder="Confirm Password"   name="password" required>
            <button type="submit">Register</button>
        </form>
        <div class="options">
            <span>Already have an account? <a href="../">Login</a></span>
        </div>
    </div>
    <script>
        document.getElementById('register-form').addEventListener('submit', function (e) {
            // e.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
            if (!username || !password || !confirmPassword) {
                alert('Please fill in all fields.');
                return;
            }

            if (!isValidEmail(username)) {
                alert('Please enter a valid email address.');
                return;
            }

            if (password.length < 8 || !containsUppercase(password) || !containsLowercase(password) || !containsSpecialCharacter(password)) {
                alert('Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one special character.');
                return;
            }

            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                return;
            }

//             
alert("Submtinh went wrong");
        });

        document.getElementById('avatar-input').addEventListener('change', function (e) {
            const preview = document.getElementById('avatar-preview');
            const file = e.target.files[0];
            const reader = new FileReader();

            if (file) {
                reader.onload = function (event) {
                    preview.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        function isValidEmail(email) {
            // Basic email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function containsUppercase(str) {
            return /[A-Z]/.test(str);
        }

        function containsLowercase(str) {
            return /[a-z]/.test(str);
        }

        function containsSpecialCharacter(str) {
            return /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(str);
        }
    </script>
</body>
</html>

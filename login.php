<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">


    <style>
/* Center the entire body content */
.centered-body {
    font-family: Arial, sans-serif;
    background-color: #0a1324; /* Dark background */
    display: flex; /* Flexbox to center the content */
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    height: 100vh; /* Full height */
    margin: 0; /* Remove default margin */
    color: #333; /* Default text color */
}

/* Container for the form */
.register-container {
    background-color: #FFF5EE; /* Light background for the content */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* More prominent shadow */
    padding: 30px; /* Padding around content */
    width: 350px; /* Adjusted width */
    text-align: center;
}

/* Form header */
.form-header {
    font-size: 1.8em;
    color: #0a1324; /* Dark header text color */
    margin-bottom: 20px;
}

/* Labels for inputs */
.label {
    display: block; /* Block display for labels */
    margin-bottom: 8px; /* Space below labels */
    font-weight: bold;
    color: #555; /* Gray color for labels */
}

/* Input styles */
input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%; /* Full width inputs */
    padding: 10px; /* Padding inside inputs */
    border: 1px solid #ccc; /* Light border */
    border-radius: 5px; /* Rounded corners */
    margin-bottom: 15px; /* Space below inputs */
    box-sizing: border-box; /* Include padding in width */
}

/* Submit button styles */
.form-submit {
    background-color: #5999bf; /* Blue background */
    color: white; /* White text */
    border: none; /* No border */
    padding: 12px; /* Padding inside button */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer on hover */
    width: 100%; /* Full width button */
    font-size: 1em;
    transition: background-color 0.3s; /* Smooth transition */
}

/* Hover effect for submit button */
.form-submit:hover {
    background-color: #45a049; /* Green on hover */
}

/* Error container */
.error-container {
    background-color: #ffe6e6; /* Light red background */
    color: #b30000; /* Dark red text */
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    text-align: left;
}

/* Forgot password link */
.forgot-password {
    color: #5999bf;
    text-decoration: none;
    font-size: 0.9em;
    display: block;
    margin-top: 10px;
}

.forgot-password:hover {
    text-decoration: underline;
}

/* Adjust form for smaller screens */
@media (max-width: 480px) {
    .register-container {
        width: 90%; /* Make the container width responsive */
        padding: 20px;
    }
}



</style>



</head>
<body class="centered-body">
    <div class="register-container">
        <div class="form-container">
            <?php
            // Initialize error array
            $errors = array();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                require('mysqli_connect.php');

                // Initialize variables
                $email = $password = '';

                if (empty($_POST['email'])) {
                    $errors[] = 'You forgot to enter your email address.';
                } else {
                    $email = trim($_POST['email']);
                }

                if (empty($_POST['psword'])) {
                    $errors[] = 'You forgot to enter your password.';
                } else {
                    $password = trim($_POST['psword']);
                }

                // Check if both email and password are set
                if ($email && $password) {
                    $query = "SELECT user_id, fname, user_level, psword FROM users WHERE email=?";
                    $stmt = $dbc->prepare($query);
                    $stmt->bind_param('s', $email);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows == 1) {
                        $row = $result->fetch_assoc();
                        if (password_verify($password, $row['psword'])) {
                            session_start();
                            $_SESSION['user_id'] = $row['user_id'];
                            $_SESSION['fname'] = $row['fname'];
                            $_SESSION['user_level'] = (int)$row['user_level'];

                            $url = ($_SESSION['user_level'] === 1) ? 'admins_page.php' : 'members_page.php';
                            header("Location: $url");
                            exit();
                        } else {
                            $errors[] = 'The email address and password combination does not match our records.';
                        }
                    } else {
                        $errors[] = 'The email address and password combination does not match our records.';
                    }
                }
                $dbc->close();
            }

            // Display any errors at the top
            if (!empty($errors)) {
                echo '<div class="error-container">';
                echo '<h3>The following errors occurred:</h3>';
                echo '<ul>';
                foreach ($errors as $error) {
                    echo "<li>$error</li>";
                }
                echo '</ul>';
                echo '</div>';
            }
            ?>

            <h2 class="form-header">Login</h2>
            <form action="login.php" method="post">
                <label class="label" for="email">Email Address:</label>
                <input class="form-input" type="email" id="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">

                <label class="label" for="psword">Password:</label>
                <input class="form-input" type="password" id="psword" name="psword">

                <input class="form-submit" type="submit" name="submit" value="Login">
            </form>

            <a class="forgot-password" href="#">Forgot Password?</a>
        </div>
    </div>
</body>
</html>

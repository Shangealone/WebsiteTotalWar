<?php
session_start();
if (!isset($_SESSION['user_level']) || ($_SESSION['user_level'] != 1)) { // Only admin can access
    header("Location: login.php");
    exit();
}

require('mysqli_connect.php');

// Initialize variables
$message = '';
$users = [];

// Fetch all users to display in a dropdown
$query = "SELECT user_id, fname, lname FROM users";
if ($result = mysqli_query($dbc, $query)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    mysqli_free_result($result);
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form inputs
    $user_id = intval($_POST['user_id']);
    $new_password = trim($_POST['new_password']);

    // Validate inputs
    if (!empty($user_id) && !empty($new_password)) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $query = "UPDATE users SET password = ? WHERE user_id = ?";
        if ($stmt = mysqli_prepare($dbc, $query)) {
            mysqli_stmt_bind_param($stmt, "si", $hashed_password, $user_id);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) == 1) {
                $message = "<p class='success-message'>Password updated successfully.</p>";
            } else {
                $message = "<p class='error-message'>Error updating password. Please try again.</p>";
            }

            mysqli_stmt_close($stmt);
        } else {
            $message = "<p class='error-message'>System error: Unable to prepare the statement.</p>";
        }
    } else {
        $message = "<p class='error-message'>Please select a user and enter a new password.</p>";
    }
}

// Close the database connection
mysqli_close($dbc);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change User Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="password-change-body">
<div class="password-change-container">
    <!-- Navigation -->
    <div class="nav-container">
        <?php include('navigation_admins.php'); ?>
    </div>

    <!-- Password Change Content -->
    <div class="password-change-content">
        <h2 class="password-change-heading">Change User Password</h2>
        <?php if (!empty($message)) echo $message; ?>
        <form action="change_password.php" method="post" class="password-change-form">
            <label for="user_id" class="password-change-label">Select User:</label>
            <select name="user_id" id="user_id" class="password-change-select">
                <option value="">-- Select a User --</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo htmlspecialchars($user['user_id']); ?>">
                        <?php echo htmlspecialchars($user['fname'] . ' ' . $user['lname']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="new_password" class="password-change-label">New Password:</label>
            <input type="password" name="new_password" id="new_password" class="password-change-input" placeholder="Enter new password">

            <input type="submit" value="Change Password" class="password-change-submit">
        </form>
    </div>
</div>
</body>
</html>

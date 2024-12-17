<?php
    session_start();
    if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1)) { //admin can only access
        header("Location: login.php");
        exit();
    }
?>
<link rel="stylesheet" href="style.css">

<?php
// Include the database connection file
require('mysqli_connect.php');

// Initialize variables
$search = '';
$results = [];

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the search term
    $search = trim($_POST['search']);

    // Validate the search input
    if (!empty($search)) {
        // Prepare the query to search for users
        $query = "SELECT fname, lname, email, registration_date FROM users WHERE fname LIKE ? OR lname LIKE ? OR email LIKE ?";

        if ($stmt = mysqli_prepare($dbc, $query)) {
            // Add wildcards to the search term for partial matching
            $like_search = "%" . $search . "%";

            // Bind the parameter
            mysqli_stmt_bind_param($stmt, "sss", $like_search, $like_search, $like_search);

            // Execute the query
            mysqli_stmt_execute($stmt);

            // Get the result set
            $result = mysqli_stmt_get_result($stmt);

            // Fetch the results into an array
            while ($row = mysqli_fetch_assoc($result)) {
                $results[] = $row;
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "<p class='search-error-message'>System error: Unable to prepare the statement.</p>";
        }
    } else {
        echo "<p class='search-error-message'>Please enter a search term.</p>";
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
    <title>User Search</title>
</head>
<body class="search-body">
<div class="search-main-container">
    <!-- Navigation -->
    <div class="nav-container">

    </div>

    <!-- Search Content -->
    <div class="search-content-container">
        <h2 class="search-heading">Search Users</h2>
        <form action="search.php" method="post" class="search-form">
            <input type="text" name="search" class="search-input" placeholder="Search by name or email" value="<?php echo htmlspecialchars($search); ?>">
            <input type="submit" value="Search" class="search-submit-button">
        </form>

        <?php if (!empty($results)): ?>
            <table class="search-results-table">
                <thead>
                    <tr>
                        <th class="search-results-header">First Name</th>
                        <th class="search-results-header">Last Name</th>
                        <th class="search-results-header">Email</th>
                        <th class="search-results-header">Registration Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $user): ?>
                        <tr class="search-results-row">
                            <td class="search-results-cell"><?php echo htmlspecialchars($user['fname']); ?></td>
                            <td class="search-results-cell"><?php echo htmlspecialchars($user['lname']); ?></td>
                            <td class="search-results-cell"><?php echo htmlspecialchars($user['email']); ?></td>
                            <td class="search-results-cell"><?php echo htmlspecialchars($user['registration_date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <p class="search-error-message">No results found.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
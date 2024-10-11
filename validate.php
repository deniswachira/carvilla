<?php
session_start();

// Check if username and password are submitted
if (isset($_POST['uname']) && isset($_POST['password'])) {
    $uname = $_POST['uname'];
    $pass = $_POST['password'];

    // Check for valid login credentials
    if ($uname === "admin" && $pass === "tryhackme") {
        // Set session variable to indicate successful login
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = 'admin';

        // Redirect to admin dashboard with alert
        echo "<script>alert('Welcome, admin!'); window.location.href='admin_dashboard.php';</script>";
        exit(); // Ensure no further code is executed

    } elseif (stripos($uname, "'--") !== false) {
        // Simulate successful SQL Injection
        // Set session variable to indicate successful login
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = 'admin';

        // Redirect to admin dashboard with alert
        echo "<script>alert('SQL Injection successful!\\nFlag: Zreh{F1dy_1aw3pg10a_fhpp3ff}'); window.location.href='admin_dashboard.php';</script>";
        exit(); // Ensure no further code is executed
    } else {
        // Invalid credentials handling
        echo "<script>alert('Invalid credentials. Please try again.'); window.location.href='./dashboard/index.html';</script>";
        exit();
    }
} elseif (isset($_POST['comment'])) {
    $comment = $_POST['comment'];

    // Check if the comment contains a <script> tag and an alert function
    if (stripos($comment, "<script>") !== false
        && stripos($comment, "</script>") !== false
        && stripos($comment, "alert(") !== false) {
        // Display the alert with the flag
        echo "<script>alert('Flag: Y3Nre1hzc19WdWxuM3I0YjFsMXR5X0ZsNGd9');</script>";
        // Redirect to the dashboard after showing the alert
        echo "<script>window.location.href='admin_dashboard.php';</script>";
        exit(); // Ensure no further code is executed
    } else {
        // Clear previous comments and store the new comment in the session
        $_SESSION['comments'] = []; // Clear previous comments
        $_SESSION['comments'][] = htmlspecialchars($comment); // Store the clean comment (escape HTML)
        // Redirect to the dashboard after storing the comment
        echo "<script>window.location.href='admin_dashboard.php';</script>";
        exit(); // Ensure no further code is executed
    }
} else {
    // Handling case where no valid credentials or comment are provided
    echo "<script>alert('Please enter valid '); window.location.href='./dashboard/index.html';</script>";
    exit();
}
?>

<?php
session_start();

// Initialize an array to hold comments in the session
if (!isset($_SESSION['comments'])) {
    $_SESSION['comments'] = [];
}

// Handle comment submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment'])) {
    // Get the comment from the POST request
    $new_comment = $_POST['comment'];

    // Add the new comment to the session array
    $_SESSION['comments'][] = $new_comment;

    // Redirect back to the dashboard after comment submission
    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full height */
            flex-direction: column; /* Align items vertically */
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .comment-section {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #fff;
            width: 400px; /* Set a fixed width for the comment section */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Add some shadow for depth */
        }
        textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            width: 100%; /* Make the button full width */
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .comments-list {
            margin-top: 20px;
            width: 400px; /* Set a fixed width for the comments list */
        }
        .comment {
            border-bottom: 1px solid #ddd;
            padding: 5px 0;
        }
    </style>
</head>
<body>
    <h1>Welcome to the Admin Dashboard!</h1>
    <p>Congratulations on getting this far! 🎉</p>
    <p>Please leave a comment below:</p>

    <div class="comment-section">
        <form action="validate.php" method="POST">
            <textarea name="comment" placeholder="Leave your comment here..." required></textarea><br>
            <input type="submit" value="Submit Comment">
        </form>
    </div>

    <div class="comments-list">
        <h2>Comments:</h2>
        <?php if (!empty($_SESSION['comments'])): ?>
            <?php foreach ($_SESSION['comments'] as $comment): ?>
                <div class="comment">
                    <?php
                    // Display the comment normally
                    echo htmlspecialchars($comment);
                    ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No comments yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>

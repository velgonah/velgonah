<?php
error_reporting(0); // Change to E_ALL for development to catch all errors
session_start();

// Ensure this file sets up the $conn variable correctly.
include 'dbconfig.php';

// Redirect if user is already logged in
if (isset($_SESSION['userid'])) {
    header('Location: vel5.php');
    exit();
}

$msg = null;

if (isset($_POST['login'])) {
    // Submitted user data
    $userFullname = $_POST['fullname'];
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];

    if (empty($userFullname) || empty($userEmail) || empty($userPassword)) {
        $msg = "All fields are required";
    } else {
        // Prepare SQL statement with placeholders
        $sql = "SELECT * FROM `tbl_users` WHERE fullname = ? AND email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            $msg = "SQL prepare failed: " . htmlspecialchars($conn->error);
        } else {
            // Bind parameters
            $stmt->bind_param('ss', $userFullname, $userEmail);
            $stmt->execute();
            $result = $stmt->get_result();

            // Records found
            if ($result->num_rows < 1) {
                $msg = "No records found";
            } else {
                // Fetch user data
                $userData = $result->fetch_assoc();

                // Verify the password
                if (password_verify($userPassword, $userData['password'])) {
                    $_SESSION['username'] = $userData['fullname'];
                    $_SESSION['userid'] = $userData['id'];
                    $_SESSION['useremail'] = $userData['email'];
                    header('Location: screen5.php');
                    exit();
                } else {
                   header('Location:vel5.php');
                }
            }
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>worldfighthungers</title>
</head>
<body>
    <img src="images/LOGO.png" id="meta"><br><br>
    <form method="post" action="">
        <input type="text" name="fullname" placeholder="Enter your Full Name" id="vel" required><br><br>
        <input type="email" name="email" placeholder="Enter your Email" id="vel" required><br><br>
        <input type="password" name="password" placeholder="Enter Password" id="vel" required><br><br>
        <input type="submit" name="login" value="Login" id="jay"><br><br>
    </form>
    <?php if ($msg): ?>
        <p><?php echo htmlspecialchars($msg); ?></p>
    <?php endif; ?>
</body>
<style type="text/css">
    body {
        text-align: center;
    }
    #jay {
        width: 35%;
        height: 40px;
        background-color: #275F22;
        border-radius: 100px;
        font-size: 24px;
        color: white;
        margin-top: 15%;
    }
    #vel {
        width: 50%;
        height: 45px;
        border-radius: 7px;
        border-color: blue;
        text-align: center;
    }
    #meta {
        width: 50%;
        height: 50%;
    }
</style>
</html>

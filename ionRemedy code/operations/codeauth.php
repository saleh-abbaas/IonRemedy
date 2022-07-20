<?php
// Configure timeout to 15 minutes
$timeout = 12 * 60 * 60;
// Set the maxlifetime of session
ini_set("session.gc_maxlifetime", $timeout);

// Also set the session cookie timeout
ini_set("session.cookie_lifetime", $timeout);

// Update the timeout of session cookie
$sessionName = session_name();
if (isset($_COOKIE[$sessionName])) {
    setcookie($sessionName, $_COOKIE[$sessionName], time() + $timeout, '/');
}
require_once('../Database/connectToDatabase.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    $sql = "SELECT * FROM auth WHERE code=" . $code;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            header('Location: ../home.php');
            exit;
        }
    } else {
        echo "(<script>alert('password auth code') </script>)";
        echo "<script>window.location.href='../index.php';</script>";
    }
    $conn->close();
} else {
    header('Location: ../index.php');
    exit;
}
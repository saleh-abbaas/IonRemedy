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
    $id = $_POST['id_number'];
    $password = $_POST['password'];
    $haspass = sha1($password);
    $sql = "SELECT * FROM auth WHERE id_number=" . $id . " And password='" . $haspass . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['id_number'] = $row['id'];
            header('Location: ../authCode.php');
            exit;
        }
    } else {
        echo "(<script>alert('password incorrect') </script>)";
        echo "<script>window.location.href='../index.php';</script>";
//         echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();

} else {

    header('Location: ../index.php');
    exit;
}
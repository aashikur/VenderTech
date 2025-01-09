<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists in database
    $conn = new mysqli('localhost', 'root', '', 'test_database');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php"); // Redirect to the next page after login
            exit();
        } else {
            echo "Invalid password! <a href='login.html'>Try Again!</a>g";
        }
    } else {
        echo "No user found! <a href='login.html'>Try Again!</a>";
    }

    $conn->close();
}
?>
<style>
    body{
        text-align: center;
    height: 100px;
    margin-top: 5%;
    font-size: 1.2rem;
    }
</style>
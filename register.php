<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        echo "Passwords do not match!";
    } else {
        // Save to database (assuming you have a database connection set up)
        // Example using MySQLi
        $conn = new mysqli('localhost', 'root', '', 'test_database');
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully. <a href='index.html'>Login</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>

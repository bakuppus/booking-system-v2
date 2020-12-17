<?php

include('database/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $conn->query('SELECT * from users');

    foreach ($result as $row) {
        if ($username == $row['username'] && $password == $row['password']) {
            session_start();
            $_SESSION["user"] = $row['id'];
            header('Location: ../dashboard');
        }
    }

    echo "<script> alert('Wrong credentials.'); </script>";
    echo "<script> window.location = '../partner-login.php' </script>";
}
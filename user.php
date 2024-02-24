<?php

class User {
    public static function getUserNameById($userId) {
        // Connect to the database (update these credentials with your own)
        $host = 'localhost';
        $username = 'td';
        $password = 'td';
        $database = 'chat_app';

        $conn = mysqli_connect($host, $username, $password, $database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch username from the database
        $userId = mysqli_real_escape_string($conn, $userId);
        $sql = "SELECT username FROM users WHERE id = '$userId'";
        $result = mysqli_query($conn, $sql);
        $userData = mysqli_fetch_assoc($result);

        // Close the database connection
        mysqli_close($conn);

        return $userData['username'] ?? '';
    }

    public static function authenticateUser($username, $password) {
        // Connect to the database (update these credentials with your own)
        $host = 'localhost';
        $usernameDB = 'td';
        $passwordDB = 'td';
        $database = 'chat_app';
    
        $conn = mysqli_connect($host, $usernameDB, $passwordDB, $database);
    
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    
        // Fetch user from the database
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password); // Escape the password
    
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $userData = mysqli_fetch_assoc($result);
    
        // Close the database connection
        mysqli_close($conn);
    
        // Check if user exists and password is correct
        if ($userData && $password === $userData['password']) {
            return $userData['id'];
        }
    
        return false;
    }
    
}

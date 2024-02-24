<?php

class Chat {
    public static function sendMessage($senderId, $receiverId, $message) {
        // Connect to the database (update these credentials with your own)
        $host = 'localhost';
        $username = 'td';
        $password = 'td';
        $database = 'chat_app';

        $conn = mysqli_connect($host, $username, $password, $database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Insert the message into the database
        $message = mysqli_real_escape_string($conn, $message);
        $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$senderId', '$receiverId', '$message')";
        mysqli_query($conn, $sql);

        // Close the database connection
        mysqli_close($conn);
    }

    public static function getMessages($senderId, $receiverId) {
        // Connect to the database (update these credentials with your own)
        $host = 'localhost';
        $username = 'td';
        $password = 'td';
        $database = 'chat_app';

        $conn = mysqli_connect($host, $username, $password, $database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch messages from the database
        $sql = "SELECT * FROM messages WHERE (sender_id = '$senderId' AND receiver_id = '$receiverId') OR (sender_id = '$receiverId' AND receiver_id = '$senderId') ORDER BY created_at";
        $result = mysqli_query($conn, $sql);
        $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Close the database connection
        mysqli_close($conn);

        return $messages;
    }
    public static function clearChat($senderId, $receiverId) {
        // Connect to the database (update these credentials with your own)
        $host = 'localhost';
        $username = 'td';
        $password = 'td';
        $database = 'chat_app';

        $conn = mysqli_connect($host, $username, $password, $database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Delete messages from the database
        $sql = "DELETE FROM messages WHERE (sender_id = '$senderId' AND receiver_id = '$receiverId') OR (sender_id = '$receiverId' AND receiver_id = '$senderId')";
        mysqli_query($conn, $sql);

        // Close the database connection
        mysqli_close($conn);
    }
}

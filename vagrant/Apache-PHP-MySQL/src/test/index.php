<?php
// src/index.php

echo "<h1>Hello from Apache and PHP!</h1>";

// Test MySQL connection
$servername = "db"; // This is the service name in docker-compose.yml
$username = "my_user"; // As defined in docker-compose.yml
$password = "my_password"; // As defined in docker-compose.yml
$database = "my_database"; // As defined in docker-compose.yml

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p>Connected to MySQL successfully!</p>";

    // Optional: Create a simple table and insert data
    $sql = "CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        message VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->exec($sql);
    echo "<p>Table 'messages' checked/created.</p>";

    // Insert a message
    $message = "This is a test message from " . date('Y-m-d H:i:s');
    $stmt = $conn->prepare("INSERT INTO messages (message) VALUES (:message)");
    $stmt->bindParam(':message', $message);
    $stmt->execute();
    echo "<p>Message inserted: '" . $message . "'</p>";

    // Retrieve messages
    $stmt = $conn->query("SELECT message FROM messages ORDER BY id DESC LIMIT 5");
    echo "<h2>Recent Messages:</h2><ul>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>" . htmlspecialchars($row['message']) . "</li>";
    }
    echo "</ul>";

} catch(PDOException $e) {
    echo "<p>MySQL Connection failed: " . $e->getMessage() . "</p>";
}
?>
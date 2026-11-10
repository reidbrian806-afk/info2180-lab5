<?php
$username = 'lab5_user';
$password = 'password123';

$country = isset($_GET['country']) ? $_GET['country'] : '';

try {
    $conn = new PDO("mysql:host=localhost;dbname=world;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $stmt->execute(['country' => "%$country%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<ul>";
    foreach ($results as $row) {
        echo "<li>" . htmlspecialchars($row['name']) . " - " . htmlspecialchars($row['head_of_state']) . "</li>";
    }
    echo "</ul>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
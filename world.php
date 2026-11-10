<?php
// 1. Database credentials
$username = 'lab5_user';
$password = 'password123';
$country = isset($_GET['country']) ? $_GET['country'] : '';

try {
    // 2. Connect to the database
    $conn = new PDO("mysql:host=localhost;dbname=world;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 3. Prepare the query (Using LIKE for partial matches)
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $stmt->execute(['country' => "%$country%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 4. Output the results in an HTML table
    if (count($results) > 0) {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Country Name</th>";
        echo "<th>Continent</th>";
        echo "<th>Independence Year</th>";
        echo "<th>Head of State</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
        foreach ($results as $row) {
            echo "<tr>";
            // Using htmlspecialchars() to prevent XSS attacks
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['continent']) . "</td>";
            // Sometimes the column is named 'independence_year', sometimes 'indep_year'. 
            // Change this if your database uses a different name.
            echo "<td>" . htmlspecialchars($row['independence_year']) . "</td>";
            echo "<td>" . htmlspecialchars($row['head_of_state']) . "</td>";
            echo "</tr>";
        }
        
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No countries found matching '$country'.</p>";
    }

} catch (PDOException $e) {
    echo "<p style='color:red;'>Database Error: " . $e->getMessage() . "</p>";
}
?>
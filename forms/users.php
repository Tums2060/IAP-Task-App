<?php
include __DIR__ . '/../config/config.php';

$result = $conn->query("SELECT * FROM users ORDER BY id ASC");

echo "<h2>Registered Users</h2>";
echo "<ol>";
while ($row = $result->fetch_assoc()){
    echo "<li>".htmlspecialchars($row['name']). "-".htmlspecialchars($row['email'])."</li>";

}
echo "</ol>"

?>
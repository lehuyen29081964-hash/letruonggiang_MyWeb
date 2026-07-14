<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=letruonggiang_myweb;charset=utf8mb4', 'root', '');
$stmt = $pdo->query('SELECT id, username, email, password FROM users LIMIT 20');
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['id'] . ' ' . $row['username'] . ' ' . $row['email'] . ' ' . substr($row['password'], 0, 60) . "\n";
}

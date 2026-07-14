<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=letruonggiang_myweb;charset=utf8mb4', 'root', '');
$stmt = $pdo->query('SELECT id, username, email, password FROM users LIMIT 100');
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $pass = $row['password'];
    if (strpos($pass, '$2y$') !== 0 && strpos($pass, '$2a$') !== 0 && strpos($pass, '$2b$') !== 0) {
        echo $row['id'].' '.$row['username'].' '.$row['email'].' '.substr($pass, 0, 60)."\n";
    }
}

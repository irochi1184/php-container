<?php
$servername = "php-mysql-container";
$username = "user";
$password = "password";
$dbname = "todoapp";

// MySQL データベースへの接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続をチェック
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// 簡単なクエリの実行
$sql = "SELECT 1";
$result = $conn->query($sql);

if ($result) {
    echo "Query successful.";
} else {
    echo "Error: " . $conn->error;
}

// 接続を閉じる
$conn->close();

?>

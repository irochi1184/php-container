<?php
session_start();

// データベース接続情報
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

// POSTデータの取得
$mail_address = $_POST['mail_address'];
$password = md5($_POST['password']); // パスワードをMD5でハッシュ化

// SQLクエリを準備
$sql = "SELECT * FROM User WHERE mail_address = '$mail_address' AND password = '$password'";
$result = $conn->query($sql);

// 結果を確認
if ($result->num_rows > 0) {
    // ユーザーが存在する場合
    $row = $result->fetch_assoc();
    $_SESSION['username'] = $row['name'];
    header("Location: welcome.php");
} else {
    // ユーザーが存在しない場合
    header("Location: login.php?error=1");
    exit();
}

// 接続を閉じる
$conn->close();
?>

<?php
// データベース接続情報
$servername = "php-mysql-container"; // MySQLコンテナのホスト名
$username = "user"; // MySQLのユーザー名
$password = "password"; // MySQLのパスワード
$dbname = "todoapp"; // 使用するデータベース名

// MySQL データベースへの接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続をチェック
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // 接続エラーの場合、エラーメッセージを表示してスクリプトを終了
}

// SQLクエリを準備
$sql = "SELECT id, title, description, created_at FROM tasks";

// クエリを実行
$result = $conn->query($sql);

// 結果を確認
if ($result->num_rows > 0) {
    // データが存在する場合、各行を出力
    echo "<h1>ToDo List</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Title</th><th>Description</th><th>Created At</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . $row["created_at"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    // データが存在しない場合、メッセージを表示
    echo "No tasks found";
}

// 接続を閉じる
$conn->close();
?>

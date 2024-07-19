<?php
session_start();

// セッションにユーザー名が設定されているか確認
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$loginUser = $_SESSION['loginUser'];
$user_id = $_SESSION['user_id'];
$group_id = $_SESSION['group_id'];

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

// 個人タスクの取得
$personal_tasks_sql = "SELECT * FROM tasks WHERE user_id = '$user_id' AND type = 'personal'";
$personal_tasks_result = $conn->query($personal_tasks_sql);

// グループタスクの取得
$group_tasks_sql = "SELECT * FROM tasks WHERE group_id = '$group_id' AND type = 'group'";
$group_tasks_result = $conn->query($group_tasks_sql);

// タスクの追加
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    
    if ($type == 'personal') {
        $task_sql = "INSERT INTO tasks (user_id, title, description, type) VALUES ('$user_id', '$title', '$description', 'personal')";
    } else {
        $task_sql = "INSERT INTO tasks (group_id, title, description, type) VALUES ('$group_id', '$title', '$description', 'group')";
    }
    
    $conn->query($task_sql);
    header("Location: tasks.php");
    exit();
}

// タスクの削除
if (isset($_GET['delete'])) {
    $task_id = $_GET['delete'];
    $delete_sql = "DELETE FROM tasks WHERE id = '$task_id'";
    $conn->query($delete_sql);
    header("Location: tasks.php");
    exit();
}

// タスクの完了チェック
if (isset($_GET['complete'])) {
    $task_id = $_GET['complete'];
    $complete_sql = "UPDATE tasks SET completed = TRUE WHERE id = '$task_id'";
    $conn->query($complete_sql);
    header("Location: tasks.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>タスク管理</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Task Management</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

        <h2>ようこそ、<?php echo htmlspecialchars($loginUser); ?>さん</h2>
        
        <h3>個人タスク</h3>
        <ul class="list-group">
            <?php while ($row = $personal_tasks_result->fetch_assoc()): ?>
                <li class="list-group-item">
                    <?php echo htmlspecialchars($row['title']); ?>
                    <?php if (!$row['completed']): ?>
                        <a href="tasks.php?complete=<?php echo $row['id']; ?>" class="btn btn-success btn-sm float-right">完了</a>
                    <?php endif; ?>
                    <a href="tasks.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm float-right">削除</a>
                </li>
            <?php endwhile; ?>
        </ul>

        <h3>グループタスク</h3>
        <ul class="list-group">
            <?php while ($row = $group_tasks_result->fetch_assoc()): ?>
                <li class="list-group-item">
                    <?php echo htmlspecialchars($row['title']); ?>
                    <?php if (!$row['completed']): ?>
                        <a href="tasks.php?complete=<?php echo $row['id']; ?>" class="btn btn-success btn-sm float-right">完了</a>
                    <?php endif; ?>
                    <a href="tasks.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm float-right">削除</a>
                </li>
            <?php endwhile; ?>
        </ul>

        <h3>タスクの追加</h3>
        <form method="post" action="tasks.php">
            <div class="form-group">
                <label for="title">タイトル:</label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="description">説明:</label>
                <textarea class="form-control" name="description" id="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="type">タスクタイプ:</label>
                <select class="form-control" name="type" id="type" required>
                    <option value="personal">個人用</option>
                    <option value="group">グループ用</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">追加</button>
        </form>

        <form method="post" action="logout.php" style="margin-top: 20px;">
            <button type="submit" class="btn btn-danger">ログアウト</button>
        </form>
    </div>
</body>
</html>

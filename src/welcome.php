<?php
session_start();

// セッションにユーザー名が設定されているか確認
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { max-width: 500px; margin-top: 50px; }
    </style>
</head>
<body>
    <div class="container text-center">
        <?php if ($username): ?>
            <h2>ようこそ、<?php echo htmlspecialchars($username); ?>さん</h2>
            <form method="post" action="logout.php">
                <button type="submit" class="btn btn-danger">ログアウト</button>
            </form>
        <?php else: ?>
            <h2>ログインしてください。</h2>
            <form method="post" action="login.php">
                <button type="submit" class="btn btn-primary">ログイン画面に戻る</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>

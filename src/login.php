<!DOCTYPE html>
<html>
<head>
    <title>Todoログイン</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error { color: red; }
        .container { max-width: 500px; margin-top: 50px; }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">ログイン</h2>
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">メールアドレスまたはパスワードが違います。</div>
        <?php endif; ?>
        <form method="post" action="authenticate.php" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="mail_address">メールアドレス:</label>
                <input type="email" class="form-control" name="mail_address" id="mail_address" required>
            </div>
            <div class="form-group">
                <label for="password">パスワード:</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">ログイン</button>
        </form>
    </div>
    <script>
        function validateForm() {
            var mail_address = document.getElementById("mail_address").value;
            var password = document.getElementById("password").value;
            if (mail_address === "" || password === "") {
                alert("メールアドレスとパスワードを入力してください。");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>連絡帳【ログイン画面】</title>
</head>

<body>
  <form action="renraku_login_act.php" method="POST">
    <fieldset>
      <legend>連絡帳【ログイン画面】</legend>
      <div>
        保育士名: <input type="text" name="teachername">
      </div>
      <div>
        パスワード: <input type="text" name="password">
      </div>
      <div>
        <button>ログイン</button>
      </div>
      <a href="renraku_register.php">登録画面へ</a>
    </fieldset>
  </form>

</body>

</html>
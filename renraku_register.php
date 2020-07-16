<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>連絡帳【ユーザ登録画面】</title>
</head>

<body>
  <form action="renraku_register_act.php" method="POST">
    <fieldset>
      <legend>連絡帳【ユーザ登録画面】</legend>
      <div>
        保育士名: <input type="text" name="teachername">
      </div>
      <div>
        パスワード: <input type="text" name="password">
      </div>
      <div>
        <button>登録</button>
      </div>
      <a href="renraku_login.php">ログイン画面へ</a>
    </fieldset>
  </form>

</body>

</html>
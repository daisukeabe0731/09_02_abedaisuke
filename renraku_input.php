<?php
session_start();
include("functions.php");
check_session_id();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>連絡帳【入力画面】</title>
</head>

<body>
  <form action="renraku_create.php" method="POST">
    <fieldset>
      <legend>連絡帳【入力画面】</legend>
      <div>
        子どもの名前：
        <select type="text" name="childname">
          <option value="">子どもの名前を選択</option>
          <option value="あらたまっけんゆう">あらた まっけんゆう</option>
          <option value="さとうたける">さとう たける</option>
          <option value="ふくしそうた">ふくし そうた</option>
          <option value="ながさわまさみ">ながさわ まさみ</option>
          <option value="ひろせすず">ひろせ すず</option>
          <option value="よしおかりほ">よしおか りほ</option>
        </select>
      </div>
      <div>
        日にち：<input type="date" name="writetime">
      </div>
      <div>
        <textarea type="text" name="renrakutext" cols="30" rows="10"></textarea>
      </div>
      <div>
        <button>送信</button>
      </div>
      <a href="renraku_read.php">一覧画面</a>
      <a href="renraku_logout.php">ログアウト</a>
    </fieldset>
  </form>

</body>

</html>